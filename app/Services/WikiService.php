<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WikiService
{
    private const USER_AGENT = 'Netami-Loot-Bot';

    public function getItemIconUrlById(int $itemId): string
    {
        /** @var Item $item */
        $item = Item::query()->findOrFail($itemId);

        return $this->getItemIconUrl($item);
    }

    public function getItemIconUrl(Item $item): string
    {
        return $this->getItemIconUrlByName($item->name);
    }

    public function getItemIconUrlByName(string $itemName): ?string
    {
        $baseUrl = config('wiki.item_icon_base_url');
        $itemName = str_replace(' ', '_', $itemName);
        $encodedItemName = urlencode($itemName);

        $url = sprintf(config($baseUrl), $encodedItemName);
        $response = Http::head($url);
        if ($response->status() !== 200) {
            // Let's try it with 5 at the end for stackable items
            $url = sprintf($baseUrl, $encodedItemName . '_5');
            $response = Http::head($url);
            if ($response->status() !== 200) {
                Log::warning('Failed to fetch icon for item ' . $itemName . ' from the wiki');
                return null;
            }
        }

        return $url;
    }

    public function getItemPrice(int $itemId): ?int
    {
        $itemDetails = $this->getItemPricingDetails($itemId);
        if (!$itemDetails) {
            return null;
        }

        return $itemDetails['high'];
    }

    public function getItemPricingDetails(int $itemId): ?array
    {
        $pricing = $this->getItemPricing()['data'];
        // Search the pricing array for id matching itemId
        return array_key_exists($itemId, $pricing) ? $pricing[$itemId] : null;
    }

    public function getItemPricing(): array
    {
        $pricingStoragePath = config('wiki.storage.pricing');

        if (!file_exists($pricingStoragePath)) {
            $this->downloadItemPricing();
        }

        return json_decode(file_get_contents($pricingStoragePath), true);
    }

    public function downloadItemPricing(): void
    {
        $pricingUrl = config('wiki.api.base_url') . config('wiki.api.latest');
        $pricingStoragePath = config('wiki.storage.pricing');
        $json = $this->makeApiRequest($pricingUrl);

        if (!$json) {
            Log::error('Failed to download item pricing from the wiki API');
            return;
        }

        file_put_contents($pricingStoragePath, json_encode($json));
    }

    public function getItemMappingDetailsById(int $itemId): ?array
    {
        $mapping = $this->getItemMapping();
        // Search the mapping array for id matching itemId
        return array_filter($mapping, fn($item) => $item['id'] === $itemId);
    }

    public function getItemMappingDetailsByName(string $itemName): ?array
    {
        $mapping = $this->getItemMapping();
        // Search the mapping array for id matching itemId
        return array_filter($mapping, fn($item) => $item['name'] === $itemName);
    }

    public function getItemMapping(): array
    {
        $itemMappingStoragePath =  config('wiki.storage.item_mapping');

        if (!file_exists($itemMappingStoragePath)) {
            $this->downloadItemMapping();
        }

        return json_decode(file_get_contents($itemMappingStoragePath), true);
    }

    public function downloadItemMapping(): void
    {
        $itemMappingUrl = config('wiki.api.base_url') . config('wiki.api.mapping');
        $itemMappingStoragePath = config('wiki.storage.item_mapping');

        $json = $this->makeApiRequest($itemMappingUrl);

        if (!$json) {
            Log::error('Failed to download item mapping from the wiki API');
            return;
        }

        file_put_contents($itemMappingStoragePath, json_encode($json));
    }

    private function makeApiRequest(string $url): ?array
    {
        $response = $this->httpClient()
            ->timeout(5)
            ->get($url);

        // We encountered an error when accessing the API
        if (!$response->successful()) {
            return null;
        }

        return $response->json();
    }

    private function httpClient(): PendingRequest
    {
        return Http::withHeaders(['User-Agent' => self::USER_AGENT]);
    }
}
