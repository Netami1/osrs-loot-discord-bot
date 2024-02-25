<?php

namespace App\Listeners;

use App\Jobs\LookupLootJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Nwilging\LaravelDiscordBot\Contracts\Listeners\ApplicationCommandInteractionEventListenerContract;
use Nwilging\LaravelDiscordBot\Events\ApplicationCommandInteractionEvent;

class LookupLootResultCommandListener implements ApplicationCommandInteractionEventListenerContract, ShouldQueue
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
        return 'lookup-loot';
    }

    public function handle(ApplicationCommandInteractionEvent $event): void
    {
        $eventData = $event->getInteractionRequest()->all();
        if ($eventData['data']['name'] !== $this->command()) {
            return;
        }
        Log::info('Handling lookup-loot command');

        LookupLootJob::dispatch($eventData)->onConnection('redis');
    }
}
