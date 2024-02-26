<?php

namespace App\Models;

use App\Enum\LootTypeEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\LootTable
 *
 * @property string $id
 * @property string $loot_source_id
 * @property LootTypeEnum $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $rolls
 * @property int|null $rolls_min
 * @property int|null $rolls_max
 * @property string $chance
 * @property-read \App\Models\LootSource|null $lootSource
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LootTableRoll> $lootTableRolls
 * @property-read int|null $loot_table_rolls_count
 * @method static \Illuminate\Database\Eloquent\Builder|LootTable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LootTable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LootTable query()
 * @method static \Illuminate\Database\Eloquent\Builder|LootTable whereChance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LootTable whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LootTable whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LootTable whereLootSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LootTable whereRolls($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LootTable whereRollsMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LootTable whereRollsMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LootTable whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LootTable whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class LootTable extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'loot_table';

    protected $fillable = [
        'loot_source_id',
        'type',
        'rolls',
        'rolls_min',
        'rolls_max',
        'chance',
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
