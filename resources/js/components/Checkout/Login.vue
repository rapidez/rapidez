<script>
    import InteractWithUser from './../User/mixins/InteractWithUser'

    export default {
        mixins: [InteractWithUser],

        props: ['step'],

        data: () => ({
            email: process.env.MIX_DEBUG ? 'roy@justbetter.nl' : null,
            password: null,
            emailAvailable: true,
        }),

        render() {
            return this.$scopedSlots.default({
                loginInputChange: this.loginInputChange,
                email: this.email,
                emailAvailable: this.emailAvailable,
                password: this.password,
                go: this.go,
            })
        },

        mounted() {
            this.refreshUser(false)
            if (this.$root.user) {
                this.$root.checkout.step = 2
            }
        },

        methods: {
            go() {
                // TODO: Validation.
                if (this.email && this.password) {
                    this.login()
                } else if (this.email) {
                    this.checkEmailAvailability()
                } else {
                    alert('A email address is required')
                }
            },

            checkEmailAvailability() {
                magento.post('customers/isEmailAvailable', {
                    customerEmail: this.email
                })
                .then((response) => {
                    if (this.emailAvailable = response.data) {
                        this.$root.guestEmail = this.email
                        this.$root.checkout.step = 2
                    } else {
                        // TODO: Focus on password.
                    }
                })
                .catch((error) => alert(error.response.data.message))
            },

            login() {
                magento.post('integration/customer/token', {
                    username: this.email,
                    password: this.password,
                })
                .then(async (response) => {
                    localStorage.token = response.data
                    window.magentoUser.defaults.headers.common['Authorization'] = `Bearer ${localStorage.token}`;
                    await this.refreshUser()
                    this.$root.checkout.step = 2

                    if (this.$root.cart) {
                        await this.linkUserToCart()
                        localStorage.mask = this.$root.cart.entity_id
                    }

                })
                .catch((error) => {
                    alert(error.response.data.message)
                    this.password = null
                })
            },

            loginInputChange(e) {
                this[e.target.id] = e.target.value
            },

            async linkUserToCart() {
                await magentoUser.put('guest-carts/'+localStorage.mask, {
                    customerId: this.$root.user.id,
                    storeId: config.store
                }).catch((error) => {
                    alert(error.response.data.message)
                })
            }
        }
    }
</script>
