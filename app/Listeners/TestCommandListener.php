<?php

namespace App\Listeners;

use Nwilging\LaravelDiscordBot\Contracts\Listeners\ApplicationCommandInteractionEventListenerContract;
use Nwilging\LaravelDiscordBot\Events\ApplicationCommandInteractionEvent;

class TestCommandListener implements ApplicationCommandInteractionEventListenerContract
{
    /**
     * Handle the event.
     */
    public function handle(ApplicationCommandInteractionEvent $event): void
    {

    }

    public function replyContent(ApplicationCommandInteractionEvent $event): ?string
    {
        return "test";
    }

    public function behavior(ApplicationCommandInteractionEvent $event): int
    {
        return static::REPLY_TO_MESSAGE;
    }

    public function command(): ?string
    {
        return 'test-command';
    }
}
