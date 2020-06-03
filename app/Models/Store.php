<?php

namespace App\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\Builder;

class Store extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'store';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'store_id';

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('without-admin-store', function (Builder $builder) {
            $builder->where('code', '<>', 'admin');
        });
    }
}
