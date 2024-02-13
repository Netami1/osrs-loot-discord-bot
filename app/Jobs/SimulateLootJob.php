<?php

namespace App\Jobs;

use App\Services\ImageService;
use App\Services\LootGeneration\LootGeneratorService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Nwilging\LaravelDiscordBot\Support\Builder\EmbedBuilder;

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

        $image = $imageService->createItemResultsImage($lootResult);

        $imageName = 'loot_' . Str::random() . '.png';
        $imagePath = storage_path('/app/public/' . $imageName);

        $image->toPng()->save($imagePath);

        $imageUri = env('APP_URL') . Storage::url($imageName);

        $embedBuilder = new EmbedBuilder();
        $embedBuilder->addImage($imageUri);
        $payload = [
            'type' => 4,
            'embeds' => $embedBuilder->toArray(),
            'content' => "## Results of killing {$lootResult->getQuantity()} {$lootResult->getSource()->name}: " . kmb($lootResult->totalValue()),
        ];
        $responseUrl = 'https://discord.com/api/v10/webhooks/%s/%s/messages/@original';
        $responseUrl = sprintf($responseUrl, $this->commandRequest['application_id'], $this->commandRequest['token']);
        $httpClient = Http::withHeaders([
            'Authorization' => 'Bot ' . env('DISCORD_API_BOT_TOKEN'),
        ]);
        $httpClient->patch($responseUrl, $payload);
    }
}
