<?php

namespace App\Listeners;

use App\Services\LootGeneratorService;
use Nwilging\LaravelDiscordBot\Contracts\Listeners\ApplicationCommandInteractionEventListenerContract;
use Nwilging\LaravelDiscordBot\Events\ApplicationCommandInteractionEvent;

class TestCommandListener implements ApplicationCommandInteractionEventListenerContract
{
    public function handle(ApplicationCommandInteractionEvent $event): void
    {

    }

    public function replyContent(ApplicationCommandInteractionEvent $event): ?string
    {
        $options = $event->getInteractionRequest()->all()['data']['options'];
        $service = app(LootGeneratorService::class);
        $loots = $service->generateLoot($options);

        $replyContent = 'Results: ' . PHP_EOL;

        foreach ($loots as $lootName => $lootQuantity) {
            $replyContent .= $lootName . ': ' . $lootQuantity . PHP_EOL;
        }

        return $replyContent;
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
