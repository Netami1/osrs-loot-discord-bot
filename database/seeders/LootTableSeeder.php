<?php

namespace Database\Seeders;

use App\Models\LootTable;
use App\Models\StaticData\LootTables;
use Illuminate\Database\Seeder;

class LootTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lootSources = (new LootTables())->data();
        foreach ($lootSources as $sourceId => $tablesData) {
            foreach ($tablesData as $tableData) {
                $tableData = array_merge($tableData, ['loot_source_id' => $sourceId]);

                $table = LootTable::query()
                    ->find($tableData['id']);

                if ($table) {
                    $table->update($tableData);
                    $table->save();
                } else {
                    LootTable::query()
                        ->create($tableData);
                }
            }
        }
    }
}
