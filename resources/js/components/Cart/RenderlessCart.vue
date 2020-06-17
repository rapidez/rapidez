<script>
    import GetCart from './../Cart/mixins/GetCart'

    export default {
        mixins: [GetCart],

        render() {
            return this.$scopedSlots.default({
                cart: this.cart,
                changeQty: this.changeQty,
            })
        },

        methods: {
            changeQty(item) {
                alert('TODO: Changed qty for '+item.name+' to '+item.qty)
            }
        }
    }
</script>
