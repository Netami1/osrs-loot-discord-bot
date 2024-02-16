<?php

namespace App\Console\Commands;

use App\Models\LootSource;
use App\Services\ImageService;
use App\Services\LootGeneration\LootGeneratorService;
use App\Services\LootGeneration\LootResult;
use App\Services\LootGeneration\LootRollResult;
use Illuminate\Console\Command;
use Nette\Utils\Image;

class GenerateLootCommand extends Command
{
    protected $signature = 'loot {--source=} {--times=1}';
    protected $description = 'Generate loot from a source';

    public function handle(LootGeneratorService $lootGeneratorService, ImageService $imageService): void
    {
        $sourceName = $this->input->getOption('source');
        $times = $this->input->getOption('times');

        $inputArr = [
            [
                'name' => 'target',
                'value' => $sourceName,
            ],
            [
                'name' => 'quantity',
                'value' => $times,
            ],
        ];

        $this->info("Looting {$sourceName} {$times} times...");

        $lootResult = $lootGeneratorService->generateLoot($inputArr);
        $lootRollResults = $lootResult->getLootRollResultsByValueDesc();

        $this->output->writeln("## Results of {$times} {$sourceName}s: " . kmb($lootResult->totalValue()));
        $this->output->writeln('### GP each: ' . kmb($lootResult->totalValue() / $times));

        /** @var LootRollResult $lootResult */
        foreach ($lootRollResults as $lootRollResult) {
            $this->output->writeln($lootRollResult->toString());
        }

        $outputImage = $imageService->createItemResultsImage($lootResult);
        $imageService->storeImage($outputImage);
    }
}
