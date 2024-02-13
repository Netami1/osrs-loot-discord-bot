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
            ->select(['item_id', 'item_name'])
            ->distinct()
            ->get();

        $this->info('Creating missing items for loot rolls...');
        $created = 0;
        $lootTableRollsItemIds->filter(function (LootTableRoll $tableRoll) use ($itemRepo, $itemService) {
            return !$itemRepo->getItem($tableRoll->item_id);
        })->each(function (LootTableRoll $tableRoll) use (&$created, $itemService) {
            $item = $itemService->createItemFromApi($tableRoll->item_id, $tableRoll->item_name);
            $this->output->writeln("Created item {$item->__toString()}");
            $created++;
            sleep(1);
        });

        $this->output->writeln("Created {$created} items");
    }
}
