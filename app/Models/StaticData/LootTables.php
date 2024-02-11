<?php

namespace App\Models\StaticData;

use App\Enum\LootTypeEnum;

class LootTables
{
    public const CHICKEN_ALWAYS_ID = '831c65ad-7493-402c-b418-db8b0fe4de28';
    public const CHICKEN_PRIMARY_ID = 'b2ff51fd-c7ff-436b-9d71-07ccbed8655a';
    //
    public const GENERAL_GRAARDOOR_ALWAYS_ID = 'd1afdcf4-d051-4683-a913-485032028e9d';
    public const GENERAL_GRAARDOOR_PRIMARY_ID = 'cf33ba91-794e-4ffe-9d67-e4f1b106ca60';
    public const GENERAL_GRAARDOOR_TERTIARY_ID = '7fe8da27-a2ce-4a98-a5e4-33da9f9f65fa';

    public function data(): array
    {
        return [
            LootSources::CHICKEN_ID => [
                [
                    'id' => self::CHICKEN_ALWAYS_ID,
                    'type' => LootTypeEnum::ALWAYS,
                ],
                [
                    'id' => self::CHICKEN_PRIMARY_ID,
                    'type' => LootTypeEnum::PRIMARY,
                ],
            ],
            LootSources::GENERAL_GRAARDOOR_ID => [
                [
                    'id' => self::GENERAL_GRAARDOOR_ALWAYS_ID,
                    'type' => LootTypeEnum::ALWAYS,
                ],
                [
                    'id' => self::GENERAL_GRAARDOOR_PRIMARY_ID,
                    'type' => LootTypeEnum::PRIMARY,
                ],
                [
                    'id' => self::GENERAL_GRAARDOOR_TERTIARY_ID,
                    'type' => LootTypeEnum::TERTIARY,
                ],
            ],
        ];
    }
}
