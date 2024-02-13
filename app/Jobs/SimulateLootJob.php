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
use Illuminate\Support\Facades\Log;
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

        $imageName = Str::random() . '.png';
        $imagePath = storage_path('/app/public/' . $imageName);

        Log::info('Saving image as ' . $imagePath);
        $image->toPng()->save($imagePath);

        $imageUri = env('APP_URL') . Storage::url($imageName);
        Log::info('Image URI: ' . $imageUri);

        //$notification = new LootSimulationNotification($this->commandRequest['channel_id'], $imageUri);
        $embedBuilder = new EmbedBuilder();
        $embedBuilder->addImage($imageUri);
        $payload = [
            'type' => 4,
            //'contentType' => 'rich',
            //'channelId' => $this->channelId,
            'embeds' => $embedBuilder->getEmbeds(),
        ];
        $responseUrl = 'https://discord.com/api/v10/interactions/%s/%s/messages/@original';
        $responseUrl = sprintf($responseUrl, $this->commandRequest['id'], $this->commandRequest['token']);
        Log::info('Sending response to Discord URL: ' . $responseUrl);
        $httpClient = Http::withHeaders([
            'Authorization' => 'Bot ' . env('DISCORD_API_BOT_TOKEN'),
        ]);
        $response = $httpClient->patch($responseUrl, $payload);
        Log::info('Response from Discord: ' . $response->status(), $response->json());
    }
}
