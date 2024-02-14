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
        $lootTableRolls = LootTableRoll::query()
            ->whereNotNull('item_id')
            ->select(['item_id', 'item_name'])
            ->distinct()
            ->get();

        $this->info('Creating missing items for loot rolls...');
        $created = 0;

        $lootTableRollsMissingItems = $lootTableRolls->filter(function (LootTableRoll $tableRoll) use ($itemRepo) {
            return !$itemRepo->getItem($tableRoll->item_id);
        });

        $lootTableRollsMissingItems->each(function (LootTableRoll $tableRoll) use (&$created, $itemService) {
            $item = $itemService->createItemFromApi($tableRoll->item_id, $tableRoll->item_name);
            $this->output->writeln("Created item {$item->__toString()}");
            $created++;
            // Rate limit to avoid hitting the API too hard
            sleep(1);
        });

        $this->output->writeln("Created {$created} items");
    }
}
