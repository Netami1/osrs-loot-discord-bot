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
        $tables = (new LootTables())->data();
        foreach ($tables as $tableData) {
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
