<?php

namespace App\Models\StaticData;

use App\Enum\LootTypeEnum;

class LootTables
{
    public const CHICKEN_ALWAYS_ID = '831c65ad-7493-402c-b418-db8b0fe4de28';

    public function data(): array
    {
        return [
            [
                'id' => self::CHICKEN_ALWAYS_ID,
                'loot_source_id' => LootSources::CHICKEN_ID,
                'type' => LootTypeEnum::ALWAYS,
            ],
        ];
    }
}
