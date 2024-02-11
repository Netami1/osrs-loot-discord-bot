<?php

namespace App\Models\StaticData;

class LootTableRolls
{
    public function data(): array
    {
        return [
            LootTables::CHICKEN_ALWAYS_ID => [
                [
                    'id' => '5740d12d-23d0-4bc3-a326-89e95bb2d205',
                    'item_name' => 'Bones',
                    'item_id' => 526,
                ],
                [
                    'id' => 'a2c9bc89-bd33-4be8-8907-5e0ec821ca2b',
                    'item_name' => 'Raw chicken',
                    'item_id' => 2138,
                ],
            ],
            LootTables::CHICKEN_PRIMARY_ID => [
                [
                    'id' => '17a404b3-c7f9-4d94-8517-82a54ddff66f',
                    'item_name' => 'Feather',
                    'item_id' => 314,
                    'chance' => 0.5,
                    'min' => 5,
                    'max' => 5,
                ],
                [
                    'id' => 'ffb50ada-a2fa-45e0-82cc-ea4857807abe',
                    'item_name' => 'Feather',
                    'item_id' => 314,
                    'chance' => 0.25,
                    'min' => 15,
                    'max' => 15,
                ],
                [
                    'id' => '47a46d7c-f366-43f5-8659-a713c79151e7',
                    'chance' => 0.25,
                ],
            ],
        ];
    }
}
