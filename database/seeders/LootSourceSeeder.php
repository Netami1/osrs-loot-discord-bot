<?php

namespace Database\Seeders;

use App\Models\LootSource;
use App\Models\StaticData\LootSources;
use Illuminate\Database\Seeder;

class LootSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sources = (new LootSources())->data();
        foreach ($sources as $sourceData) {
            $source = LootSource::query()
                ->find($sourceData['id']);

            if ($source) {
                $source->update($sourceData);
                $source->save();
            } else {
                LootSource::query()
                    ->create($sourceData);
            }
        }
    }
}
