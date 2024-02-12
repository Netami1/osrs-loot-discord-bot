<?php

namespace App\Services\LootGeneration;

use App\Models\Item;

class LootRollResult
{
    private Item $item;

    private int $quantity;

    public function getItem(): Item
    {
        return $this->item;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setItem(Item $item): self
    {
        $this->item = $item;

        return $this;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function toString(): string
    {
        return "{$this->quantity}x {$this->item->name}" . ' (' . kmb($this->totalValue()) . ')';
    }

    public function totalValue(): int
    {
        return $this->quantity * $this->item->price;
    }
}
