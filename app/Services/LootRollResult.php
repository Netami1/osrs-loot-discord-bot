<?php

namespace App\Services;

class LootRollResult
{
    private int $itemId;

    private string $itemName;

    private int $quantity;

    public function getItemId(): int
    {
        return $this->itemId;
    }

    public function getItemName(): string
    {
        return $this->itemName;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setItemId(int $itemId): self
    {
        $this->itemId = $itemId;

        return $this;
    }

    public function setItemName(string $itemName): self
    {
        $this->itemName = $itemName;

        return $this;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function toString(): string
    {
        return $this->getItemName() . ': ' . $this->getQuantity();
    }
}
