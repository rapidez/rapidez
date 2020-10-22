<script>
    export default {
        render() {
            return this.$scopedSlots.default({
                isOpen: this.isOpen,
                toggle: this.toggle,
            })
        },

        data: () => ({
            isOpen: false,
        }),

        methods: {
            toggle() {
                this.isOpen = !this.isOpen
            },
        }
    }
</script>
