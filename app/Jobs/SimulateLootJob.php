<?php

namespace App\Jobs;

use App\Notifications\LootSimulationNotification;
use App\Services\ImageService;
use App\Services\LootGeneration\LootGeneratorService;
use App\Services\LootGeneration\LootRollResult;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class SimulateLootJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $commandRequest;

    /**
     * Create a new job instance.
     */
    public function __construct(array $commandRequest)
    {
        $this->commandRequest = $commandRequest;
    }

    /**
     * Execute the job.
     */
    public function handle(LootGeneratorService $lootGeneratorService, ImageService $imageService): void
    {
        $options = $this->commandRequest['data']['options'];
        $lootResult = $lootGeneratorService->generateLoot($options);
        /*$sourceName = $lootResult->getSource()->name;
        $quantity = $lootResult->getQuantity();
        $lootRollResults = $lootResult->getLootRollResults()->sortByDesc(function (LootRollResult $lootRollResult) {
            return $lootRollResult->totalValue();
        });

        $replyContent = "## Results of killing {$quantity} {$sourceName}: " . kmb($lootResult->totalValue()) . PHP_EOL;
        $replyContent .= '### GP per kill: ' . kmb($lootResult->totalValue() / $quantity) . PHP_EOL;
        $replyContent .= '```' . PHP_EOL;

        foreach ($lootRollResults as $lootRollResult) {
            $replyContent .=  $lootRollResult->toString() . PHP_EOL;
        }
        $replyContent .= '```';
        **/

        $image = $imageService->createItemResultsImage($lootResult);
        $imagePath = storage_path('app/public/' . Str::random() . '.png');
        Log::info('Saving image to ' . $imagePath);
        $image->toPng()->save($imagePath);

        $imageUri = url($imagePath);
        $notification = new LootSimulationNotification($this->commandRequest['channel_id'], $imageUri);
        Notification::send(['discord'], $notification);
    }
}
