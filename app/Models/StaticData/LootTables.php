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
    //
    public const COMMAND_ZILYANA_ALWAYS_ID = '7416655c-e52a-4cee-b4a7-8fff1c96d742';
    public const COMMAND_ZILYANA_PRIMARY_ID = 'bf182173-43bb-482d-9645-f13f3e27fa9f';
    public const COMMAND_ZILYANA_TERTIARY_ID = '4f204412-b0fa-405f-89ed-6a608d55b04e';
    //
    public const KREEARRA_ALWAYS_ID = '8031fcc5-4b96-484b-9d2e-ecfb870e4783';
    public const KREEARRA_PRIMARY_ID = '04c96de2-6499-4e9e-b079-a5b817358739';
    public const KREEARRA_TERTIARY_ID = '57b93190-3909-4416-baa1-30f5fa05b1ab';
    //
    public const GIANT_MOLE_ALWAYS_ID = 'd30f2d26-afff-4e5f-80eb-94f846b181ff';
    public const GIANT_MOLE_PRIMARY_ID = '7b3d1720-e546-4c3f-9419-587a8a745a5b';
    public const GIANT_MOLE_TERTIARY_ID = 'f5d38715-e806-4069-9749-1e997b4d8cef';

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
            LootSources::COMMAND_ZILYANA_ID => [
                [
                    'id' => self::COMMAND_ZILYANA_ALWAYS_ID,
                    'type' => LootTypeEnum::ALWAYS,
                ],
                [
                    'id' => self::COMMAND_ZILYANA_PRIMARY_ID,
                    'type' => LootTypeEnum::PRIMARY,
                ],
                [
                    'id' => self::COMMAND_ZILYANA_TERTIARY_ID,
                    'type' => LootTypeEnum::TERTIARY,
                ],
            ],
            LootSources::KREEARRA_ID => [
                [
                    'id' => self::KREEARRA_ALWAYS_ID,
                    'type' => LootTypeEnum::ALWAYS,
                ],
                [
                    'id' => self::KREEARRA_PRIMARY_ID,
                    'type' => LootTypeEnum::PRIMARY,
                ],
                [
                    'id' => self::KREEARRA_TERTIARY_ID,
                    'type' => LootTypeEnum::TERTIARY,
                ],
            ],
            LootSources::GIANT_MOLE_ID => [
                [
                    'id' => self::GIANT_MOLE_ALWAYS_ID,
                    'type' => LootTypeEnum::ALWAYS,
                ],
                [
                    'id' => self::GIANT_MOLE_PRIMARY_ID,
                    'type' => LootTypeEnum::PRIMARY,
                ],
                [
                    'id' => self::GIANT_MOLE_TERTIARY_ID,
                    'type' => LootTypeEnum::TERTIARY,
                ],
            ],
        ];
    }
}
