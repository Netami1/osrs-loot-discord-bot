<?php

namespace App\Models\StaticData;

class LootSources
{
    public const CHICKEN_ID = 'bb4208f9-e957-4f54-a732-bb5871fd1fd6';
    public const CHICKEN_NAME = 'Chicken';
    //
    public const GENERAL_GRAARDOOR_ID = '399775d6-4c1e-4d6f-b3d6-d841ff95ec26';
    public const GENERAL_GRAARDOOR_NAME = 'General Graardoor';

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
        ];
    }
}
