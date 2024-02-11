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
        $allTableLoots = collect($alwaysLootResults);

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
