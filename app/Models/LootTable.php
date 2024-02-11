<?php

namespace App\Models;

use App\Enum\LootTypeEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LootTable extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'loot_table';

    protected $fillable = [
        'loot_source_id',
        'type',
        'rolls',
    ];

    protected $casts = [
        'type' => LootTypeEnum::class,
    ];

    public function lootSource(): BelongsTo
    {
        return $this->belongsTo(LootSource::class);
    }

    public function lootTableRolls(): HasMany
    {
        return $this->hasMany(LootTableRoll::class);
    }
}
