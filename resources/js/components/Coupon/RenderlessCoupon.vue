<script>
    import GetCart from './../Cart/mixins/GetCart'

    export default {
        mixins: [GetCart],

        data: () => {
            return {
                couponCode: '',
                submitError: ''
            }
        },

        render() {
            return this.$scopedSlots.default({
                cart: this.$root.cart,
                removeCoupon: this.removeCoupon,
                applyCoupon: this.applyCoupon,
                couponCode: this.couponCode,
                submitError: this.submitError,
                inputEvents: {
                    input: (e) => { this.couponCode = e.target.value }
                }
            })
        },

        methods: {
            applyCoupon() {
                self = this
                if (this.couponCode) {
                    this.magentoCart('put', 'coupons/'+this.couponCode)
                        .then(function () {
                            self.refreshCart()
                            self.couponCode = ''
                            self.submitError = ''
                        })
                        .catch((error) => self.submitError = error.response.data.message)
                }
            },

            removeCoupon() {
                self = this
                this.magentoCart('delete', 'coupons')
                    .then(function() {
                        self.refreshCart()
                        self.submitError = ''
                    })
                    .catch((error) => self.submitError = error.response.data.message)
            }
        }
    }
</script>
