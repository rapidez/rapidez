<div v-if="cart" class="p-3 border rounded">
    <table class="mb-3">
        <tr class="py-3" v-for="item in cart.items">
            <td>@{{ item.name }}</td>
            <td class="text-right font-mono text-xs px-4">@{{ item.qty }}</td>
            <td class="text-right font-mono text-xs">@{{ item.price | price }}</td>
        </tr>
    </table>
</div>
