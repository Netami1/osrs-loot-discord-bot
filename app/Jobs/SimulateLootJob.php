<?php

namespace App\Jobs;

use App\Services\DiscordService;
use App\Services\ImageService;
use App\Services\LootGeneration\LootGenerationRequest;
use App\Services\LootGeneration\LootGeneratorService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SimulateLootJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private LootGenerationRequest $lootGenerationRequest;

    /**
     * Create a new job instance.
     */
    public function __construct(LootGenerationRequest $lootGenerationRequest)
    {
        $this->lootGenerationRequest = $lootGenerationRequest;
    }

    /**
     * Execute the job.
     */
    public function handle(LootGeneratorService $lootGeneratorService, ImageService $imageService, DiscordService $discordService): void
    {
        $lootResult = $lootGeneratorService->generateLoot($this->lootGenerationRequest);

        $image = $imageService->createItemResultsImage($lootResult);
        $imageUri = $imageService->storeImage($image, $lootResult->imageFilename());
        $messageContent = "## Results of {$lootResult->quantity} {$lootResult->lootSource->name}: " . kmb($lootResult->totalValue());
        $messageContent .= PHP_EOL . 'Result ID: `' . $lootResult->id . '`';

        $discordPayload = $discordService->createImageMessagePayload($imageUri, $messageContent);
        $response = $discordService->editInteractionMessage(
            $this->lootGenerationRequest->getApplicationId(),
            $this->lootGenerationRequest->getToken(),
            $discordPayload
        );

        if (!$response->successful()) {
            Log::error('Failed to send loot results to Discord', [
                'response' => $response->json(),
                'payload' => $discordPayload,
            ]);
        }
    }


}
