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

    public function getOrCreateItem(int $itemId): ?Item
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

    public function updateItemPrice(Item $item): void
    {
        $price = $this->wikiService->getItemPrice($item->id);
        if ($price) {
            $item->update(['price' => $price]);
        }
    }
}
