<?php

namespace App\Listeners;

use App\Jobs\SimulateLootJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Nwilging\LaravelDiscordBot\Contracts\Listeners\ApplicationCommandInteractionEventListenerContract;
use Nwilging\LaravelDiscordBot\Events\ApplicationCommandInteractionEvent;

class KillCommandListener implements ApplicationCommandInteractionEventListenerContract, ShouldQueue
{
    public function replyContent(ApplicationCommandInteractionEvent $event): ?string
    {
        return 'Loading...';
    }

    public function behavior(ApplicationCommandInteractionEvent $event): int
    {
        return static::REPLY_TO_MESSAGE;
    }

    public function command(): ?string
    {
        return 'kill';
    }

    public function handle(ApplicationCommandInteractionEvent $event): void
    {
        $commandRequest = $event->getInteractionRequest()->all();

        SimulateLootJob::dispatch($commandRequest)->onConnection('redis');
    }
}
