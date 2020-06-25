<script>
    export default {
        props: ['step'],

        data: () => ({
            email: null,
            password: null,
            emailAvailable: true,
        }),

        render() {
            return this.$scopedSlots.default({
                go: this.go,
                email: this.email,
                password: this.password,
                emailAvailable: this.emailAvailable,
                emailChange: this.emailChange,
                passwordChange: this.passwordChange,
            })
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
                .catch((error) => alert(error.response.data.message))
                .then((response) => {
                    if (this.emailAvailable = response.data) {
                        this.$root.checkout.step = 2
                    }
                })
            },

            login() {
                alert('login..');
                // Login: https://magento.stackexchange.com/a/158454/8013
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
