<?php

namespace App\Models;

use App\Enum\LootTypeEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LootSource extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'loot_source';

    protected $fillable = [
        'name',
        'enabled',
    ];

    public function lootTables(): HasMany
    {
        return $this->hasMany(LootTable::class);
    }
}
