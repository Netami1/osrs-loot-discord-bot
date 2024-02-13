<?php

namespace App\Console\Commands;

use App\Models\LootTableRoll;
use App\Repos\ItemRepo;
use App\Services\ItemService;
use Illuminate\Console\Command;

class CreateItemsForLootRolls extends Command
{
    protected $signature = 'create-items';

    protected $description = 'Create items for loot rolls';

    public function handle(ItemService $itemService, ItemRepo $itemRepo): void
    {
        $lootTableRollsItemIds = LootTableRoll::query()
            ->whereNotNull('item_id')
            ->select(['item_id'])
            ->distinct()
            ->get()
            ->pluck('item_id');

        $this->info('Creating missing items for loot rolls...');
        $created = 0;
        $lootTableRollsItemIds->filter(function ($itemId) use ($itemRepo, $itemService) {
            return !$itemRepo->getItem($itemId);
        })->each(function ($itemId) use (&$created, $itemService) {
            $itemService->createItemFromApi($itemId);
            $this->output->writeln("Created item {$itemId}");
            $created++;
            sleep(1);
        });

        $this->output->writeln("Created {$created} items");
    }
}
