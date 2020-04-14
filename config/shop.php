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
        'searchable',
    ],

    // The attributes which are by default present in the flat tables.
    // Custom attributes do not have to be listed here.
    'default_flat_attributes' => [
        'name',
        'description',
        'sku',
        'price',
        'thumbnail',
        'url_key',
    ],

    // The attributes that should be available when getting a
    // product with a boolean if it should be indexed in ES.
    'attributes' => [
        'id'                => true,
        'name'              => true,
        'description'       => true,
        'sku'               => true,
        'price'             => true,
        'thumbnail'         => true,
        'url_key'           => true,
        'color'             => true,
        'manufacturer'      => true,
        'main_group'        => true,
        'article_group'     => true,
        'shoe_type'         => true,
        'meta_title'        => false,
        'meta_description'  => false,
    ],

    // Custom attributes which are available by default
    // with a boolean if it should be indexed in ES.
    'custom_attributes' => [
        'category_ids'      => true,
    ],

    // The searchable attributes.
    'searchable' => [
        'name',
        'description',
        'manufacturer',
    ],

    // Enabled extensions.
    'extensions' => [
        \Extensions\Variants\VariantExtension::class,
    ],
];
