<?php

return [
    'url' => env('RSS_URL'),
    'cache' => [
        'length' => env('RSS_CACHE_LENGTH', 60),
    ],
    'count' => env('RSS_COUNT', 20),
];
