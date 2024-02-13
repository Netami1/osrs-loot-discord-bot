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
    private const ICON_SIZE = 30;
    private CONST ICON_START_X = 25;
    private CONST ICON_START_Y = 16;
    private CONST ICON_SPACE_BETWEEN_X = 20;
    private CONST ICON_MAX_START_X = 420;
    private CONST ICON_SPACE_BETWEEN_Y = 42;
    private CONST BACKGROUND_WIDTH = 479;
    private CONST BACKGROUND_HEIGHT = 237;
    private CONST TEXT_SIZE = 16;

    private ImageManager $imageManager;

    public function __construct()
    {
        $this->imageManager = new ImageManager(Driver::class);
    }

    public function createItemResultsImage(LootResult $lootResult): ImageInterface
    {
        $background = $this->getBackgroundImage();
        $xPos = self::ICON_START_X;
        $yPos = self::ICON_START_Y;
        $outputImage = $this->imageManager->create(self::BACKGROUND_WIDTH, self::BACKGROUND_HEIGHT);
        $outputImage->place($background);
        $outputImage->scale(self::BACKGROUND_WIDTH, self::BACKGROUND_HEIGHT);

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
                $font->size(self::TEXT_SIZE);
                $font->color('#000000');
                $font->align('left');
                $font->valign('top');
            });
            $outputImage->text($quantity, $xPos - 5, $yPos, function (FontFactory $font) {
                $font->filename(storage_path('app/osrs_font.ttf'));
                $font->size(self::TEXT_SIZE);
                $font->color('#ffff00');
                $font->align('left');
                $font->valign('top');
            });

            $xPos += (self::ICON_SIZE + self::ICON_SPACE_BETWEEN_X);
            if ($xPos > self::ICON_MAX_START_X) {
                $xPos = self::ICON_START_X;
                $yPos += self::ICON_SPACE_BETWEEN_Y;
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
            if (!$iconFile) {
                Log::warning("Failed to download icon for item {$item->id}");
                return null;
            }
            file_put_contents($iconPath, $iconFile);
        }

        return $this->imageManager->read($iconPath, FilePathImageDecoder::class)
            ->contain(self::ICON_SIZE, self::ICON_SIZE, 'rgba(0, 0, 0, 0)' , 'bottom');
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
