<?php

namespace App\Listeners;

use App\Services\LootGeneration\LootGeneratorService;
use App\Services\LootGeneration\LootRollResult;
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
        $lootRollResults = $lootResult->getLootRollResults()->sortByDesc(function (LootRollResult $lootRollResult) {
            return $lootRollResult->totalValue();
        });

        $replyContent = "## Results of killing {$quantity} {$sourceName}s: " . kmb($lootResult->totalValue()) . PHP_EOL . '```';

        /** @var LootRollResult $lootResult */
        foreach ($lootRollResults as $lootResult) {
            $replyContent .=  $lootResult->toString() . PHP_EOL;
        }
        $replyContent .= '```';

        return $replyContent;
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

    }
}
