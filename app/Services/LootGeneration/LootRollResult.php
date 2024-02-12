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

    public function getFormattedQuantity(): string
    {
        return kmb($this->quantity);
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
        $valueString =  ' (' . kmb($this->totalValue()) . ')';
        $mainString = "{$this->getFormattedQuantity()} x {$this->item->name}";

        if ($this->totalValue() > 0) {
            return $mainString . $valueString;
        }

        return $mainString;
    }

    public function totalValue(): int
    {
        return $this->quantity * $this->item->price;
    }
}
