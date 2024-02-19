<?php

namespace App\Jobs;

use App\Services\DiscordService;
use App\Services\ImageService;
use App\Services\LootGeneration\LootGeneratorService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

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
    public function handle(LootGeneratorService $lootGeneratorService, ImageService $imageService, DiscordService $discordService): void
    {
        $options = $this->commandRequest['data']['options'];
        $lootResult = $lootGeneratorService->generateLoot($options);

        $image = $imageService->createItemResultsImage($lootResult);
        $imageUri = $imageService->storeImage($image);
        $messageContent = "## Results of {$lootResult->getQuantity()} {$lootResult->getSource()->name}: " . kmb($lootResult->totalValue());
        Log::info('Loot results', ['image_uri' => $imageUri, 'message_content' => $messageContent]);

        $discordPayload = $discordService->createImageMessagePayload($imageUri, $messageContent);
        $response = $discordService->editInteractionMessage(
            $this->commandRequest['application_id'],
            $this->commandRequest['token'],
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
