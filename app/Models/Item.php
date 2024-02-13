<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'icon',
        'price',
    ];

    public function __toString(): string
    {
        return $this->name . ' (' . $this->id . ')' . ' - ' . kmb($this->price);
    }
}
