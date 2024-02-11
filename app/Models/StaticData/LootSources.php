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
        ];
    }
}
