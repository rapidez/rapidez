<template>
    <div v-html="menu" />
</template>

<script>
    export default {
        props: {
            identifier: {
                type: String,
                required: true,
            }
        },

        data: () => ({
            menu: '',
        }),

        mounted() {
            if (sessionStorage.getItem('menu.' + this.identifier)) {
                this.menu = sessionStorage.getItem('menu.' + this.identifier)
                return;
            }

            axios.get('/api/menu/' + this.identifier)
                 .then((response) => {
                    this.menu = response.data
                    sessionStorage.setItem('menu.' + this.identifier, this.menu)
                 })
                 .catch((error) => {
                    alert('Something went wrong')
                 })
        }
    }
</script>

<style>
    .hover\:next-flex:hover > * + * {
        display: flex;
    }
</style>
