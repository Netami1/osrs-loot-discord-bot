<?php

namespace App\Console\Commands;

use App\Models\LootSource;
use App\Services\LootGeneration\LootGeneratorService;
use App\Services\LootGeneration\LootResult;
use App\Services\LootGeneration\LootRollResult;
use Illuminate\Console\Command;

class KillCommand extends Command
{
    protected $signature = 'kill {--monster=} {--times=1}';
    protected $description = 'Kill a monster';

    public function handle(LootGeneratorService $lootGeneratorService): void
    {
        $monsterName = $this->input->getOption('monster');
        $times = $this->input->getOption('times');

        $this->info("Killing {$monsterName} {$times} times...");

        /** @var LootSource $lootSource */
        $lootSource = LootSource::query()->where('name', $monsterName)->firstOrFail();
        $tableResults = $lootGeneratorService->processLootTables($lootSource, $times);
        $lootResult = (new LootResult())
            ->setSource($lootSource)
            ->setQuantity($times)
            ->setLootRollResults($tableResults);
        $lootRollResults = $lootResult->getLootRollResults()->sortByDesc(function (LootRollResult $lootRollResult) {
            return $lootRollResult->totalValue();
        });

        $this->output->writeln("## Results of killing {$times} {$monsterName}s: " . kmb($lootResult->totalValue()));
        $this->output->writeln('### GP per kill: ' . kmb($lootResult->totalValue() / $times));

        /** @var LootRollResult $lootResult */
        foreach ($lootRollResults as $lootResult) {
            $this->output->writeln($lootResult->toString());
        }
    }
}
