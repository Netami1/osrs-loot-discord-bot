<?php

namespace App\Models\StaticData;

class LootTableRolls
{
    private const BONES_ID = 526;
    private const BONES_NAME = 'Bones';
    //
    private const BIG_BONES_ID = 532;
    private const BIG_BONES_NAME = 'Big bones';

    public function data(): array
    {
        return [
            LootTables::CHICKEN_ALWAYS_ID => [
                [
                    'id' => '5740d12d-23d0-4bc3-a326-89e95bb2d205',
                    'item_name' => self::BONES_NAME,
                    'item_id' => self::BONES_ID,
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
            LootTables::GENERAL_GRAARDOOR_ALWAYS_ID => [
                [
                    'id' => '2c9f9c6e-95e8-4faf-a28b-06aabaa422a8',
                    'item_name' => self::BIG_BONES_NAME,
                    'item_id' => self::BIG_BONES_ID,
                ],
            ],
            LootTables::GENERAL_GRAARDOOR_PRIMARY_ID => [
                [
                    'id' => '5445f9de-8246-47a3-8199-717e6f536b80',
                    'item_name' => 'Rune 2h sword',
                    'item_id' => '1319',
                    'chance' => 0.062992125984252,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => '0f066e24-5ede-49f2-8d85-955f70f21da2',
                    'item_name' => 'Rune platebody',
                    'item_id' => '1127',
                    'chance' => 0.062992125984252,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => '38fce583-59f7-4634-bf69-b926e5a6c2f9',
                    'item_name' => 'Rune pickaxe',
                    'item_id' => '1275',
                    'chance' => 0.047244094488189,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => '8a53ef92-c107-4a21-9dbf-a903923dc3aa',
                    'item_name' => 'Coins',
                    'item_id' => '995',
                    'chance' => 0.2496062992126,
                    'min' => 19500,
                    'max' => 20000,
                ],
                [
                    'id' => 'b7762fdc-be86-4207-b8aa-3433bee55898',
                    'item_name' => 'Grimy snapdragon',
                    'item_id' => '3051',
                    'chance' => 0.062992125984252,
                    'min' => 3,
                    'max' => 3,
                ],
                [
                    'id' => '9205b122-80c8-4bd0-ab28-e44cffd5f085',
                    'item_name' => 'Snapdragon seed',
                    'item_id' => '5300',
                    'chance' => 0.062992125984252,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => '307c18f8-1d30-437d-8408-046936e46b73',
                    'item_name' => 'Super restore(4)',
                    'item_id' => '3024',
                    'chance' => 0.062992125984252,
                    'min' => 3,
                    'max' => 3,
                ],
                [
                    'id' => '27b46c43-bb4a-49c1-9729-75f95917842a',
                    'item_name' => 'Adamantite ore',
                    'item_id' => '449',
                    'chance' => 0.062992125984252,
                    'min' => 15,
                    'max' => 20,
                ],
                [
                    'id' => 'baa5d2fc-f2fa-45c8-85dc-d390739b4537',
                    'item_name' => 'Coal',
                    'item_id' => '453',
                    'chance' => 0.062992125984252,
                    'min' => 115,
                    'max' => 120,
                ],
                [
                    'id' => '5343f31f-80cd-47dd-8769-2ee84d15a7b3',
                    'item_name' => 'Magic logs',
                    'item_id' => '1513',
                    'chance' => 0.062992125984252,
                    'min' => 15,
                    'max' => 20,
                ],
                [
                    'id' => '610acc15-2e09-431d-87fc-c3d0118d6c6f',
                    'item_name' => 'Bandos chestplate',
                    'item_id' => '11832',
                    'chance' => 0.0026246719160105,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => 'abe7f219-8d30-4743-862a-d6ad094d19ed',
                    'item_name' => 'Nature rune',
                    'item_id' => '561',
                    'chance' => 0.062992125984252,
                    'min' => 65,
                    'max' => 70,
                ],
                [
                    'id' => '145d674f-5a09-4323-90dd-31c3fe4f9515',
                    'item_name' => 'Coins',
                    'item_id' => '995',
                    'chance' => 0.0098425196850394,
                    'min' => 20100,
                    'max' => 20600,
                ],
                [
                    'id' => '26ceea63-9456-4b6b-8b7e-d0561c3e6f64',
                    'item_name' => 'Rune sword',
                    'item_id' => '1289',
                    'chance' => 0.0024606299212598,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => 'd67e1b2c-d67a-4f05-8c67-996fb466e962',
                    'item_name' => 'Bandos tassets',
                    'item_id' => '11834',
                    'chance' => 0.0026246719160105,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => 'c5304c5e-1970-48e7-b0c3-51804a57ccca',
                    'item_name' => 'Bandos boots',
                    'item_id' => '11836',
                    'chance' => 0.0026246719160105,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => 'e67c621d-eadc-4ce7-a79d-9b63b8388ff3',
                    'item_name' => 'Clue scroll (elite)',
                    'item_id' => '12073',
                    'chance' => 0.004,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => '9c51be64-18bf-47f5-92e6-3a6b0cebe82d',
                    'item_name' => 'Bandos hilt',
                    'item_id' => '11812',
                    'chance' => 0.0019685039370079,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => '065cf6b4-1d6e-407c-965e-3f0c2dee84e7',
                    'item_name' => 'Godsword shard 1',
                    'item_id' => '11818',
                    'chance' => 0.0013123359580052,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => 'e1c750a3-32ee-4b98-b5ce-052fa6a143ee',
                    'item_name' => 'Godsword shard 2',
                    'item_id' => '11820',
                    'chance' => 0.0013123359580052,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => 'd1e32026-eff1-44b7-95af-d6e6de919458',
                    'item_name' => 'Godsword shard 3',
                    'item_id' => '11822',
                    'chance' => 0.0013123359580052,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => '203fe3cd-13d4-4d74-9b51-45200dd53b39',
                    'item_name' => 'Rune longsword',
                    'item_id' => '1303',
                    'chance' => 0.062992125984252,
                    'min' => 1,
                    'max' => 1,
                ],
            ],
            LootTables::GENERAL_GRAARDOOR_TERTIARY_ID => [
                [
                    'id' => '83e86182-c95c-4302-bf33-0f9296c71511',
                    'item_name' => 'Long bone',
                    'item_id' => '10976',
                    'chance' => 0.0025,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => 'e453cceb-dd32-4a36-baee-d7e73a197cc3',
                    'item_name' => 'Pet general graardor',
                    'item_id' => '12650',
                    'chance' => 0.0002,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => '02b71507-d59b-4b91-ad2a-492df45dd6f5',
                    'item_name' => 'Curved bone',
                    'item_id' => '10977',
                    'chance' => 0.00019950124688279,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => 'f2806995-99ee-44da-bc69-d9bf19807ddb',
                    'item_name' => 'Clue scroll (elite)',
                    'item_id' => '12073',
                    'chance' => 0.004,
                    'min' => 1,
                    'max' => 1,
                ],
            ],
        ];
    }
}
