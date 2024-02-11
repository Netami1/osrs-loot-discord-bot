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

        return (new LootResult())
            ->setSource($source)
            ->setQuantity($quantity)
            ->setLootRollResults($loots);
    }

    private function processLootTables(LootSource $source, int $quantity): Collection
    {
        $alwaysLootResults = $this->processLootTableType($source, $quantity, LootTypeEnum::ALWAYS);
        $primaryLootResults = $this->processLootTableType($source, $quantity, LootTypeEnum::PRIMARY);

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

    private function processLootTableType(LootSource $source, int $quantity, LootTypeEnum $lootType): Collection
    {
        $primaryTables = $source->lootTables()
            ->where('type', $lootType)
            ->get();

        $toReturn = new Collection();
        for ($i=0; $i < $quantity; $i++) {

            /** @var LootTable $lootTable */
            foreach ($primaryTables as $lootTable) {
                $rolls = $lootTable->lootTableRolls()
                    ->get()
                    ->sortBy(function (LootTableRoll $tableRoll) {
                        return $tableRoll->chance;
                    });

                $rollHit = null;
                $randRoll = rand(0, 100) / 100;

                /** @var LootTableRoll $roll */
                foreach ($rolls as $roll) {
                    // Check if we succeeded on the roll
                    if ($randRoll <= $roll->chance) {
                        // Check if this roll was for a "Nothing" drop
                        if ($roll->item_id === null) {
                            break;
                        }

                        $rollQuantity = rand($roll->min, $roll->max);

                        $rollHit = (new LootRollResult())
                            ->setItemId($roll->item_id)
                            ->setItemName($roll->item_name)
                            ->setQuantity($rollQuantity);

                        if ($lootType === LootTypeEnum::ALWAYS) {
                            $toReturn->push($rollHit);
                            $rollHit = null;
                        } else {
                            break;
                        }
                    } else {
                        $randRoll -= $roll->chance;
                    }
                }

                if ($rollHit !== null) {
                    Log::info('Hit roll', [
                        'roll' => $rollHit->getItemName(),
                        'quantity' => $rollHit->getQuantity(),
                    ]);
                    $toReturn->push($rollHit);
                } else {
                    Log::info('No hit');
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
