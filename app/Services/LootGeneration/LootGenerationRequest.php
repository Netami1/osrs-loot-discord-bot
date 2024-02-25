<?php

namespace App\Services\LootGeneration;

use App\Models\LootSource;

class LootGenerationRequest
{
    private array $requestPayload;
    private LootSource $lootSource;
    private int $quantity;

    public function __construct(array $requestPayload)
    {
        $this->requestPayload = $requestPayload;
        $this->lootSource = $this->parseLootSource();
        $this->quantity = $this->parseQuantity();
    }

    public function getRequestPayload(): array
    {
        return $this->requestPayload;
    }

    public function getOptions(): array
    {
        return $this->requestPayload['data']['options'];
    }

    public function getDiscordUsername(): string
    {
        return $this->requestPayload['member']['user']['global_name'];
    }

    public function getToken(): string
    {
        return $this->requestPayload['token'];
    }

    public function getApplicationId(): string
    {
        return $this->requestPayload['application_id'];
    }

    public function getLootSource(): LootSource
    {
        return $this->lootSource;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    private function parseLootSource(): LootSource
    {
        $npcOption = collect($this->getOptions())->firstWhere('name', '=', 'target');

        return LootSource::query()
            ->where('name', $npcOption['value'])
            ->firstOrFail();
    }

    private function parseQuantity(): int
    {
        $quantityOption = collect($this->getOptions())->firstWhere('name', '=', 'quantity');

        return $quantityOption['value'];
    }
}
