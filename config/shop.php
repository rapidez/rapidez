<?php
return [
    // Default store, see middleware: DetermineAndSetShop
    'store' => 1,

    // The attributes which are by default present in the flat tables.
    // Custom attributes do not have to be listed here.
    'default_flat_attributes' => [
        'name',
        'description',
        'sku',
        'price',
        'image',
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
        'image'             => true,
        'color'             => true,
        'manufacturer'      => true,
        'main_group'        => true,
        'shoe_type'         => true,
        'meta_title'        => false,
        'meta_description'  => false,
    ],
];
