<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use Nwilging\LaravelDiscordBot\Contracts\Listeners\ApplicationCommandInteractionEventListenerContract;
use Nwilging\LaravelDiscordBot\Events\ApplicationCommandInteractionEvent;

class TestCommandListener implements ApplicationCommandInteractionEventListenerContract
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function replyContent(ApplicationCommandInteractionEvent $event): ?string
    {
        return 'loading';
    }

    public function behavior(ApplicationCommandInteractionEvent $event): int
    {
        return static::LOAD_WHILE_HANDLING;
    }

    public function command(): ?string
    {
        return 'test-command';
    }

    public function handle(ApplicationCommandInteractionEvent $event): void
    {
        Log::info("Handled " . $event->getCommandName());
    }
}
