<?php

namespace App\Services;

use App\Models\Item;
use App\Models\LootTableRoll;
use App\Repos\ItemRepo;

class ItemService
{
    private ItemRepo $itemRepo;
    private OsrsService $osrsService;

    public function __construct(ItemRepo $itemRepo, OsrsService $osrsService)
    {
        $this->itemRepo = $itemRepo;
        $this->osrsService = $osrsService;
    }

    public function getOrFetchItem(int $itemId): ?Item
    {
        $item = $this->itemRepo->getItem($itemId);

        if ($item) {
            return $item;
        }

        return $this->createItemFromApi($itemId);
    }

    public function createItemFromApi(int $itemId): Item
    {
        $itemDetails = $this->osrsService->getItemDetails($itemId);
        if (!$itemDetails) {
            return $this->createNonTradeAbleItem($itemId);
        }

        $price = str_replace(',', '', $itemDetails['item']['current']['price']);
        $priceInt = kmbToInt($price);

        $creationArr = [
            'id' => $itemDetails['item']['id'],
            'name' => $itemDetails['item']['name'],
            'icon' => $itemDetails['item']['icon'],
            'price' => $priceInt,
        ];

        return $this->itemRepo->createItem($creationArr);
    }

    private function createNonTradeAbleItem(int $itemId): Item
    {
        // Find the item in the LootTableRolls
        $lootTableRoll = LootTableRoll::query()
            ->where('item_id', $itemId)
            ->firstOrFail();

        // Coins should be worth 1 each
        $price = $itemId === 995 ? 1 : 0;

        // Try to get the icon from the wiki instead
        $wikiService = app(WikiService::class);
        $icon = $wikiService->getItemIconUrlByName($itemId);

        $creationArr = [
            'id' => $itemId,
            'name' => $lootTableRoll->item_name,
            'icon' => $icon,
            'price' => $price,
        ];

        return $this->itemRepo->createItem($creationArr);
    }
}
