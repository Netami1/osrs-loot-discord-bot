<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
