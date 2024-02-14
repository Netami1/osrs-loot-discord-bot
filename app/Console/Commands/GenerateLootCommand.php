<?php

namespace App\Console\Commands;

use App\Models\LootSource;
use App\Services\ImageService;
use App\Services\LootGeneration\LootGeneratorService;
use App\Services\LootGeneration\LootResult;
use App\Services\LootGeneration\LootRollResult;
use Illuminate\Console\Command;

class GenerateLootCommand extends Command
{
    protected $signature = 'loot {--source=} {--times=1}';
    protected $description = 'Generate loot from a source';

    public function handle(LootGeneratorService $lootGeneratorService, ImageService $imageService): void
    {
        $sourceName = $this->input->getOption('source');
        $times = $this->input->getOption('times');

        $this->info("Looting {$sourceName} {$times} times...");

        /** @var LootSource $lootSource */
        $lootSource = LootSource::query()->where('name', $sourceName)->firstOrFail();
        $tableResults = $lootGeneratorService->processLootTables($lootSource, $times);
        $lootResult = (new LootResult())
            ->setSource($lootSource)
            ->setQuantity($times)
            ->setLootRollResults($tableResults);
        $lootRollResults = $lootResult->getLootRollResults()->sortByDesc(function (LootRollResult $lootRollResult) {
            return $lootRollResult->totalValue();
        });

        $this->output->writeln("## Results of {$times} {$sourceName}s: " . kmb($lootResult->totalValue()));
        $this->output->writeln('### GP per: ' . kmb($lootResult->totalValue() / $times));

        /** @var LootRollResult $lootResult */
        foreach ($lootRollResults as $lootRollResult) {
            $this->output->writeln($lootRollResult->toString());
        }

        $image = $imageService->createItemResultsImage($lootResult);
        $image->toPng()->save(storage_path('app/loot_results.png'));
    }
}
