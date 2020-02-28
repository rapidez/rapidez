<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Rewrite extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'url_rewrite';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'url_rewrite_id';

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('store', function (Builder $builder) {
            $builder->where('store_id', config('shop.store'));
        });
    }
}
