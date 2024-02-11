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
        $lootResult = $this->lootGeneratorService->generateLoot($options);
        $sourceName = $lootResult->getSource()->name;
        $quantity = $lootResult->getQuantity();
        $lootRollResults = $lootResult->getLootRollResults();

        $replyContent = "<b>Results of killing $quantity $sourceName\s: </b>" . PHP_EOL;

        /** @var LootRollResult $lootResult */
        foreach ($lootRollResults as $lootResult) {
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
