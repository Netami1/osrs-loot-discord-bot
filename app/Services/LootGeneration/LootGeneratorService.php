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
        Log::info('Generating loot', [
            'source' => $source->name,
            'quantity' => $quantity,
        ]);

        $loots = $this->processLootTables($source, $quantity);

        return (new LootResult())
            ->setSource($source)
            ->setQuantity($quantity)
            ->setLootRollResults($loots);
    }

    public function processLootTables(LootSource $source, int $quantity): Collection
    {
        $alwaysLootResults = $this->processLootTableType($source, $quantity, LootTypeEnum::ALWAYS);
        $primaryLootResults = $this->processLootTableType($source, $quantity, LootTypeEnum::PRIMARY);
        $tertiaryLootResults = $this->processLootTableType($source, $quantity, LootTypeEnum::TERTIARY);

        $allTableLoots = $alwaysLootResults->merge($primaryLootResults)->merge($tertiaryLootResults);

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

        $rollResults = [];
        $toReturn = new Collection();
        // Number of rolls requested by the user
        for ($rollNumberIndex=0; $rollNumberIndex < $quantity; $rollNumberIndex++) {

            /** @var LootTable $lootTable */
            foreach ($lootTables as $lootTable) {

                // Number of rolls for this loot table
                for ($tableRollIndex=0; $tableRollIndex < $lootTable->rolls; $tableRollIndex++) {
                    $shouldContinueRolling = true;
                    //while ($shouldContinueRolling) {
                        $rolls = $lootTable->lootTableRolls()
                            ->get()
                            ->shuffle()
                            ->map(function (LootTableRoll $roll) {
                                return $roll;
                            })
                            ->all();
                        $rollsOnTableCount = count($rolls);

                        $randRoll = rand(0, 1000000000000000) / 1000000000000000;

                        for ($rollIndex=0; $rollIndex < $rollsOnTableCount; $rollIndex++) {
                            /** @var LootTableRoll $roll */
                            $roll = $rolls[$rollIndex];
                            // Check if we succeeded on the roll
                            $shouldHitAsDefault = $this->shouldHitAsDefault($rollIndex, $rollsOnTableCount, $lootType);
                            if ($randRoll <= $roll->chance || $shouldHitAsDefault) {
                                if ($lootType === LootTypeEnum::PRIMARY && $shouldHitAsDefault) {
                                    Log::info('Hit as default', [
                                        'rollIndex' => $rollIndex,
                                        'rollsOnTableCount' => $rollsOnTableCount,
                                        'lootType' => $lootType,
                                        'itemId' => $roll->item_id,
                                    ]);
                                }

                                $shouldContinueRolling = false;

                                // Check if this roll was for a "Nothing" drop
                                if ($roll->item_id === null) {
                                    break;
                                }

                                $rollQuantity = rand($roll->min, $roll->max);

                                if (array_key_exists($roll->item_id, $rollResults)) {
                                    $rollResults[$roll->item_id] += $rollQuantity;
                                } else {
                                    $rollResults[$roll->item_id] = $rollQuantity;
                                }

                                // Now that we rolled an item, we can discard the rest of the rolls for this table
                                if ($lootType !== LootTypeEnum::ALWAYS) {
                                    break;
                                }
                            } else if ($lootType === LootTypeEnum::PRIMARY) {
                                $randRoll -= $roll->chance;
                            }
                        }

                        // Tertiary loot tables should only roll once and aren't guaranteed to roll an item
                        if ($lootType === LootTypeEnum::TERTIARY) {
                            $shouldContinueRolling = false;
                        }
                    //}
                }
            }
        }

        foreach ($rollResults as $itemId => $quantity) {
            $item = $this->itemService->getOrFetchItem($itemId);
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
        $npcOption = $commandOptions->firstWhere('name', '=', 'npc');

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

    private function shouldHitAsDefault(int $rollIndex, int $rollsOnTableCount, LootTypeEnum $lootTypeEnum): bool
    {
        // Always loot tables always hit
        if ($lootTypeEnum === LootTypeEnum::ALWAYS) {
            return true;
        }

        // The last roll on a primary table is always a hit
        if ($lootTypeEnum === LootTypeEnum::PRIMARY) {
            return $rollIndex === $rollsOnTableCount - 1;
        }

        return false;
    }

}
