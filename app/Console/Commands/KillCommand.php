<?php

namespace App\Console\Commands;

use App\Models\LootSource;
use App\Services\LootGeneratorService;
use App\Services\LootResult;
use App\Services\LootRollResult;
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
            return $lootRollResult->getQuantity();
        });

        $this->output->writeln("## Results of killing {$times} {$monsterName}s: ");

        /** @var LootRollResult $lootResult */
        foreach ($lootRollResults as $lootResult) {
            $this->output->writeln($lootResult->toString());
        }
    }
}
