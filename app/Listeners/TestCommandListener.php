<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use Nwilging\LaravelDiscordBot\Contracts\Listeners\ApplicationCommandInteractionEventListenerContract;
use Nwilging\LaravelDiscordBot\Events\ApplicationCommandInteractionEvent;

class TestCommandListener implements ApplicationCommandInteractionEventListenerContract
{
    public function handle(ApplicationCommandInteractionEvent $event): void
    {

    }

    public function replyContent(ApplicationCommandInteractionEvent $event): ?string
    {
        Log::info('Event received', [
            'options' => $event->getInteractionRequest()->all()['data']['options'],
        ]);
        return "Dice roll: " . rand(1, 6);
    }

    public function behavior(ApplicationCommandInteractionEvent $event): int
    {
        return static::REPLY_TO_MESSAGE;
    }

    public function command(): ?string
    {
        return null;
    }
}
