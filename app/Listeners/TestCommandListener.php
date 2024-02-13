<?php

namespace App\Listeners;

use App\Jobs\SimulateLootJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Nwilging\LaravelDiscordBot\Contracts\Listeners\ApplicationCommandInteractionEventListenerContract;
use Nwilging\LaravelDiscordBot\Events\ApplicationCommandInteractionEvent;

class TestCommandListener implements ApplicationCommandInteractionEventListenerContract, ShouldQueue
{
    public function replyContent(ApplicationCommandInteractionEvent $event): ?string
    {
        return null;
    }

    public function behavior(ApplicationCommandInteractionEvent $event): int
    {
        return static::DEFER_WHILE_HANDLING;
    }

    public function command(): ?string
    {
        return null;
    }

    public function handle(ApplicationCommandInteractionEvent $event): void
    {
        $commandRequest = $event->getInteractionRequest()->all();
        Log::info('Handling command', $commandRequest);

        $job = new SimulateLootJob($commandRequest);
        dispatch($job)->onQueue('redis');
    }
}
