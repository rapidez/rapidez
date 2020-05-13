<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Model;

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
