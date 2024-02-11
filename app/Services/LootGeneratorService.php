<?php

namespace App\Services;

use App\Enum\LootTypeEnum;
use App\Models\LootSource;
use App\Models\LootTable;
use App\Models\LootTableRoll;
use Illuminate\Log\Logger;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class LootGeneratorService
{
    public function generateLoot(array $commandOptions): array
    {
        $commandOptions = collect($commandOptions);

        $source = $this->getLootSource($commandOptions);
        $quantity = $this->getQuantity($commandOptions);
        Log::info('Generating loot', [
            'source' => $source->name,
            'quantity' => $quantity,
        ]);

        $loots = $this->processLootTables($source, $quantity);

        return $loots;
    }

    private function processLootTables(LootSource $source, int $quantity): array
    {
        $alwaysLootResults = $this->processAlwaysLootTables($source, $quantity);

        return $alwaysLootResults;
    }

    private function processAlwaysLootTables(LootSource $source, int $quantity): array
    {
        $alwaysTables = $source->lootTables()
            ->where('type', LootTypeEnum::ALWAYS)
            ->get();

        $toReturn = [];
        /** @var LootTable $lootTable */
        foreach ($alwaysTables as $lootTable) {
            $rolls = $lootTable->lootTableRolls;

            /** @var LootTableRoll $roll */
            foreach ($rolls as $roll) {
                for ($i=0; $i < $quantity; $i++) {
                    $rollQuantity = rand($roll->min, $roll->max);
                    if (array_key_exists($roll->item_name, $toReturn)) {
                        $toReturn[$roll->item_name] += $rollQuantity;
                    } else {
                        $toReturn[$roll->item_name] = $rollQuantity;
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
