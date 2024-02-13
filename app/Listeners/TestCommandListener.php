<?php

namespace App\Listeners;

use App\Services\LootGeneration\LootGeneratorService;
use App\Services\LootGeneration\LootRollResult;
use Illuminate\Contracts\Queue\ShouldQueue;
use Nwilging\LaravelDiscordBot\Contracts\Listeners\ApplicationCommandInteractionEventListenerContract;
use Nwilging\LaravelDiscordBot\Events\ApplicationCommandInteractionEvent;

class TestCommandListener implements ApplicationCommandInteractionEventListenerContract, ShouldQueue
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

        $replyContent = "## Results of killing {$quantity} {$sourceName}: " . kmb($lootResult->totalValue()) . PHP_EOL;
        $replyContent .= '### GP per kill: ' . kmb($lootResult->totalValue() / $quantity) . PHP_EOL;
        $replyContent .= '```' . PHP_EOL;

        /** @var LootRollResult $lootResult */
        foreach ($lootRollResults as $lootResult) {
            $replyContent .=  $lootResult->toString() . PHP_EOL;
        }
        $replyContent .= '```';

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
