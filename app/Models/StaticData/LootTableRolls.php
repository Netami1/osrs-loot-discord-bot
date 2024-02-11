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
            LootTables::KRIL_TSUROTH_ALWAYS_ID => [
                [
                    'id' => 'a849546b-586d-4ed7-93ca-42bd519fc184',
                    'item_name' => 'Inferanl ashes',
                    'item_id' => '25778',
                ],
            ],
            LootTables::KRIL_TSUROTH_PRIMARY_ID => [
                [
                    'id' => '1cdb2cd8-76f3-45a9-9070-e6e59d8f0d8e',
                    'item_name' => 'Rune scimitar',
                    'item_id' => '1333',
                    'chance' => 0.062992125984252,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => '5bc64474-055d-4695-aaee-8c9a96e9c39c',
                    'item_name' => 'Adamant platebody',
                    'item_id' => '1123',
                    'chance' => 0.062992125984252,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => 'f5b929b9-c9e3-4351-821d-0645fbebeb5b',
                    'item_name' => 'Rune platelegs',
                    'item_id' => '1079',
                    'chance' => 0.05511811023622,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => 'f210c5ba-cbb8-4f3a-820e-e7cd38d1159c',
                    'item_name' => 'Dragon dagger(p++)',
                    'item_id' => '5698',
                    'chance' => 0.015748031496063,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => '9a2e1be4-355f-4ba4-9c4f-88fc1503723d',
                    'item_name' => 'Super attack(3)',
                    'item_id' => '145',
                    'chance' => 0.062992125984252,
                    'min' => 3,
                    'max' => 3,
                ],
                [
                    'id' => 'c2321230-7863-4b5c-be29-8483a27dee57',
                    'item_name' => 'Super strength(3)',
                    'item_id' => '157',
                    'chance' => 0.062992125984252,
                    'min' => 3,
                    'max' => 3,
                ],
                [
                    'id' => '4c186834-942b-421e-803b-1a478d97f49c',
                    'item_name' => 'Super restore(3)',
                    'item_id' => '3026',
                    'chance' => 0.062992125984252,
                    'min' => 3,
                    'max' => 3,
                ],
                [
                    'id' => '0c42ddab-27af-4633-bbbe-98de6946fefa',
                    'item_name' => 'Zamorak brew(3)',
                    'item_id' => '189',
                    'chance' => 0.062992125984252,
                    'min' => 3,
                    'max' => 3,
                ],
                [
                    'id' => 'aaa50872-74db-407b-998b-9771b2239160',
                    'item_name' => 'Coins',
                    'item_id' => '995',
                    'chance' => 0.28897637795276,
                    'min' => 19500,
                    'max' => 20000,
                ],
                [
                    'id' => '42f26e39-9bd7-4c0c-a94d-96a20f2e2a2c',
                    'item_name' => 'Grimy lantadyme',
                    'item_id' => '2485',
                    'chance' => 0.062992125984252,
                    'min' => 10,
                    'max' => 10,
                ],
                [
                    'id' => '022860ea-5e43-4410-9347-7204169b5ec7',
                    'item_name' => 'Steam battlestaff',
                    'item_id' => '11787',
                    'chance' => 0.0078740157480315,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => '0dee287c-b191-4cc9-a0ff-c0875f6cfac9',
                    'item_name' => 'Lantadyme seed',
                    'item_id' => '5302',
                    'chance' => 0.062992125984252,
                    'min' => 3,
                    'max' => 3,
                ],
                [
                    'id' => '50e1bb36-b159-4497-b626-b9a389b98fac',
                    'item_name' => 'Death rune',
                    'item_id' => '560',
                    'chance' => 0.062992125984252,
                    'min' => 120,
                    'max' => 125,
                ],
                [
                    'id' => '4a8001cd-fd0b-41d0-8f37-40d37d8bc00f',
                    'item_name' => 'Blood rune',
                    'item_id' => '565',
                    'chance' => 0.062992125984252,
                    'min' => 80,
                    'max' => 85,
                ],
                [
                    'id' => '14b65e55-7e31-4110-9aa8-ce32900cebe0',
                    'item_name' => 'Rune sword',
                    'item_id' => '1289',
                    'chance' => 0.0024606299212598,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => '98528011-17b7-457e-a132-e5ccbba2da3c',
                    'item_name' => 'Zamorakian spear',
                    'item_id' => '11824',
                    'chance' => 0.0078740157480315,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => 'f83b4c52-43e5-4162-a0a2-bb3f4219cc5d',
                    'item_name' => 'Staff of the dead',
                    'item_id' => '11791',
                    'chance' => 0.0019685039370079,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => 'd21cd579-56bc-4275-9354-74dcce57431b',
                    'item_name' => 'Zamorak hilt',
                    'item_id' => '11816',
                    'chance' => 0.0019685039370079,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => '473edf4a-5f15-4a54-a54c-e5d34940c93a',
                    'item_name' => 'Godsword shard 1',
                    'item_id' => '11818',
                    'chance' => 0.0013123359580052,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => 'dbbb316c-93ed-4af5-af6c-62b35951ffe2',
                    'item_name' => 'Godsword shard 2',
                    'item_id' => '11820',
                    'chance' => 0.0013123359580052,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => '2a3a0f56-e96a-4494-8837-adc85cacf79f',
                    'item_name' => 'Godsword shard 3',
                    'item_id' => '11822',
                    'chance' => 0.0013123359580052,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => '5254d96a-0dbb-424f-b49b-b9b151875d56',
                    'item_name' => 'Adamant arrow(p++)',
                    'item_id' => '5626',
                    'chance' => 0.062992125984252,
                    'min' => 295,
                    'max' => 300,
                ],
            ],
            LootTables::KRIL_TSUROTH_TERTIARY_ID => [
                [
                    'id' => '31d897e5-17b9-46f3-b40b-f8e54e4e9a1b',
                    'item_name' => 'Clue scroll (elite)',
                    'item_id' => '12073',
                    'chance' => 0.004,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => 'cc51fe62-86e2-44aa-a98b-7da4c6ee4f52',
                    'item_name' => 'Pet k\'ril tsutsaroth',
                    'item_id' => '12652',
                    'chance' => 0.0002,
                    'min' => 1,
                    'max' => 1,
                ],
            ],
            LootTables::COMMAND_ZILYANA_ALWAYS_ID => [
                [
                    'id' => 'bf3cb625-cb92-4d8d-a615-4b22cbf7b81a',
                    'item_name' => self::BONES_NAME,
                    'item_id' => self::BONES_ID,
                ],
            ],
            LootTables::COMMAND_ZILYANA_PRIMARY_ID => [
                [
                    'id' => 'f13a4558-4fa9-412a-88d9-6c3548cfa764',
                    'item_name' => 'Rune dart',
                    'item_id' => '811',
                    'chance' => 0.062992125984252,
                    'min' => 35,
                    'max' => 40,
                ],
                [
                    'id' => '288f9fb1-ef79-41ea-ae9c-2f4f35680787',
                    'item_name' => 'Rune kiteshield',
                    'item_id' => '1201',
                    'chance' => 0.062992125984252,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => 'df1c1218-bd43-4fff-a209-6006d70c2d92',
                    'item_name' => 'Rune plateskirt',
                    'item_id' => '1093',
                    'chance' => 0.062992125984252,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => '61e9c86c-6e57-4c3f-8fde-fc8fb4193f42',
                    'item_name' => 'Prayer potion(4)',
                    'item_id' => '2434',
                    'chance' => 0.062992125984252,
                    'min' => 3,
                    'max' => 3,
                ],
                [
                    'id' => 'ec445926-5e51-48a1-9958-59a608fe8bf0',
                    'item_name' => 'Saradomin brew(3)',
                    'item_id' => '6687',
                    'chance' => 0.047244094488189,
                    'min' => 3,
                    'max' => 3,
                ],
                [
                    'id' => '41cf97f0-93ab-4c8e-9a8a-5d9ddede92ac',
                    'item_name' => 'Super restore(4)',
                    'item_id' => '3024',
                    'chance' => 0.047244094488189,
                    'min' => 3,
                    'max' => 3,
                ],
                [
                    'id' => 'c971990a-b48c-443c-b138-faa12d736a12',
                    'item_name' => 'Super defence(3)',
                    'item_id' => '163',
                    'chance' => 0.062992125984252,
                    'min' => 3,
                    'max' => 3,
                ],
                [
                    'id' => 'c810cf4e-a165-41dc-8445-84e7cb56def0',
                    'item_name' => 'Magic potion(3)',
                    'item_id' => '3042',
                    'chance' => 0.062992125984252,
                    'min' => 3,
                    'max' => 3,
                ],
                [
                    'id' => '6c551676-02e5-4d39-86e4-bbb000b6cd1b',
                    'item_name' => 'Coins',
                    'item_id' => '995',
                    'chance' => 0.24566929133858,
                    'min' => 19500,
                    'max' => 20000,
                ],
                [
                    'id' => '0cc4f49e-6174-4d89-a736-29b372b2f989',
                    'item_name' => 'Diamond',
                    'item_id' => '1601',
                    'chance' => 0.062992125984252,
                    'min' => 6,
                    'max' => 6,
                ],
                [
                    'id' => 'a1df05b6-b80c-4f00-a2ef-a6379562eb69',
                    'item_name' => 'Saradomin sword',
                    'item_id' => '11838',
                    'chance' => 0.0078740157480315,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => 'e3c1f0d1-ad76-4d6a-bbb2-21cf1e22c842',
                    'item_name' => 'Law rune',
                    'item_id' => '563',
                    'chance' => 0.062992125984252,
                    'min' => 95,
                    'max' => 100,
                ],
                [
                    'id' => 'd1265c2d-aac9-47d0-97ee-a4b0a75a69ec',
                    'item_name' => 'Grimy ranarr weed',
                    'item_id' => '207',
                    'chance' => 0.062992125984252,
                    'min' => 5,
                    'max' => 5,
                ],
                [
                    'id' => '42bcec03-907e-4299-8119-0352decdb8ae',
                    'item_name' => 'Ranarr seed',
                    'item_id' => '5295',
                    'chance' => 0.062992125984252,
                    'min' => 2,
                    'max' => 2,
                ],
                [
                    'id' => 'fc2a9353-45e8-45f6-bf36-c782f6052df8',
                    'item_name' => 'Magic seed',
                    'item_id' => '5316',
                    'chance' => 0.0078740157480315,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => 'c7442f61-f1fd-42ca-981c-3f8f3157fc7a',
                    'item_name' => 'Rune sword',
                    'item_id' => '1289',
                    'chance' => 0.0024606299212598,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => '6f3a5d15-3f9c-4542-bd69-062921b95ae1',
                    'item_name' => 'Saradomin\'s light',
                    'item_id' => '13256',
                    'chance' => 0.0039370078740157,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => '19aa2396-fc03-4585-8140-4699caca1405',
                    'item_name' => 'Armadyl crossbow',
                    'item_id' => '11785',
                    'chance' => 0.0019685039370079,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => '271cf28f-d2aa-4c9c-b4f1-748d9cb9437e',
                    'item_name' => 'Saradomin hilt',
                    'item_id' => '11814',
                    'chance' => 0.0019685039370079,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => 'c689a33b-3d75-4848-8835-ab0231422a2e',
                    'item_name' => 'Godsword shard 1',
                    'item_id' => '11818',
                    'chance' => 0.0013123359580052,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => '20707c73-e924-4344-b485-bf61a70bd4b9',
                    'item_name' => 'Godsword shard 2',
                    'item_id' => '11820',
                    'chance' => 0.0013123359580052,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => '64d6cb6d-cd6c-47f7-8117-5a480273329d',
                    'item_name' => 'Godsword shard 3',
                    'item_id' => '11822',
                    'chance' => 0.0013123359580052,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => 'a64e3555-df42-41fd-aecc-21880d6e527e',
                    'item_name' => 'Adamant platebody',
                    'item_id' => '1123',
                    'chance' => 0.062992125984252,
                    'min' => 1,
                    'max' => 1,
                ],
            ],
            LootTables::COMMAND_ZILYANA_TERTIARY_ID => [
                [
                    'id' => '02aef5f0-c552-40b1-94a6-71c4387a2118',
                    'item_name' => 'Clue scroll (elite)',
                    'item_id' => '12073',
                    'chance' => 0.004,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => 'a9be1a71-c223-4c02-920c-044f0eaa0cd0',
                    'item_name' => 'Pet zilyana',
                    'item_id' => '12651',
                    'chance' => 0.0002,
                    'min' => 1,
                    'max' => 1,
                ],
            ],
            LootTables::KREEARRA_ALWAYS_ID => [
                [
                    'id' => 'fb6f4da2-5a72-459f-b0cd-20437262449d',
                    'item_name' => self::BIG_BONES_NAME,
                    'item_id' => self::BIG_BONES_ID,
                ],
                [
                    'id' => '1343e3a2-40a1-48e6-9aed-ea6be7c0109d',
                    'item_name' => 'Feather',
                    'item_id' => '314',
                    'min' => 1,
                    'max' => 16,
                ],
            ],
            LootTables::KREEARRA_PRIMARY_ID => [
                [
                    'id' => 'e4789962-e69f-487c-a9d7-1dfff5d4a090',
                    'item_name' => 'Black d\'hide body',
                    'item_id' => '2503',
                    'chance' => 0.062992125984252,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => '8add2530-2aaa-4126-821b-d78c82679a30',
                    'item_name' => 'Rune crossbow',
                    'item_id' => '9185',
                    'chance' => 0.062992125984252,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => '2eef2bb3-58dd-4033-874d-84eb25f7facb',
                    'item_name' => 'Mind rune',
                    'item_id' => '558',
                    'chance' => 0.062992125984252,
                    'min' => 586,
                    'max' => 601,
                ],
                [
                    'id' => 'bb36f0e0-84a3-49fa-b0f0-3566467dab7c',
                    'item_name' => 'Rune arrow',
                    'item_id' => '892',
                    'chance' => 0.062992125984252,
                    'min' => 100,
                    'max' => 105,
                ],
                [
                    'id' => '9a024505-6986-45d8-bb2f-e7fa2616bea1',
                    'item_name' => 'Runite bolts',
                    'item_id' => '9144',
                    'chance' => 0.062992125984252,
                    'min' => 20,
                    'max' => 25,
                ],
                [
                    'id' => 'dba44990-f502-4826-b487-93c729453e43',
                    'item_name' => 'Dragonstone bolts (e)',
                    'item_id' => '9244',
                    'chance' => 0.062992125984252,
                    'min' => 5,
                    'max' => 10,
                ],
                [
                    'id' => '6b3702dd-8809-4507-836a-828985486b2a',
                    'item_name' => 'Coins',
                    'item_id' => '995',
                    'chance' => 0.34409448818898,
                    'min' => 19500,
                    'max' => 20000,
                ],
                [
                    'id' => '287d4629-6259-419d-b21a-07134cce05de',
                    'item_name' => 'Ranging potion(3)',
                    'item_id' => '169',
                    'chance' => 0.062992125984252,
                    'min' => 3,
                    'max' => 3,
                ],
                [
                    'id' => 'c4ca1b1e-08a3-4289-9d75-6370942d239b',
                    'item_name' => 'Super defence(3)',
                    'item_id' => '163',
                    'chance' => 0.062992125984252,
                    'min' => 3,
                    'max' => 3,
                ],
                [
                    'id' => '83d60b33-d505-48b7-b377-104c8dd0e99b',
                    'item_name' => 'Grimy dwarf weed',
                    'item_id' => '217',
                    'chance' => 0.062992125984252,
                    'min' => 8,
                    'max' => 13,
                ],
                [
                    'id' => '59ee1b1b-bb56-44f3-8d03-924379dd4453',
                    'item_name' => 'Dwarf weed seed',
                    'item_id' => '5303',
                    'chance' => 0.062992125984252,
                    'min' => 3,
                    'max' => 3,
                ],
                [
                    'id' => 'a980bffe-c545-4335-97b5-800128d3bc0b',
                    'item_name' => 'Coins',
                    'item_id' => '995',
                    'chance' => 0.0098425196850394,
                    'min' => 20500,
                    'max' => 21000,
                ],
                [
                    'id' => '5b388bb1-d58b-43ea-aecc-953267179b6e',
                    'item_name' => 'Crystal key',
                    'item_id' => '989',
                    'chance' => 0.0078740157480315,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => '29ab6133-e860-48ad-88c3-801f4c10c4e0',
                    'item_name' => 'Yew seed',
                    'item_id' => '5315',
                    'chance' => 0.0078740157480315,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => '384ee48b-4ecc-4b83-8e4d-0a6685e2669f',
                    'item_name' => 'Rune sword',
                    'item_id' => '1289',
                    'chance' => 0.0024606299212598,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => 'b2572958-f513-4fde-b72a-6cff646d4a42',
                    'item_name' => 'Armadyl helmet',
                    'item_id' => '11826',
                    'chance' => 0.0026246719160105,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => 'f9f0e965-ce68-45f1-bc2f-cca007112408',
                    'item_name' => 'Armadyl chestplate',
                    'item_id' => '11828',
                    'chance' => 0.0026246719160105,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => 'c283f5ad-79ee-4952-9436-b5e29adf3208',
                    'item_name' => 'Armadyl chainskirt',
                    'item_id' => '11830',
                    'chance' => 0.0026246719160105,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => '611f69e5-f65d-41f3-8682-4da995f3c69f',
                    'item_name' => 'Armadyl hilt',
                    'item_id' => '11810',
                    'chance' => 0.0019685039370079,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => 'b4884bb1-1c61-45f9-aad4-44024b1040f0',
                    'item_name' => 'Godsword shard 1',
                    'item_id' => '11818',
                    'chance' => 0.0013123359580052,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => '3d6d3b44-a65f-456d-ae96-aec3adba0b69',
                    'item_name' => 'Godsword shard 2',
                    'item_id' => '11820',
                    'chance' => 0.0013123359580052,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => 'db7247f0-e3da-49ec-be41-1b4dcdd180d2',
                    'item_name' => 'Godsword shard 3',
                    'item_id' => '11822',
                    'chance' => 0.0013123359580052,
                    'min' => 1,
                    'max' => 1,
                ],
            ],
            LootTables::KREEARRA_TERTIARY_ID => [
                [
                    'id' => 'a2286148-05cf-468e-8fd9-f4c31dd301e9',
                    'item_name' => 'Clue scroll (elite)',
                    'item_id' => '12073',
                    'chance' => 0.004,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => 'b5067d61-e480-4520-8aae-29e79948f126',
                    'item_name' => 'Long bone',
                    'item_id' => '10976',
                    'chance' => 0.0025,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => '6b6c8646-f924-41bb-834f-5daa88746ea3',
                    'item_name' => 'Pet kree\'arra',
                    'item_id' => '12649',
                    'chance' => 0.0002,
                    'min' => 1,
                    'max' => 1,
                ],
                [
                    'id' => '05b56fad-a9bc-44f8-a292-4b248b2d73b8',
                    'item_name' => 'Curved bone',
                    'item_id' => '10977',
                    'chance' => 0.00019950124688279,
                    'min' => 1,
                    'max' => 1,
                ],
            ],
        ];
    }
}
