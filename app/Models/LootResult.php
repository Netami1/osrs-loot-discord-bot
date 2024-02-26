<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\LootResult
 *
 * @property mixed $lootResultItems
 * @property string $id
 * @property string $loot_source_id
 * @property int $quantity
 * @property string $discord_username
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read int|null $loot_result_items_count
 * @property-read \App\Models\LootSource $lootSource
 * @method static \Illuminate\Database\Eloquent\Builder|LootResult newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LootResult newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LootResult query()
 * @method static \Illuminate\Database\Eloquent\Builder|LootResult create($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LootResult whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LootResult whereDiscordUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LootResult whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LootResult whereLootSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LootResult whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LootResult whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

    public function imageFilename(): string
    {
        return "loot_{$this->id}.png";
    }
}
