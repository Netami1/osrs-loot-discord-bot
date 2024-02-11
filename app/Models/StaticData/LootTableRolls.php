<?php

namespace App\Models\StaticData;

class LootTableRolls
{
    public function data(): array
    {
        return [
            [
                'id' => '5740d12d-23d0-4bc3-a326-89e95bb2d205',
                'loot_table_id' => LootTables::CHICKEN_ALWAYS_ID,
                'item_name' => 'Bones',
                'item_id' => 526,
            ],
            [
                'id' => 'a2c9bc89-bd33-4be8-8907-5e0ec821ca2b',
                'loot_table_id' => LootTables::CHICKEN_ALWAYS_ID,
                'item_name' => 'Raw chicken',
                'item_id' => 2138,
            ],
        ];
    }
}
