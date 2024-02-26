<?php

namespace App\Jobs;

use App\Models\Item;
use App\Services\ItemService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UpdateItemPricesJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(ItemService $itemService): void
    {
        Log::info('Updating item prices...');

        $pricingStoragePath = config('wiki.storage.pricing');
        if (file_exists($pricingStoragePath)) {
            Storage::delete($pricingStoragePath);
        }

        $items = Item::query()->get();

        $items->each(function (Item $item) use ($itemService) {
            $itemService->updateItemPrice($item);
        });

        Log::info('Item prices updated');
    }
}
