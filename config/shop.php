<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    |
    | The default store if it could not be detected. See the
    | DetermineAndSetShop middleware.
    |
    */
    'store' => 1,

    'index' => [
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
];
