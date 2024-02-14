<?php

namespace App\Services\LootGeneration;

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

    public function getLootRollResultsByValueDesc(): Collection
    {
        return $this->lootRollResults->sortByDesc(function (LootRollResult $lootRollResult) {
            return $lootRollResult->totalValue();
        });
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

    public function totalValue(): int
    {
        return $this->lootRollResults->sum(function (LootRollResult $lootRollResult) {
            return $lootRollResult->totalValue();
        });
    }
}
