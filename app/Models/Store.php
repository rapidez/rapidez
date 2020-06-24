<?php

namespace App\Models;

use App\Exceptions\StoreNotFoundException;
use App\Models\Model;
use App\Models\Scopes\IsActiveScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

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

        static::addGlobalScope(new IsActiveScope);
        static::addGlobalScope('without-admin-store', function (Builder $builder) {
            $builder->where('code', '<>', 'admin');
        });
    }

    public static function getCachedWhere(callable $callback): array
    {
        if (!$stores = config('cache.app.stores')) {
            $stores = Cache::rememberForever('stores', function () {
                return self::select(['store_id', 'code'])->get()->keyBy('store_id')->toArray();
            });
            config(['cache.app.stores' => $stores]);
        }

        $store = Arr::first($stores, function ($attribute) use ($callback) {
            return $callback($attribute);
        });

        throw_if(
            is_null($store),
            StoreNotFoundException::class,
            'Store not found.'
        );

        return $store;
    }
}
