<?php

namespace App\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

class Config extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'core_config_data';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'config_id';

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('scope-fallback', function (Builder $builder) {
            $builder
                ->whereIn('scope_id', [0, config('shop.store')])
                ->orderByDesc('scope_id')
                ->limit(1);
        });
    }

    public static function getCachedByPath(string $path, $default = null): ?string
    {
        $cacheKey = 'config.'.config('shop.store').'.'.str_replace('/', '.', $path);

        return Cache::rememberForever($cacheKey, function () use ($path, $default) {
            return self::where('path', $path)->first('value')->value ?? $default;
        });
    }
}
