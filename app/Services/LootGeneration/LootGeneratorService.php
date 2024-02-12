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


        return $allTableLoots;
        /*return $allTableLoots->groupBy(function (LootRollResult $lootRollResult) {
            return $lootRollResult->getItem()->id;
        })->map(function (Collection $results) {

            $totalQuantity = $results->sum(function (LootRollResult $lootRollResult) {
                return $lootRollResult->getQuantity();
            });

            return (new LootRollResult())
                ->setItem($results->first()->getItem())
                ->setQuantity($totalQuantity);

        })->values();*/
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
        for ($i=0; $i < $quantity; $i++) {

            /** @var LootTable $lootTable */
            foreach ($lootTables as $lootTable) {

                // Number of rolls for this loot table
                for ($j=0; $j < $lootTable->rolls; $j++) {
                    $tableWasHit = false;
                    while (!$tableWasHit) {
                        $rolls = $lootTable->lootTableRolls()
                            ->get()
                            ->shuffle();

                        $randRoll = rand(0, 1000000000000000) / 1000000000000000;

                        /** @var LootTableRoll $roll */
                        foreach ($rolls as $roll) {
                            // Check if we succeeded on the roll
                            if ($lootType === LootTypeEnum::ALWAYS || $randRoll <= $roll->chance) {
                                $tableWasHit = true;

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

                                if ($lootType !== LootTypeEnum::ALWAYS) {
                                    break;
                                }
                            } else {
                                $randRoll -= $roll->chance;
                            }
                        }

                        if (!$tableWasHit) {
                            Log::warning('Loot table roll failed', [
                                'source' => $source->name,
                                'lootType' => $lootType,
                            ]);
                        }
                    }
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

}
