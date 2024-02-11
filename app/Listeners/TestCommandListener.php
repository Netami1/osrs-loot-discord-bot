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
            'command_name' => $event->getCommandName(),
            'command_id' => $event->getCommandId(),
            'command_type' => $event->getCommandType(),
            'bag' => $event->getInteractionRequest()->all(),
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
