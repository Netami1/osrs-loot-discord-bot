<?php

namespace App\Services;

use App\Enum\LootTypeEnum;
use App\Models\LootSource;
use App\Models\LootTable;
use App\Models\LootTableRoll;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class LootGeneratorService
{
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
        $lootResult = (new LootResult())
            ->setSource($source)
            ->setQuantity($quantity)
            ->setLootRollResults($loots);

        return $lootResult;
    }

    private function processLootTables(LootSource $source, int $quantity): Collection
    {
        $alwaysLootResults = $this->processAlwaysLootTables($source, $quantity);
        $primaryLootResults = $this->processPrimaryLootTables($source, $quantity);

        $allTableLoots = $alwaysLootResults->merge($primaryLootResults);

        return $allTableLoots->groupBy(function (LootRollResult $lootRollResult) {
            return $lootRollResult->getItemId();
        })->map(function (Collection $results, $itemId) {
            $itemName = $results->first()->getItemName();

            $totalQuantity = $results->sum(function (LootRollResult $lootRollResult) {
                return $lootRollResult->getQuantity();
            });

            return (new LootRollResult())
                ->setItemId($itemId)
                ->setItemName($itemName)
                ->setQuantity($totalQuantity);

        })->values();
    }

    private function processAlwaysLootTables(LootSource $source, int $quantity): Collection
    {
        $alwaysTables = $source->lootTables()
            ->where('type', LootTypeEnum::ALWAYS)
            ->get();

        $toReturn = new Collection();
        /** @var LootTable $lootTable */
        foreach ($alwaysTables as $lootTable) {
            $rolls = $lootTable->lootTableRolls;

            /** @var LootTableRoll $roll */
            foreach ($rolls as $roll) {
                for ($i=0; $i < $quantity; $i++) {
                    $rollQuantity = rand($roll->min, $roll->max);

                    $lootRollResult = (new LootRollResult())
                        ->setItemId($roll->item_id)
                        ->setItemName($roll->item_name)
                        ->setQuantity($rollQuantity);

                    $toReturn->push($lootRollResult);
                }
            }
        }

        return $toReturn;
    }

    private function processPrimaryLootTables(LootSource $source, int $quantity): Collection
    {
        $primaryTables = $source->lootTables()
            ->where('type', LootTypeEnum::PRIMARY)
            ->get();

        $toReturn = new Collection();
        for ($i=0; $i < $quantity; $i++) {

            /** @var LootTable $lootTable */
            foreach ($primaryTables as $lootTable) {
                $rolls = $lootTable->lootTableRolls()
                    ->get()
                    ->sortByDesc(function (LootTableRoll $tableRoll) {
                        return $tableRoll->chance;
                    });

                /** @var LootTableRoll $roll */
                foreach ($rolls as $roll) {
                    $randRoll = rand(0, 100) / 100;

                    Log::info('Loot roll', [
                        'item_id' => $roll->item_id,
                        'min' => $roll->min,
                        'max' => $roll->max,
                        'chance' => $roll->chance,
                        'roll' => $randRoll,
                    ]);

                    // Check if we succeeded on the roll
                    if ($randRoll < $roll->chance) {
                        // Check if this roll was for a "Nothing" drop
                        if ($roll->item_id === null) {
                            break;
                        }

                        $rollQuantity = rand($roll->min, $roll->max);

                        $lootRollResult = (new LootRollResult())
                            ->setItemId($roll->item_id)
                            ->setItemName($roll->item_name)
                            ->setQuantity($rollQuantity);

                        $toReturn->push($lootRollResult);

                        //Break out since we hit an item for this table
                        break;
                    }
                }
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
