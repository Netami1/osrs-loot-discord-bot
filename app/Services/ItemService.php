<?php

namespace App\Services;

use App\Models\Item;
use App\Models\LootTableRoll;
use App\Repos\ItemRepo;

class ItemService
{
    private ItemRepo $itemRepo;
    private WikiService $wikiService;

    public function __construct(ItemRepo $itemRepo, WikiService $wikiService)
    {
        $this->itemRepo = $itemRepo;
        $this->wikiService = $wikiService;
    }

    public function getOrFetchItem(int $itemId): ?Item
    {
        $item = $this->itemRepo->getItem($itemId);

        if ($item) {
            return $item;
        }

        $lootRollResult = LootTableRoll::query()
            ->where('item_id', $itemId)
            ->firstOrFail();

        return $this->createItemFromApi($itemId, $lootRollResult->item_name);
    }

    public function createItemFromApi(int $itemId, string $itemName): Item
    {
        $price = $this->wikiService->getItemPrice($itemId);
        $icon = $this->wikiService->getItemIconUrlByName($itemName);

        $creationArr = [
            'id' => $itemId,
            'name' => $itemName,
            'icon' => $icon,
            'price' => $price,
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
        $icon = $this->wikiService->getItemIconUrlByName($lootTableRoll->item_name);

        $creationArr = [
            'id' => $itemId,
            'name' => $lootTableRoll->item_name,
            'icon' => $icon,
            'price' => $price,
        ];

        return $this->itemRepo->createItem($creationArr);
    }
}
