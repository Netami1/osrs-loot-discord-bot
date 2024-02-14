<?php

namespace App\Console\Commands;

use App\Services\WikiService;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateLootTableRollsFromItemNamesCommand extends Command
{
    protected $signature = 'create-rolls-from-item-names';

    protected $description = 'Create loot table rolls from item names.';

    public function handle(WikiService $wikiService): void
    {
        $namesFileContents = file_get_contents(storage_path('app/item-names.txt'));
        $itemNames = explode("\n", $namesFileContents);

        foreach ($itemNames as $itemName) {
            $itemDetails = $wikiService->getItemMappingDetailsByName($itemName);
            // Get the key and value from the array
            $arrId = array_key_first($itemDetails);
            $itemDetails = $itemDetails[$arrId];
            $itemId = $itemDetails['id'];

            if (!$itemId) {
                dd($itemDetails);
            }

            $this->output->writeln('[');
            $this->output->writeln('    \'id\' => \'' . Str::uuid(). '\',');
            $this->output->writeln('    \'item_name\' => \'' . $itemName . '\',');
            $this->output->writeln('    \'item_id\' => \'' . $itemId . '\',');
            $this->output->writeln('    \'chance\' => ' . '\'\'' . ',');
            $this->output->writeln('],');
        }
    }
}
