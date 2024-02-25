<?php

namespace App\Repos;

use App\Models\LootResult;
use App\Models\LootSource;

class LootResultRepo
{
    public function create(
        LootSource $source,
        int $quantity,
        string $discordUsername,
    ) {
        return LootResult::create([
            'loot_source_id' => $source->id,
            'quantity' => $quantity,
            'discord_username' => $discordUsername,
        ]);
    }
}
