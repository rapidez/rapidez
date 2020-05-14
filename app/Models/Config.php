<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
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

    public static function getCachedByPath(string $path): string
    {
        return Cache::rememberForever('config.'.config('shop.store').'.'.str_replace('/', '.', $path), function () use ($path) {
            return self::where('path', $path)->first('value')->value;
        });
    }
}
