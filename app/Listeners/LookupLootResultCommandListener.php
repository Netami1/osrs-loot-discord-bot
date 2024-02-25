<?php

namespace App\Listeners;

use App\Models\LootResult;
use App\Services\DiscordService;
use App\Services\ImageService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Nwilging\LaravelDiscordBot\Contracts\Listeners\ApplicationCommandInteractionEventListenerContract;
use Nwilging\LaravelDiscordBot\Events\ApplicationCommandInteractionEvent;

class LookupLootResultCommandListener implements ApplicationCommandInteractionEventListenerContract, ShouldQueue
{
    private DiscordService $discordService;
    private ImageService $imageService;

    public function __construct(DiscordService $discordService, ImageService $imageService)
    {
        $this->discordService = $discordService;
        $this->imageService = $imageService;
    }

    public function replyContent(ApplicationCommandInteractionEvent $event): ?string
    {
        return 'Loading...';
    }

    public function behavior(ApplicationCommandInteractionEvent $event): int
    {
        return static::REPLY_TO_MESSAGE;
    }

    public function command(): ?string
    {
        return 'lookup-loot';
    }

    public function handle(ApplicationCommandInteractionEvent $event): void
    {
        $eventData = $event->getInteractionRequest()->all();
        if ($eventData['data']['name'] !== $this->command()) {
            return;
        }
        Log::info('Handling lookup-loot command');

        $lootResultId = $eventData['data']['options'][0]['value'];
        $applicationId = $eventData['application_id'];
        $token = $eventData['token'];

        $lootResult = LootResult::query()->findOrFail($lootResultId);
        $lootResultFilename = $lootResult->imageFilename();
        $imagePath = storage_path('/app/public/' . $lootResultFilename);

        if (!Storage::exists($imagePath)) {
            $image = $this->imageService->createItemResultsImage($lootResult);
            $this->imageService->storeImage($image, $lootResultFilename);
        }

        $discordPayload = $this->discordService->createImageMessagePayload(
            config('app.url') . Storage::url($lootResultFilename),
            "## Results of {$lootResult->quantity} {$lootResult->lootSource->name}: " . kmb($lootResult->totalValue())
        );
        $this->discordService->editInteractionMessage(
            $applicationId,
            $token,
            $discordPayload
        );
    }
}
