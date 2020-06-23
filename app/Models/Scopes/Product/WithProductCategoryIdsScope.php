<?php

namespace App\Models\Scopes\Product;

use App\Models\Attribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\DB;

class WithProductCategoryIdsScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $query = DB::table('catalog_category_product_index_store' . config('shop.store'))
            ->selectRaw('GROUP_CONCAT(category_id)')
            ->whereColumn('product_id', $model->getTable() . '.entity_id');

        $builder->selectSub($query, 'category_ids');
    }
}
