<?php

namespace App\Console\Commands;

use App\Models\LootSource;
use Illuminate\Console\Command;
use Nwilging\LaravelDiscordBot\Contracts\Services\DiscordApplicationCommandServiceContract;
use Nwilging\LaravelDiscordBot\Support\Commands\Options\NumberOption;
use Nwilging\LaravelDiscordBot\Support\Commands\Options\OptionChoice;
use Nwilging\LaravelDiscordBot\Support\Commands\Options\StringOption;
use Nwilging\LaravelDiscordBot\Support\Commands\SlashCommand;

class CreateKillSlashCommand extends Command
{
    protected $signature = 'register-kill-command';

    protected $description = '';

    public function handle(DiscordApplicationCommandServiceContract $commandServiceContract): void
    {
        $sourceNames = LootSource::query()
            ->select(['name'])
            ->get();
        $optionChoices = $sourceNames->map(function (LootSource $source) {
            return new OptionChoice($source->name, $source->name);
        });

        $option1 = (new StringOption('npc', 'Name of NPC to kill'));
        $optionChoices->each(function (OptionChoice $choice) use ($option1) {
            $option1->choice($choice);
        });

        $option2 = (new NumberOption('quantity', 'The number of NPC to kill'))
            ->minValue(1)
            ->maxValue(500);

        $command = new SlashCommand('kill', "It rolls loot");
        $command->option($option1);
        $command->option($option2);

        $result = $commandServiceContract->createGlobalCommand($command);

        $this->output->writeln("Command created/updated: {$result['name']} - {$result['id']}");
    }
}
