<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WikiService
{
    private const USER_AGENT = 'Netami-Loot-Bot';
    private const MAPPING_URL = 'https://prices.runescape.wiki/api/v1/osrs/mapping';
    private CONST ITEM_ICON_BASE_URL = 'https://oldschool.runescape.wiki/images/%s.png';

    private string $mappingStoragePath;

    public function __construct()
    {
        $this->mappingStoragePath = storage_path('app/osrs_mapping.json');
    }

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
        $itemName = str_replace(' ', '_', $itemName);
        $encodedItemName = urlencode($itemName);

        $url = sprintf(self::ITEM_ICON_BASE_URL, $encodedItemName);
        $response = Http::head($url);
        if ($response->status() !== 200) {
            Log::warning('Failed to fetch icon for item ' . $itemName . ' from the wiki');
            return null;
        }

        return $url;
    }

    public function getItemDetails(int $itemId): ?array
    {
        $mapping = $this->getItemMapping();
        // Search the mapping array for id matching itemId
        return array_filter($mapping, fn($item) => $item['id'] === $itemId);
    }

    public function getItemMapping(): array
    {
        if (!file_exists($this->mappingStoragePath)) {
            $this->downloadItemMapping();
        }

        return json_decode(file_get_contents($this->mappingStoragePath), true);
    }

    public function downloadItemMapping(): void
    {
        $json = $this->makeApiRequest(self::MAPPING_URL);

        if (!$json) {
            Log::error('Failed to download item mapping from the wiki API');
            return;
        }

        file_put_contents($this->mappingStoragePath, json_encode($json));
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
