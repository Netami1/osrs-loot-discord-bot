<?php

namespace App\Repos;

use App\Models\Item;

class ItemRepo
{
    public function getItem(int $itemId): ?Item
    {
        /** @var Item */
        return Item::query()
            ->where('id', $itemId)
            ->first();
    }

    public function createItem(array $itemData): Item
    {
        return Item::create($itemData);
    }
}
