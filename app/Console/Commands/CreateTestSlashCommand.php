<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Nwilging\LaravelDiscordBot\Contracts\Services\DiscordApplicationCommandServiceContract;
use Nwilging\LaravelDiscordBot\Support\Commands\SlashCommand;

class CreateTestSlashCommand extends Command
{
    protected $signature = 'register-test-command';

    protected $description = '';

    public function handle(DiscordApplicationCommandServiceContract $commandServiceContract): void
    {
        $command = new SlashCommand('test-command', "It's a test");
        $result = $commandServiceContract->createGlobalCommand($command);

        print_r($result);
    }
}
