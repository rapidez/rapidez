<script>
    import GetCart from './../Cart/mixins/GetCart'

    export default {
        mixins: [GetCart],

        render() {
            return this.$scopedSlots.default({
                cart: this.cart,
                checkout: this.checkout,
                loading: this.$root.loading,
            })
        },

        methods: {
            //
        },

        computed: {
            checkout: function () {
                return this.$root.checkout
            },
        }
    }
</script>
