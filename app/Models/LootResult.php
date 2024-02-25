<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LootResult extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'loot_results';

    protected $fillable = [
        'loot_source_id',
        'quantity',
        'discord_username',
    ];

    public function lootSource(): BelongsTo
    {
        return $this->belongsTo(LootSource::class);
    }

    public function lootResultItems(): HasMany
    {
        return $this->hasMany(LootResultItem::class);
    }

    public function totalValue(): int
    {
        return $this->lootResultItems->sum(fn (LootResultItem $lootResultItem) => $lootResultItem->total_value);
    }
}
