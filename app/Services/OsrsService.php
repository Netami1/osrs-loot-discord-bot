<?php

namespace App\Services;


use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class OsrsService
{
    private const USER_AGENT = 'Netami-Loot-Bot';
    private const API_URL = 'https://secure.runescape.com/m=itemdb_oldschool/api/catalogue/detail.json?item=';

    public function getItemDetails(int $itemId): ?array
    {
        $url = $this->buildItemUrl($itemId);

        return $this->makeApiRequest($url);
    }

    private function buildItemUrl(int $itemId): string
    {
        return self::API_URL . $itemId;
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
