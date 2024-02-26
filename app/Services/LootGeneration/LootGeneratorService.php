<?php

namespace App\Services\LootGeneration;

use App\Enum\LootTypeEnum;
use App\Models\LootResult;
use App\Models\LootResultItem;
use App\Models\LootSource;
use App\Models\LootTable;
use App\Models\LootTableRoll;
use App\Repos\LootResultRepo;
use App\Services\ItemService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LootGeneratorService
{
    private ItemService $itemService;
    private LootResultRepo $lootResultRepo;

    public function __construct(ItemService $itemService, LootResultRepo $lootResultRepo)
    {
        $this->itemService = $itemService;
        $this->lootResultRepo = $lootResultRepo;
    }

    public function generateLoot(LootGenerationRequest $generationRequest): LootResult
    {
        $lootResult = $this->lootResultRepo->create(
            $generationRequest->getLootSource(),
            $generationRequest->getQuantity(),
            $generationRequest->getDiscordUsername(),
        );

        $this->processLootTables($generationRequest->getLootSource(), $generationRequest->getQuantity(), $lootResult);

        return $lootResult;
    }

    public function processLootTables(LootSource $source, int $quantity, LootResult $lootResult): Collection
    {
        $timesToRollTables = $quantity;
        $allTableLoots = new Collection();

        // Process each loot table type and merge the results together
        $lootTableTypes = [LootTypeEnum::RAID_UNIQUE, LootTypeEnum::PRIMARY, LootTypeEnum::TERTIARY, LootTypeEnum::ALWAYS];
        foreach ($lootTableTypes as $lootType) {
            $lootResults = $this->processLootTableType($source, $timesToRollTables, $lootType);

            // If we rolled a raid unique, we should roll fewer times on the other tables
            if ($lootType === LootTypeEnum::RAID_UNIQUE && $lootResults->isNotEmpty()) {
                $uniquesCount = $lootResults->sum(fn (LootRollResult $lootRollResult) => $lootRollResult->getQuantity());
                $timesToRollTables -= $uniquesCount;

                // Also roll for the raid's pet for each unique we got
                $petResults = $this->processLootTableType($source, $uniquesCount, LootTypeEnum::RAID_PET);
                $allTableLoots = $allTableLoots->merge($petResults);
            }

            $allTableLoots = $allTableLoots->merge($lootResults);
        }

        $lootResultItems = new Collection();
        // Group the results by item id and sum the quantities, to combine multiple rolls of the same item
        DB::transaction(function () use ($allTableLoots, $lootResult, &$lootResultItems) {
            $lootResultItems = $allTableLoots->groupBy(function (LootRollResult $lootRollResult) {
                return $lootRollResult->getItem()->id;
            })->map(function (Collection $results) use ($lootResult) {
                $item = $results->first()->getItem();

                $totalQuantity = $results->sum(function (LootRollResult $lootRollResult) {
                    return $lootRollResult->getQuantity();
                });

                return LootResultItem::query()
                    ->create([
                        'item_id' => $results->first()->getItem()->id,
                        'quantity' => $totalQuantity,
                        'loot_result_id' => $lootResult->id,
                        'total_value' => $totalQuantity * $item->price,
                    ]);

            })->values();
        });

        return $lootResultItems;
    }

    private function processLootTableType(LootSource $source, int $quantity, LootTypeEnum $lootType): Collection
    {
        $lootTables = $source->lootTables()
            ->where('type', $lootType)
            ->with('lootTableRolls')
            ->get();

        if ($lootTables->isEmpty()) {
            return new Collection();
        }

        $rollResults = [];
        $toReturn = new Collection();
        // Number of rolls requested by the user
        for ($rollNumberIndex = 0; $rollNumberIndex < $quantity; $rollNumberIndex++) {

            /** @var LootTable $lootTable */
            foreach ($lootTables as $lootTable) {

                // Number of rolls for this loot table
                if ($lootTable->rolls_min !== null && $lootTable->rolls_max !== null) {
                    $tableRollsAmount = rand($lootTable->rolls_min, $lootTable->rolls_max);
                } else {
                    $tableRollsAmount = $lootTable->rolls;
                }
                for ($tableRollIndex = 0; $tableRollIndex < $tableRollsAmount; $tableRollIndex++) {

                    // Check if we should continue rolling, this is to handle the case where we miss all rolls on the table
                    $shouldContinueRolling = true;
                    while ($shouldContinueRolling) {

                        // If we're rolling a raid unique table, we need to roll to see if we hit the table first
                        if ($lootType === LootTypeEnum::RAID_UNIQUE) {
                            $hitTableRoll = rand(0, 1000000000) / 1000000000;

                            // If we hit the table roll, we can continue to process the rolls on the table
                            // Otherwise, we should stop rolling on this table by breaking
                            if ($hitTableRoll >= $lootTable->chance) {
                                break;
                            }
                        }

                        // Shuffle the rolls to make it more random
                        $rolls = $lootTable->lootTableRolls()
                            ->get()
                            ->shuffle()
                            ->map(function (LootTableRoll $roll) {
                                return $roll;
                            })
                            ->all();

                        // Roll a double between 0 and 1 to check against each roll's chance weighting
                        $randRoll = rand(0, 1000000000) / 1000000000;
                        $rollsOnTableCount = count($rolls);
                        for ($rollIndex = 0; $rollIndex < $rollsOnTableCount; $rollIndex++) {
                            /** @var LootTableRoll $roll */
                            $roll = $rolls[$rollIndex];
                            // Check if we succeeded on the roll
                            $shouldHitOverride = $this->shouldHitOverride($lootType);
                            if ($shouldHitOverride || $randRoll <= $roll->chance) {
                                // We hit the roll, so we can stop rolling after we finish here
                                $shouldContinueRolling = false;

                                // Check if this roll was for an intended "Nothing" drop
                                if ($roll->item_id === null) {
                                    break;
                                }

                                // Roll the quantity of the item
                                $rollQuantity = rand($roll->min, $roll->max);

                                // Add the roll's item id and quantity to the results array
                                if (array_key_exists($roll->item_id, $rollResults)) {
                                    $rollResults[$roll->item_id] += $rollQuantity;
                                } else {
                                    $rollResults[$roll->item_id] = $rollQuantity;
                                }

                                // Now that we rolled an item, we can discard the rest of the rolls for this table
                                // we don't break out of Always tables, as they can/should roll multiple items
                                if ($lootType !== LootTypeEnum::ALWAYS && $lootType !== LootTypeEnum::TERTIARY) {
                                    break;
                                }
                            } elseif ($lootType === LootTypeEnum::PRIMARY || $lootType === LootTypeEnum::RAID_UNIQUE) {
                                // Adjust the roll chance for the next roll
                                $randRoll -= $roll->chance;
                            }
                        }

                        // Tertiary loot tables should only roll once and aren't guaranteed to roll an item
                        if ($lootType === LootTypeEnum::TERTIARY || $lootType === LootTypeEnum::RAID_PET) {
                            $shouldContinueRolling = false;
                        }
                    }
                }
            }
        }

        // Convert the roll results into a collection of LootRollResults
        foreach ($rollResults as $itemId => $quantity) {
            $item = $this->itemService->getOrCreateItem($itemId);
            if ($item) {
                $toReturn->push((new LootRollResult())
                    ->setItem($item)
                    ->setQuantity($quantity));
            } else {
                Log::warning('Item not found', [
                    'itemId' => $itemId,
                ]);
            }
        }

        return $toReturn;
    }

    private function shouldHitOverride(LootTypeEnum $lootTypeEnum): bool
    {
        // Always loot tables always hit
        if ($lootTypeEnum === LootTypeEnum::ALWAYS) {
            return true;
        }

        return false;
    }

}
