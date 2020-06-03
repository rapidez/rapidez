<?php

namespace App\Models;

use App\Models\Model;

class Category extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'entity_id';

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable()
    {
        return 'catalog_category_flat_store_' . config('shop.store');
    }
}
