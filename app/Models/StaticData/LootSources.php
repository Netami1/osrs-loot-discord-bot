<?php

namespace App\Models\StaticData;

class LootSources
{
    public const CHICKEN_ID = 'bb4208f9-e957-4f54-a732-bb5871fd1fd6';
    public const CHICKEN_NAME = 'Chicken';
    //
    public const GENERAL_GRAARDOOR_ID = '399775d6-4c1e-4d6f-b3d6-d841ff95ec26';
    public const GENERAL_GRAARDOOR_NAME = 'General Graardor';
    //
    public const KRIL_TSUROTH_ID = '29447f51-cb2b-4d9c-ab4d-fdfc2b60ca49';
    public const KRIL_TSUROTH_NAME = 'Kril';
    //
    public const COMMAND_ZILYANA_ID = '4cbd53ae-5752-4555-98e9-0b7d3856117d';
    public const COMMAND_ZILYANA_NAME = 'Commander Zilyana';
    //
    public const KREEARRA_ID = '7112572f-39e7-4b81-a3e1-2a8acd7452a2';
    public const KREEARRA_NAME = 'Kreearra';
    //
    public const GIANT_MOLE_ID = '2b5ba50d-5c59-4cca-9930-77b01be16b31';
    public const GIANT_MOLE_NAME = 'Giant Mole';
    //
    public const KALPHITE_QUEEN_ID = '45a86aa4-c77f-4e6a-b467-115dbb47a3ec';
    public const KALPHITE_QUEEN_NAME = 'Kalphite Queen';

    public function data(): array
    {
        return [
            [
                'id' => self::CHICKEN_ID,
                'name' => self::CHICKEN_NAME,
            ],
            [
                'id' => self::GENERAL_GRAARDOOR_ID,
                'name' => self::GENERAL_GRAARDOOR_NAME,
            ],
            [
                'id' => self::KRIL_TSUROTH_ID,
                'name' => self::KRIL_TSUROTH_NAME,
            ],
            [
                'id' => self::COMMAND_ZILYANA_ID,
                'name' => self::COMMAND_ZILYANA_NAME,
            ],
            [
                'id' => self::KREEARRA_ID,
                'name' => self::KREEARRA_NAME,
            ],
            [
                'id' => self::GIANT_MOLE_ID,
                'name' => self::GIANT_MOLE_NAME,
            ],
        ];
    }
}
