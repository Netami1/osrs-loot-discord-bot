<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ParseMonsterDrops extends Command
{
    protected $signature = 'parse-monster-drops {--monster=}';

    protected $description = 'Parse monster drops from JSON';

    public function handle(): void
    {
        $monsterName = $this->input->getOption('monster');

        // Load the JSON file
        $json = file_get_contents(storage_path('app/monsters-complete.json'));
        $monsters = json_decode($json, true);

        // Find the monster by name
        $monster = collect($monsters)->firstWhere('name', $monsterName);
        $drops = $monster['drops'];

        foreach ($drops as $drop) {
            $this->info('[');
            $this->info('    \'id\' => \'' . Str::uuid(). '\',');
            $this->info('    \'item_name\' => \'' . $drop['name'] . '\',');
            $this->info('    \'item_id\' => \'' . $drop['id'] . '\',');
            $chance = $drop['rarity'];
            if ($chance != 1) {
                $this->info('    \'chance\' => ' . $chance . ',');
            }
            $quantity = $drop['quantity'];
            $min = $quantity;
            $max = $quantity;
            if (Str::contains($quantity, '-')) {
                $min = explode('-', $quantity)[0];
                $max = explode('-', $quantity)[1];
            }
            $this->info('    \'min\' => ' . $min . ',');
            $this->info('    \'max\' => ' . $max . ',');
            $this->info('],');
        }
    }
}
