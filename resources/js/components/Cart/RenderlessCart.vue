<script>
    import GetCart from './../Cart/mixins/GetCart'

    export default {
        mixins: [GetCart],

        render() {
            return this.$scopedSlots.default({
                cart: this.cart,
                changeQty: this.changeQty,
                remove: this.remove,
            })
        },

        methods: {
            changeQty(item) {
                magento.put('guest-carts/' + localStorage.mask + '/items/' + item.item_id, {
                    cartItem: {
                        quote_id: localStorage.mask,
                        qty: item.qty
                    }
                })
                .then((response) => this.refreshCart())
                .catch((error) => alert(error.response.data.message))
            },

            remove(item) {
                magento.delete('guest-carts/' + localStorage.mask + '/items/' + item.item_id)
                    .then((response) => this.refreshCart())
                    .catch((error) => alert(error.response.data.message))
            },
        }
    }
</script>
