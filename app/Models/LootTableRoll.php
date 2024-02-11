<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
