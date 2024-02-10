<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use Nwilging\LaravelDiscordBot\Events\ApplicationCommandInteractionEvent;

class TestCommandListener
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
    public function handle(ApplicationCommandInteractionEvent $event): void
    {
        Log::info('Test123');
    }
}
