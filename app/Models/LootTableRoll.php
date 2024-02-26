<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LootTableRoll
 *
 * @property string $id
 * @property string $loot_table_id
 * @property string|null $item_name
 * @property string|null $item_id
 * @property string $chance
 * @property int $min
 * @property int $max
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|LootTableRoll newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LootTableRoll newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LootTableRoll query()
 * @method static \Illuminate\Database\Eloquent\Builder|LootTableRoll whereChance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LootTableRoll whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LootTableRoll whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LootTableRoll whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LootTableRoll whereItemName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LootTableRoll whereLootTableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LootTableRoll whereMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LootTableRoll whereMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LootTableRoll whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class LootTableRoll extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'loot_table_roll';

    protected $fillable = [
        'item_name',
        'item_id',
        'chance',
        'min',
        'max',
        'loot_table_id',
    ];
}
