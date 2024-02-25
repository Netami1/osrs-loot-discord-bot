<?php

namespace App\Console\Commands;

use App\Models\LootResultItem;
use App\Services\ImageService;
use App\Services\LootGeneration\LootGenerationRequest;
use App\Services\LootGeneration\LootGeneratorService;
use Illuminate\Console\Command;

class GenerateLootCommand extends Command
{
    protected $signature = 'loot {--source=} {--times=1}';
    protected $description = 'Generate loot from a source';

    public function handle(LootGeneratorService $lootGeneratorService, ImageService $imageService): void
    {
        $sourceName = $this->input->getOption('source');
        $times = $this->input->getOption('times');

        $inputArr = [
            'data' => [
                'options' => [
                    [
                        'name' => 'target',
                        'value' => $sourceName,
                    ],
                    [
                        'name' => 'quantity',
                        'value' => $times,
                    ],
                ],
            ],
            'member' => [
                'user' => [
                    'global_name' => 'Console',
                ],
            ],
        ];
        $lootGenerationRequest = new LootGenerationRequest($inputArr);

        $this->info("Looting {$sourceName} {$times} times...");

        $lootResult = $lootGeneratorService->generateLoot($lootGenerationRequest);
        $lootResultItems = $lootResult->lootResultItems;

        $this->output->writeln("## Results of {$times} {$sourceName}s: " . kmb($lootResult->totalValue()));
        $this->output->writeln('### GP each: ' . kmb($lootResult->totalValue() / $times));

        /** @var LootResultItem $lootResultItem */
        foreach ($lootResultItems as $lootResultItem) {
            $this->output->writeln($lootResultItem->toString());
        }

        $outputImage = $imageService->createItemResultsImage($lootResult);
        $imageService->storeImage($outputImage, $lootResult->imageFilename());
    }
}
