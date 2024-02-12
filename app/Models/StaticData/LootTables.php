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
    //
    public const KALPHITE_QUEEN_PRIMARY_ID = '29471292-3c49-4bba-a8c2-ccee4d3ec711';
    public const KALPHITE_QUEEN_TERTIARY_ID = 'aa165e1b-b6a3-48b0-9fbd-9d91261a468e';
    //
    public const CORPOREAL_BEAST_PRIMARY_ID = 'bcbfce5e-7dd4-42b0-87cd-1debc8908d84';
    public const CORPOREAL_BEAST_TERTIARY_ID = 'bf436919-391a-4d3b-865d-5da33d08c6ff';
    //
    public const ZULRAH_ALWAYS_ID = 'd7b77efd-da9e-4b4b-ba91-677a43fdf1e1';
    public const ZULRAH_PRIMARY_ID = 'e37742bd-8823-42ba-8f32-8ebbb1c3c2d2';
    public const ZULRAH_TERTIARY_ID = '4e68c18a-45b4-4ed4-970d-0f5e1fc84759';
    //
    public const VORKATH_ALWAYS_ID = '4ab542d0-6eac-442e-8373-22e629f293ba';
    public const VORKATH_PRIMARY_ID = 'efc50aec-69ae-44c0-84b0-6eb940b3c6fc';
    public const VORKATH_TERTIARY_ID = 'b2709ce7-0d87-46af-92db-a497f50266ce';
    //
    public const DAGANNOTH_REX_ALWAYS_ID = '662c8437-c49b-4547-8f00-8a845c3a0295';
    public const DAGANNOTH_REX_PRIMARY_ID = 'cdeea891-fb0a-4e5d-a094-79929357f0a0';
    public const DAGANNOTH_REX_TERTIARY_ID = '92019720-d114-4e30-a65d-1200f7caf11a';
    //
    public const DAGANNOTH_SUPREME_ALWAYS_ID = '2e149a50-fc92-4bad-b1f7-ad0392a255d7';
    public const DAGANNOTH_SUPREME_PRIMARY_ID = '43cebb8a-9630-4959-a2bb-44f814590d9d';
    public const DAGANNOTH_SUPREME_TERTIARY_ID = 'b03d2e25-c6d3-4847-95d9-3cb0d8bd0ab7';
    //
    public const DAGANNOTH_PRIME_ALWAYS_ID = 'b4650188-5e35-46b5-9db2-fd2b268711df';
    public const DAGANNOTH_PRIME_PRIMARY_ID = 'e93f4688-b834-45c7-852f-656a362edca0';
    public const DAGANNOTH_PRIME_TERTIARY_ID = '68e17219-323b-40a4-85b1-c82b9c31d5ba';
    //
    public const BARROWS_PRIMARY_ID = 'b707b1a9-559b-4248-8b48-c6c3ae3baec0';

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
            LootSources::KALPHITE_QUEEN_ID => [
                [
                    'id' => self::KALPHITE_QUEEN_PRIMARY_ID,
                    'type' => LootTypeEnum::PRIMARY,
                ],
                [
                    'id' => self::KALPHITE_QUEEN_TERTIARY_ID,
                    'type' => LootTypeEnum::TERTIARY,
                ],
            ],
            LootSources::CORPOREAL_BEAST_ID => [
                [
                    'id' => self::CORPOREAL_BEAST_PRIMARY_ID,
                    'type' => LootTypeEnum::PRIMARY,
                ],
                [
                    'id' => self::CORPOREAL_BEAST_TERTIARY_ID,
                    'type' => LootTypeEnum::TERTIARY,
                ],
            ],
            LootSources::ZULRAH_ID => [
                [
                    'id' => self::ZULRAH_ALWAYS_ID,
                    'type' => LootTypeEnum::ALWAYS,
                ],
                [
                    'id' => self::ZULRAH_PRIMARY_ID,
                    'type' => LootTypeEnum::PRIMARY,
                    'rolls' => 2,
                ],
                [
                    'id' => self::ZULRAH_TERTIARY_ID,
                    'type' => LootTypeEnum::TERTIARY,
                ],
            ],
            LootSources::VORKATH_ID => [
                [
                    'id' => self::VORKATH_ALWAYS_ID,
                    'type' => LootTypeEnum::ALWAYS,
                ],
                [
                    'id' => self::VORKATH_PRIMARY_ID,
                    'type' => LootTypeEnum::PRIMARY,
                    'rolls' => 2,
                ],
                [
                    'id' => self::VORKATH_TERTIARY_ID,
                    'type' => LootTypeEnum::TERTIARY,
                ],
            ],
            LootSources::DAGANNOTH_REX_ID => [
                [
                    'id' => self::DAGANNOTH_REX_ALWAYS_ID,
                    'type' => LootTypeEnum::ALWAYS,
                ],
                [
                    'id' => self::DAGANNOTH_REX_PRIMARY_ID,
                    'type' => LootTypeEnum::PRIMARY,
                ],
                [
                    'id' => self::DAGANNOTH_REX_TERTIARY_ID,
                    'type' => LootTypeEnum::TERTIARY,
                ],
            ],
            LootSources::DAGANNOTH_SUPREME_ID => [
                [
                    'id' => self::DAGANNOTH_SUPREME_ALWAYS_ID,
                    'type' => LootTypeEnum::ALWAYS,
                ],
                [
                    'id' => self::DAGANNOTH_SUPREME_PRIMARY_ID,
                    'type' => LootTypeEnum::PRIMARY,
                ],
                [
                    'id' => self::DAGANNOTH_SUPREME_TERTIARY_ID,
                    'type' => LootTypeEnum::TERTIARY,
                ],
            ],
            LootSources::DAGANNOTH_PRIME_ID => [
                [
                    'id' => self::DAGANNOTH_PRIME_ALWAYS_ID,
                    'type' => LootTypeEnum::ALWAYS,
                ],
                [
                    'id' => self::DAGANNOTH_PRIME_PRIMARY_ID,
                    'type' => LootTypeEnum::PRIMARY,
                ],
                [
                    'id' => self::DAGANNOTH_PRIME_TERTIARY_ID,
                    'type' => LootTypeEnum::TERTIARY,
                ],
            ],
            LootSources::BARROWS_ID => [
                [
                    'id' => self::BARROWS_PRIMARY_ID,
                    'type' => LootTypeEnum::PRIMARY,
                    'rolls' => 7,
                ],
            ],
        ];
    }
}
