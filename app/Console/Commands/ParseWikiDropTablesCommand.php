<?php

namespace App\Console\Commands;

use App\Services\WikiService;
use Illuminate\Console\Command;
use duzun\hQuery;
use Illuminate\Support\Str;

class ParseWikiDropTablesCommand extends Command
{
    protected $signature = 'parse-wiki-drop-tables';
    protected $description = 'Parse wiki drop tables.';

    public function handle(WikiService $wikiService): void
    {
        $this->output->writeln('Parsing wiki drop tables...');

        $inputHtml = file_get_contents(storage_path('app/wiki-drop-tables.html'));

        $doc = hQuery::fromHTML($inputHtml);

        $itemRows = $doc->find('tr');

        $items = [];
        foreach ($itemRows as $itemCol) {
            $itemName = null;
            $itemRarity = null;
            $quantityMin = null;
            $quantityMax = null;

            $tds = $itemCol->find('td');
            if (!$tds) {
                continue;
            }

            $tdIndex = 0;
            foreach ($tds as $td) {
                if ($tdIndex === 0) {
                    $itemName = $td->find('a')->attr('title');
                    $itemName = html_entity_decode($itemName);
                }

                if ($tdIndex === 2) {
                    $quantityString = $td->text();
                    $quantityString = str_replace(',', '', $quantityString);
                    $quantityString = str_replace("\u{00a0}(noted)", '', $quantityString);
                    // Check if the string contains a range
                    if (str_contains($quantityString, "\u{2013}")) {
                        $quantityRange = explode("\u{2013}", $quantityString);
                        $quantityMin = $quantityRange[0];
                        $quantityMax = $quantityRange[1];
                    } else {
                        $quantityMin = $quantityString;
                        $quantityMax = $quantityString;
                    }
                }

                if ($tdIndex === 3) {
                    $span = $td->find('span');
                    if ($span) {
                        $itemRarity = $span->attr('data-drop-percent');
                        // Cast it to a float
                        $itemRarity = floatval($itemRarity) / 100;
                        // Round it to 8 decimal places
                        $itemRarity = round($itemRarity, 8);
                        $itemRarity = number_format($itemRarity, 8, '.', '');
                    }
                }

                $tdIndex++;
            }

            $item = [
                'name' => $itemName,
                'rarity' => $itemRarity,
                'quantity_min' => $quantityMin,
                'quantity_max' => $quantityMax,
            ];
            $items[] = $item;
        }

        foreach ($items as $item) {
            $itemDetails = $wikiService->getItemMappingDetailsByName($item['name']);
            // Coins are not in the mapping, so we need to handle them separately
            if ($itemDetails || $item['name'] == 'Coins') {
                $itemId = 995;

                if ($itemDetails) {
                    $arrId = array_key_first($itemDetails);
                    $itemDetails = $itemDetails[$arrId];
                    $itemId = $itemDetails['id'];
                }

                $this->output->writeln('[');
                $this->output->writeln('    \'id\' => \'' . Str::uuid() . '\',');
                $this->output->writeln('    \'item_id\' => ' . $itemId . ',');
                $this->output->writeln('    \'item_name\' => "' . $item['name'] . '",');
                $this->output->writeln('    \'chance\' => ' . $item['rarity'] . ',');
                if ($item['quantity_min'] != 1) {
                    $this->output->writeln('    \'min\' => ' . $item['quantity_min'] . ',');
                }
                if ($item['quantity_max'] != 1) {
                    $this->output->writeln('    \'max\' => ' . $item['quantity_max'] . ',');
                }
                $this->output->writeln('],');
            }
        }
    }
}
