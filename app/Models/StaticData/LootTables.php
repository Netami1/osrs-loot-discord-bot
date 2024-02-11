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
    //
    public const KRIL_TSUROTH_ALWAYS_ID = '6ea3ff7f-ea25-45ef-b369-fbf97964d418';
    public const KRIL_TSUROTH_PRIMARY_ID = 'bc7f108b-1cf4-4f26-8d71-4f8d01939372';
    public const KRIL_TSUROTH_TERTIARY_ID = 'b30ed72c-1bef-4313-a094-2b47d472058a';

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
            LootSources::KRIL_TSUROTH_ID => [
                [
                    'id' => self::KRIL_TSUROTH_ALWAYS_ID,
                    'type' => LootTypeEnum::ALWAYS,
                ],
                [
                    'id' => self::KRIL_TSUROTH_PRIMARY_ID,
                    'type' => LootTypeEnum::PRIMARY,
                ],
                [
                    'id' => self::KRIL_TSUROTH_TERTIARY_ID,
                    'type' => LootTypeEnum::TERTIARY,
                ],
            ],
        ];
    }
}
