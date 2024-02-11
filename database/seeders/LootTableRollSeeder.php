<?php

namespace Database\Seeders;

use App\Models\LootTableRoll;
use App\Models\StaticData\LootTableRolls;
use Illuminate\Database\Seeder;

class LootTableRollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lootTables = (new LootTableRolls())->data();
        foreach ($lootTables as $lootTableId => $tableRolls) {

            foreach ($tableRolls as $tableRollData) {
                $tableRollData = array_merge($tableRollData, ['loot_table_id' => $lootTableId]);

                $tableRoll = LootTableRoll::query()
                    ->find($tableRollData['id']);

                if ($tableRoll) {
                    $tableRoll->update($tableRollData);
                    $tableRoll->save();
                } else {
                    LootTableRoll::query()
                        ->create($tableRollData);
                }
            }
        }
    }
}
