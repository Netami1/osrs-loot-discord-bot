<?php

namespace App\Listeners;

use App\Services\LootGeneratorService;
use App\Services\LootRollResult;
use Nwilging\LaravelDiscordBot\Contracts\Listeners\ApplicationCommandInteractionEventListenerContract;
use Nwilging\LaravelDiscordBot\Events\ApplicationCommandInteractionEvent;

class TestCommandListener implements ApplicationCommandInteractionEventListenerContract
{
    private LootGeneratorService $lootGeneratorService;

    public function __construct(LootGeneratorService $lootGeneratorService)
    {
        $this->lootGeneratorService = $lootGeneratorService;
    }

    public function replyContent(ApplicationCommandInteractionEvent $event): ?string
    {
        $options = $event->getInteractionRequest()->all()['data']['options'];
        $loots = $this->lootGeneratorService->generateLoot($options);

        $replyContent = 'Results: ' . PHP_EOL;

        /** @var LootRollResult $lootResult */
        foreach ($loots as $lootResult) {
            $replyContent .= $lootResult->getItemName()  . ' (' . $lootResult->getItemId() . '): ' . $lootResult->getQuantity() . PHP_EOL;
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

    public function handle(ApplicationCommandInteractionEvent $event): void
    {

    }
}
