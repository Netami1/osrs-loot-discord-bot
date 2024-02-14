<?php

namespace App\Services\LootGeneration;

use App\Enum\LootTypeEnum;
use App\Models\LootSource;
use App\Models\LootTable;
use App\Models\LootTableRoll;
use App\Services\ItemService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class LootGeneratorService
{
    private ItemService $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    public function generateLoot(array $commandOptions): LootResult
    {
        $commandOptions = collect($commandOptions);

        $source = $this->getLootSource($commandOptions);
        $quantity = $this->getQuantity($commandOptions);

        $loots = $this->processLootTables($source, $quantity);
        $loots->sortByDesc(function (LootRollResult $lootRollResult) {
            return $lootRollResult->totalValue();
        });

        return (new LootResult())
            ->setSource($source)
            ->setQuantity($quantity)
            ->setLootRollResults($loots);
    }

    public function processLootTables(LootSource $source, int $quantity): Collection
    {
        $allTableLoots = new Collection();

        // Process each loot table type and merge the results together
        foreach (LootTypeEnum::cases() as $lootType) {
            $lootResults = $this->processLootTableType($source, $quantity, $lootType);
            $allTableLoots = $allTableLoots->merge($lootResults);
        }

        // Group the results by item id and sum the quantities, to combine multiple rolls of the same item
        return $allTableLoots->groupBy(function (LootRollResult $lootRollResult) {
            return $lootRollResult->getItem()->id;
        })->map(function (Collection $results) {

            $totalQuantity = $results->sum(function (LootRollResult $lootRollResult) {
                return $lootRollResult->getQuantity();
            });

            return (new LootRollResult())
                ->setItem($results->first()->getItem())
                ->setQuantity($totalQuantity);

        })->values();
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
        for ($rollNumberIndex=0; $rollNumberIndex < $quantity; $rollNumberIndex++) {

            /** @var LootTable $lootTable */
            foreach ($lootTables as $lootTable) {

                // Number of rolls for this loot table
                if ($lootTable->rolls_min !== null && $lootTable->rolls_max !== null) {
                    $tableRollsAmount = rand($lootTable->rolls_min, $lootTable->rolls_max);
                } else {
                    $tableRollsAmount = $lootTable->rolls;
                }
                for ($tableRollIndex=0; $tableRollIndex < $tableRollsAmount; $tableRollIndex++) {

                    // Check if we should continue rolling, this is to handle the case where we miss all rolls on the table
                    $shouldContinueRolling = true;
                    while ($shouldContinueRolling) {
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
                        for ($rollIndex=0; $rollIndex < $rollsOnTableCount; $rollIndex++) {
                            /** @var LootTableRoll $roll */
                            $roll = $rolls[$rollIndex];
                            // Check if we succeeded on the roll
                            $shouldHitOverride = $this->shouldHitOverride($lootType);
                            if ($shouldHitOverride || $randRoll <= $roll->chance) {
                                // We hit the roll, so we can stop rolling after we finish here
                                $shouldContinueRolling = false;

                                // Check if this roll was for an intended "Nothing" drop
                                if ($roll->item_id === null) {
                                    Log::info('Rolled nothing', [
                                        'source' => $source->name,
                                    ]);
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
                                if ($lootType !== LootTypeEnum::ALWAYS) {
                                    break;
                                }
                            } else if ($lootType === LootTypeEnum::PRIMARY) {
                                // Adjust the roll chance for the next roll
                                $randRoll -= $roll->chance;
                            }
                        }

                        // Tertiary loot tables should only roll once and aren't guaranteed to roll an item
                        if ($lootType === LootTypeEnum::TERTIARY) {
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

    private function getLootSource(Collection $commandOptions): LootSource
    {
        $npcOption = $commandOptions->firstWhere('name', '=', 'target');

        /** @var LootSource */
        return LootSource::query()
            ->where('name', $npcOption['value'])
            ->firstOrFail();
    }

    private function getQuantity(Collection $commandOptions): int
    {
        $quantityOption = $commandOptions->firstWhere('name', '=', 'quantity');

        return $quantityOption['value'];
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
