<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Nwilging\LaravelDiscordBot\Contracts\Services\DiscordApplicationCommandServiceContract;
use Nwilging\LaravelDiscordBot\Support\Commands\Options\StringOption;
use Nwilging\LaravelDiscordBot\Support\Commands\SlashCommand;

class CreateLootLookupCommand extends Command
{
    protected $signature = 'register-loot-lookup-command';
    protected $description = 'Registers/updates the loot lookup slash command with Discord.';

    public function handle(DiscordApplicationCommandServiceContract $commandServiceContract): void
    {
        $command = new SlashCommand('lookup loot', 'Lookup previously generated loot results from an ID');
        $command->option(new StringOption('id', 'UUID of the loot result to lookup'));

        $result = $commandServiceContract->createGlobalCommand($command);

        $this->output->writeln("Command created/updated: {$result['name']} - {$result['id']}");
    }
}
