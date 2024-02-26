<?php

namespace App\Models;

use App\Enum\LootTypeEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\LootSource
 *
 * @property string $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $enabled
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LootTable> $lootTables
 * @property-read int|null $loot_tables_count
 * @method static \Illuminate\Database\Eloquent\Builder|LootSource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LootSource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LootSource query()
 * @method static \Illuminate\Database\Eloquent\Builder|LootSource whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LootSource whereEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LootSource whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LootSource whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LootSource whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
