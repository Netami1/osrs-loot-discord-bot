<?php

namespace App\Services;

use App\Models\Item;
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

        $itemDetails = $this->osrsService->getItemDetails($itemId);
        if (!$itemDetails) {
            return null;
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
}
