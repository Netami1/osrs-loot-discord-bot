<?php

namespace App\Console\Commands;

use App\Models\LootSource;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Nwilging\LaravelDiscordBot\Contracts\Services\DiscordApplicationCommandServiceContract;
use Nwilging\LaravelDiscordBot\Support\Commands\Options\NumberOption;
use Nwilging\LaravelDiscordBot\Support\Commands\Options\OptionChoice;
use Nwilging\LaravelDiscordBot\Support\Commands\Options\StringOption;
use Nwilging\LaravelDiscordBot\Support\Commands\SlashCommand;

class CreateLootSlashCommand extends Command
{
    protected $signature = 'register-slash-commands';

    protected $description = 'Registers/updates the slash commands with Discord.';

    public function handle(DiscordApplicationCommandServiceContract $commandServiceContract): void
    {
        // 25 is the maximum number of choices allowed for a command option
        $sourceNames = LootSource::query()
            ->select(['name'])
            ->where('enabled', true)
            ->get();

        if ($sourceNames->count() > 25) {
            Log::warning('More than 25 loot sources enabled, only the first 25 will be used.');
            $sourceNames = $sourceNames->take(25);
        }

        $optionChoices = $sourceNames->map(function (LootSource $source) {
            return new OptionChoice($source->name, $source->name);
        });

        $option1 = (new StringOption('target', 'Name of NPC/activity'));
        $optionChoices->each(function (OptionChoice $choice) use ($option1) {
            $option1->choice($choice);
        });

        $option2 = (new NumberOption('quantity', 'The number of simulations to run'))
            ->minValue(1)
            ->maxValue(10000);

        $command = new SlashCommand('loot', 'Simulate loot from a source');
        $command->option($option1);
        $command->option($option2);

        $result = $commandServiceContract->createGlobalCommand($command);

        $this->output->writeln("Command created/updated: {$result['name']} - {$result['id']}");
    }
}
