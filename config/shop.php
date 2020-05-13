<?php
return [
    // Default store, see middleware: DetermineAndSetShop
    'store' => 1,

    // Elasticsearch url.
    'es_url' => env('ES_URL', 'http://localhost:9200'),

    // Media url.
    'media_url' => env('MEDIA_URL', 'https://media.running.shop'),

    // The variables which should be exposed to the frontend.
    'exposed' => [
        'store',
        'es_url',
        'media_url',
    ],
];
