<?php

namespace App\Http\Middleware;

use App\Models\Store;
use Closure;
use Illuminate\Support\Facades\Cache;

class DetermineAndSetShop
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $stores = Cache::rememberForever('stores', function () {
            return Store::all()->pluck('store_id', 'code');
        });

        if (isset($stores[$request->server('MAGE_RUN_CODE')])) {
            config()->set('shop.store', $stores[$request->server('MAGE_RUN_CODE')]);
        }

        return $next($request);
    }
}
