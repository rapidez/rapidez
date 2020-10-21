<cart v-cloak>
    <div class="group" v-if="hasItems" slot-scope="{ cart, hasItems }">
        <div class="flex my-1">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            <span class="bg-primary rounded-full w-6 h-6 text-white text-center">@{{ cart.items_count }}</span>
        </div>
        <div class="hidden absolute right-0 bg-white border shadow rounded p-3 mr-1 z-10 group-hover:block">
            <table class="mb-3">
                <tr class="py-3" v-for="item in cart.items">
                    <td>@{{ item.name }}</td>
                    <td class="text-right font-mono text-xs px-4">@{{ item.qty }}</td>
                    <td class="text-right font-mono text-xs">@{{ item.price | price }}</td>
                </tr>
            </table>
            <div class="flex justify-between items-center">
                <a href="/cart" class="btn btn-outline-primary mr-5">@lang('Show cart')</a>
                <a href="/checkout" class="btn btn-primary">@lang('Checkout')</a>
            </div>
        </div>
    </div>
    <a href="/cart" class="my-1" v-else>
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
    </a>
</cart>
