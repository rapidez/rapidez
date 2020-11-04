export default {
    methods: {
        getCart() {
            if (this.$root.cart === null && localStorage.cart) {
                this.$root.cart = JSON.parse(localStorage.cart)
            }

            return this.$root.cart
        },

        async refreshCart() {
            await this.getMask()

            if (localStorage.mask) {
                try {
                    let response = await axios.get('/api/cart/' + (localStorage.token ? localStorage.token : localStorage.mask))
                    localStorage.cart = JSON.stringify(response.data)
                    this.$root.cart = response.data
                } catch (error) {
                    if (error.response.status == 404) {
                        localStorage.removeItem('mask')
                    }
                    alert('Something went wrong, please try again')
                }
            }
        },

        async getMask() {
            if (!localStorage.mask) {
                try {
                    var response = this.$root.user
                        ? await magentoUser.post('carts/mine')
                        : await magento.post('guest-carts')
                } catch (error) {
                    alert('Something went wrong, please try again')
                }

                if (response !== undefined && response.data) {
                    localStorage.mask = response.data
                }
            }
        },
    },

    computed: {
        cart: function () {
            return this.getCart()
        },

        hasItems: function () {
            return this.cart && this.cart.items && Object.keys(this.cart.items).length
        },
    },
}
