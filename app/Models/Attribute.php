<?php

namespace App\Models\Models;

use App\Scopes\OnlyProductAttributesScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
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
        // To bypass cache use the "array" cache driver.
        return Arr::where(Cache::rememberForever('attributes', function () {
            return self::all()->toArray();
        }), function ($attribute) use ($callback) {
            return $callback($attribute);
        });
    }
}
