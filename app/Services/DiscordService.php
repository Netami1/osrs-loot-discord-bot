<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Nwilging\LaravelDiscordBot\Support\Builder\EmbedBuilder;

class DiscordService
{
    private const DISCORD_BASE_URL = 'https://discord.com/api/v10/';

    private PendingRequest $httpClient;

    public function __construct()
    {
        $this->httpClient = Http::withHeaders([
            'Authorization' => 'Bot ' . env('DISCORD_API_BOT_TOKEN'),
        ]);
    }

    public function editInteractionMessage(string $applicationId, string $token, array $payload): bool
    {
        $url = self::DISCORD_BASE_URL . 'webhooks/%s/%s/messages/@original';
        $responseUrl = sprintf($url, $applicationId, $token);

        $response = $this->httpClient->patch($responseUrl, $payload);

        return $response->ok();
    }

    public function createImageMessagePayload(string $imageUri, string $messageContent): array
    {
        $embedBuilder = new EmbedBuilder();
        $embedBuilder->addImage($imageUri);
        return [
            'type' => 4,
            'embeds' => $embedBuilder->toArray(),
            'content' => $messageContent,
        ];
    }
}
