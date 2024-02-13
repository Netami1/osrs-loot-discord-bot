<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Nwilging\LaravelDiscordBot\Contracts\Notifications\DiscordNotificationContract;
use Nwilging\LaravelDiscordBot\Support\Builder\EmbedBuilder;

class LootSimulationNotification extends Notification implements DiscordNotificationContract
{
    use Queueable;

    private string $channelId;
    private string $imageUri;

    public function __construct(string $channelId, string $imageUri)
    {
        $this->channelId = $channelId;
        $this->imageUri = $imageUri;
    }

    public function via($notifiable)
    {
        return ['discord'];
    }

    public function toDiscord($notifiable): array
    {
        $embedBuilder = new EmbedBuilder();
        $embedBuilder->addImage($this->imageUri);

        return [
            'contentType' => 'rich',
            'channelId' => $this->channelId,
            'embeds' => $embedBuilder->getEmbeds(),
        ];
    }
}
