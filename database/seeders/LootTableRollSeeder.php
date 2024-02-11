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
        $tableRolls = (new LootTableRolls())->data();
        foreach ($tableRolls as $tableRollData) {
            $tableRoll = LootTableRoll::query()
                ->find($tableRollData['id']);

            if ($tableRoll) {
                $tableRoll->updateFrom($tableRollData);
            } else {
                LootTableRoll::query()
                    ->create($tableRollData);
            }
        }
    }
}
