<?php

namespace App\Services;

use App\Models\LootSource;
use Illuminate\Support\Collection;

class LootResult
{
    private LootSource $source;

    private int $quantity;

    private Collection $lootRollResults;

    public function getSource(): LootSource
    {
        return $this->source;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getLootRollResults(): Collection
    {
        return $this->lootRollResults;
    }

    public function setSource(LootSource $source): self
    {
        $this->source = $source;

        return $this;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function setLootRollResults(Collection $lootRollResults): self
    {
        $this->lootRollResults = $lootRollResults;

        return $this;
    }
}
