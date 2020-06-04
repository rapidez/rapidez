<?php

namespace App\Models;

use App\Models\Model;
use App\Scopes\OnlyProductAttributesScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class Attribute extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'eav_attribute';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'attribute_id';

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new OnlyProductAttributesScope);
    }

    public static function getCachedWhere(callable $callback): array
    {
        if (!$attributes = config('cache.attributes')) {
            $attributes = Cache::rememberForever('attributes', function () {
                return self::all()->toArray();
            });
            config(['cache.attributes' => $attributes]);
        }

        return Arr::where($attributes, function ($attribute) use ($callback) {
            return $callback($attribute);
        });
    }
}
