<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\LootResultItem
 *
 * @property int $id
 * @property string $loot_result_id
 * @property int $item_id
 * @property int $quantity
 * @property int $total_value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Item $item
 * @property-read \App\Models\LootResult $lootResult
 * @method static \Illuminate\Database\Eloquent\Builder|LootResultItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LootResultItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LootResultItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|LootResultItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LootResultItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LootResultItem whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LootResultItem whereLootResultId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LootResultItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LootResultItem whereTotalValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LootResultItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class LootResultItem extends Model
{
    use HasFactory;

    protected $table = 'loot_result_items';

    protected $fillable = [
        'loot_result_id',
        'item_id',
        'quantity',
        'total_value',
    ];

    public function lootResult(): BelongsTo
    {
        return $this->belongsTo(LootResult::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function toString(): string
    {
        $valueString =  ' (' . kmb($this->total_value) . ')';
        $mainString = "{$this->quantity} x {$this->item->name}";

        if ($this->total_value > 0) {
            return $mainString . $valueString;
        }

        return $mainString;
    }

    public function toArray(): array
    {
        return [
            'item_id' => $this->item_id,
            'quantity' => $this->quantity,
            'total_value' => $this->total_value,
        ];
    }
}
