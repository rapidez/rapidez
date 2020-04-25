<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ForCurrentStoreScope implements Scope
{
    public ?string $joinTable;

    /**
     * Create a new scope instance.
     *
     * @return void
     */
    public function __construct($joinTable = null)
    {
        $this->joinTable = $joinTable;
    }

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
        $joinTable    = $this->joinTable ?: $currentTable.'_store';
        $type         = explode('_', $currentTable)[1];

        $builder->join($joinTable, function ($join) use ($currentTable, $type, $joinTable) {
            $join->on($currentTable.'.'.$type.'_id', '=', $joinTable.'.'.$type.'_id')
                 ->where('store_id', config('shop.store'));
        });
    }
}
