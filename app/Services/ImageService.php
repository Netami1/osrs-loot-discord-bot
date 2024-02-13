<?php

namespace App\Services;

use App\Models\Item;
use App\Services\LootGeneration\LootResult;
use App\Services\LootGeneration\LootRollResult;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Drivers\Imagick\Decoders\FilePathImageDecoder;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;
use Intervention\Image\Interfaces\ImageInterface;
use Intervention\Image\Typography\FontFactory;

class ImageService
{
    private const USER_AGENT = 'Netami-Loot-Bot';

    private ImageManager $imageManager;

    public function __construct()
    {
        $this->imageManager = new ImageManager(Driver::class);
    }

    public function createItemResultsImage(LootResult $lootResult): ImageInterface
    {
        $background = $this->getBackgroundImage();
        $xPos = 30;
        $yPos = 20;
        $outputImage = $this->imageManager->create(479, 237);
        $outputImage->place($background);
        $outputImage->scale(800, 400);


        /** @var LootRollResult $lootRollResult */
        foreach ($lootResult->getLootRollResults() as $lootRollResult) {
            $item = $lootRollResult->getItem();
            $quantity = $lootRollResult->getQuantity();
            $icon = $this->getIconImage($item);
            if (!$icon) {
                continue;
            }

            $outputImage = $outputImage->place($icon, 'top-left', $xPos, $yPos);
            $outputImage->text($quantity, $xPos - 4, $yPos + 1, function (FontFactory $font) {
                $font->filename(storage_path('app/osrs_font.ttf'));
                $font->size(16);
                $font->color('#000000');
                $font->align('left');
                $font->valign('top');
            });
            $outputImage->text($quantity, $xPos - 5, $yPos, function (FontFactory $font) {
                $font->filename(storage_path('app/osrs_font.ttf'));
                $font->size(16);
                $font->color('#ffff00');
                $font->align('left');
                $font->valign('top');
            });

            $xPos += 75;
            if ($xPos > 750) {
                $xPos = 30;
                $yPos += 55;
            }
        }

        return $outputImage;
    }

    public function getBackgroundImage(): ImageInterface
    {
        return $this->imageManager->read(storage_path('app/background.png'), FilePathImageDecoder::class);
    }

    public function getIconImage(Item $item): ?ImageInterface
    {
        // Check if the item icon file exists in storage under its id.png
        $iconPath = storage_path('app/item_icons/' . $item->id . '.png');
        if (!file_exists($iconPath)) {
            if (!$item->icon) {
                Log::warning("Item {$item->id} has no icon URL");
                return null;
            }

            // Download the icon from the Item icon URL, saving it to storage
            $iconFile = $this->makeApiRequest($item->icon);
            file_put_contents($iconPath, $iconFile);
        }

        return $this->imageManager->read($iconPath, FilePathImageDecoder::class)
            ->contain(40, 40, 'rgba(0, 0, 0, 0)' , 'bottom');
    }

    private function makeApiRequest(string $url): ?string
    {
        $response = $this->httpClient()
            ->timeout(5)
            ->get($url);

        // We encountered an error when accessing the API
        if (!$response->successful()) {
            return null;
        }

        return $response->body();
    }

    private function httpClient(): PendingRequest
    {
        return Http::withHeaders(['User-Agent' => self::USER_AGENT]);
    }
}
