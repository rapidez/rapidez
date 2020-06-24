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
        // Set the store based on MAGE_RUN_CODE.
        if ($storeCode = $request->server('MAGE_RUN_CODE')) {
            $store = Store::getCachedWhere(function ($store) use ($storeCode) {
                return $store['code'] == $storeCode;
            });

            config()->set('shop.store', $store['store_id']);
            config()->set('shop.store_code', $store['code']);
        }

        // Find the store code by the default store id.
        if (!config('shop.store_code')) {
            $store = Store::getCachedWhere(function ($store) {
                return $store['store_id'] == config('shop.store');
            });

            config()->set('shop.store_code', $store['code']);
        }

        return $next($request);
    }
}
