<script>
    import InteractWithUser from './../User/mixins/InteractWithUser'

    export default {
        mixins: [InteractWithUser],

        props: ['step'],

        data: () => ({
            email: null,
            password: null,
            emailAvailable: true,
        }),

        render() {
            return this.$scopedSlots.default({
                email: this.email,
                emailChange: this.emailChange,
                emailAvailable: this.emailAvailable,

                password: this.password,
                passwordChange: this.passwordChange,

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
                .then((response) => {
                    localStorage.token = response.data
                    this.refreshUser()
                    this.$root.checkout.step = 2
                })
                .catch((error) => {
                    alert(error.response.data.message)
                    this.password = null
                })

                // Add quote to the user: https://magento.stackexchange.com/questions/291397/how-to-merge-guest-quote-items-to-customer-quoteif-customer-log-in-by-magento
            },

            emailChange(e) {
                this.email = e.target.value
            },

            passwordChange(e) {
                this.password = e.target.value
            },
        }
    }
</script>
