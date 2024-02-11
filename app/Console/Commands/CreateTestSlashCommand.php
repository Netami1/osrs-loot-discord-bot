<?php

namespace App\Console\Commands;

use App\Models\LootSource;
use Illuminate\Console\Command;
use Nwilging\LaravelDiscordBot\Contracts\Services\DiscordApplicationCommandServiceContract;
use Nwilging\LaravelDiscordBot\Support\Commands\Options\NumberOption;
use Nwilging\LaravelDiscordBot\Support\Commands\Options\StringOption;
use Nwilging\LaravelDiscordBot\Support\Commands\SlashCommand;

class CreateTestSlashCommand extends Command
{
    protected $signature = 'register-test-command';

    protected $description = '';

    public function handle(DiscordApplicationCommandServiceContract $commandServiceContract): void
    {
        $sourceNames = LootSource::query()
            ->select(['name'])
            ->get()
            ->toArray();

        $option1 = (new StringOption('npc', 'Name of NPC to kill'))
            ->autocomplete()
            ->choices($sourceNames);
        $option2 = (new NumberOption('quantity', 'The number of NPC to kill'))
            ->minValue(1)
            ->maxValue(1000);

        $command = new SlashCommand('kill', "It rolls loot");
        $command->option($option1);
        $command->option($option2);

        $result = $commandServiceContract->createGlobalCommand($command);

        print_r($result);
    }
}
