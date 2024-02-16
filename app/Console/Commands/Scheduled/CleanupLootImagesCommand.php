<?php

namespace App\Console\Commands\Scheduled;

use Illuminate\Console\Command;

class CleanupLootImagesCommand extends Command
{
    protected $signature = 'loot:cleanup-images';
    protected $description = 'Cleanup old loot images older than an hour';

    public function handle(): void
    {
        $this->info('Cleaning up old loot images...');

        $files = glob(storage_path('app/public/loot_*.png'));
        $now = time();

        foreach ($files as $file) {
            if (is_file($file)) {
                if ($now - filemtime($file) >= 60 * 60) {
                    unlink($file);
                }
            }
        }

        $this->info('Old loot images cleaned up!');
    }
}
