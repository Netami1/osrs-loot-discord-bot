<?php

namespace App\Services;

use App\Models\LootSource;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class LootGeneratorService
{
    private Collection $commandOptions;

    public function setCommandOptions(array $commandOptions): void
    {
        $this->commandOptions = collect($commandOptions);
    }

    public function generateLoot(): Collection
    {
        Log::info('Source' . $this->getLootSource());
        Log::info('Quantity' . $this->getQuantity());
        return new Collection();
    }

    private function getLootSource(): LootSource
    {
        $npcOption = $this->commandOptions->firstWhere('name', '=', 'npc');

        /** @var LootSource */
        return LootSource::query()
            ->where('name', $npcOption['value'])
            ->firstOrFail();
    }

    private function getQuantity(): int
    {
        $quantityOption = $this->commandOptions->firstWhere('name', '=', 'quantity');

        return $quantityOption['value'];
    }

}
