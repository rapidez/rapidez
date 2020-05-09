<?php

namespace App;

use App\Model;

class ProductImage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'catalog_product_entity_media_gallery';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'value_id';
}
