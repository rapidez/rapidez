<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ForCurrentStoreScope implements Scope
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
        $currentTable = $builder->getQuery()->from;
        $joinTable    = $currentTable.'_store';
        $type         = str_replace('cms_', '', $currentTable);

        $builder->join($joinTable, $currentTable.'.'.$type.'_id', '=', $joinTable.'.'.$type.'_id')
                ->where('store_id', config('shop.store'));
    }
}
