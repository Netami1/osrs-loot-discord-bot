<?php

namespace App\Jobs;

use App\Models\LootResult;
use App\Services\DiscordService;
use App\Services\ImageService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class LookupLootJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $eventData;

    /**
     * Create a new job instance.
     */
    public function __construct(array $eventData)
    {
        $this->eventData = $eventData;
    }

    /**
     * Execute the job.
     */
    public function handle(ImageService $imageService, DiscordService $discordService): void
    {
        $lootResultId = $this->eventData['data']['options'][0]['value'];
        $applicationId = $this->eventData['application_id'];
        $token = $this->eventData['token'];

        $lootResult = LootResult::query()->findOrFail($lootResultId);
        $lootResultFilename = $lootResult->imageFilename();
        $imagePath = storage_path('/app/public/' . $lootResultFilename);

        if (!Storage::exists($imagePath)) {
            $image = $imageService->createItemResultsImage($lootResult);
            $imageService->storeImage($image, $lootResultFilename);
        }

        $discordPayload = $discordService->createImageMessagePayload(
            config('app.url') . Storage::url($lootResultFilename),
            "## Results of {$lootResult->quantity} {$lootResult->lootSource->name}: " . kmb($lootResult->totalValue())
        );
        $discordService->editInteractionMessage(
            $applicationId,
            $token,
            $discordPayload
        );
    }
}
