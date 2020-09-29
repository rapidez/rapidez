<cart class="float-right mr-3" v-cloak>
    <div class="group" v-if="hasItems" slot-scope="{ cart, hasItems }">
        Cart: <span>@{{ cart.items_count }}</span>
        <div class="hidden absolute right-0 bg-white border p-3 mr-1 z-10 group-hover:block">
            <table class="mb-3">
                <tr class="py-3" v-for="item in cart.items">
                    <td>@{{ item.name }}</td>
                    <td class="text-right font-mono text-xs px-4">@{{ item.qty }}</td>
                    <td class="text-right font-mono text-xs">@{{ item.price | price }}</td>
                </tr>
            </table>
            <div class="flex justify-between items-center">
                <a href="/cart">Show cart</a>
                <a href="/checkout" class="btn btn-primary">Checkout</a>
            </div>
        </div>
    </div>
    <div v-else>
        Cart: 0
    </div>
</cart>
