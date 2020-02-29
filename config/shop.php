<?php
return [
    // Default store, see middleware: DetermineAndSetShop
    'store' => 1,

    'index' => [
        // The attributes which should be indexed in ElasticSearch.
        'attributes' => [
            'entity_id'         => 'id',
            'sku'               => 'sku',
            'type_id'           => 'type',
            'name'              => 'name',
            'description'       => 'description',
            'color_value'       => 'color',
            'main_group_value'  => 'main_group',
            'thumbnail'         => 'image',
            'price'             => 'price',
        ],
    ],

    'product' => [
        // The attributes that should be available when getting a product.
        'attributes' => [
            'name',
            'description',
            'sku',
            'price',
            'color',
            'manufacturer',
            'shoe_type',
            'meta_title',
            'meta_description',
        ]
    ],
];
