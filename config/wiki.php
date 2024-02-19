<?php

return [
    'api' => [
        'base_url' => env('WIKI_API_URL', 'https://prices.runescape.wiki/api/v1/osrs'),
        'mapping' => '/mapping',
        'latest' => '/latest',
    ],
    'item_icon_base_url' => env('WIKI_ITEM_ICON_URL', 'https://oldschool.runescape.wiki/images/%s.png'),
    'storage' => [
        'item_mapping' => storage_path('app/item_mapping.json'),
        'pricing' => storage_path('app/item_pricing.json'),
    ],
];
