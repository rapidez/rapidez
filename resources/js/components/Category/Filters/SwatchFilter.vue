<template>
    <div v-if="loaded">
        <slot :swatches="swatches"></slot>
    </div>
</template>

<script>
    export default {
        data: () => ({
            swatches: [],
            loaded: false,
        }),

        mounted() {
            if (sessionStorage.swatches) {
                this.swatches = JSON.parse(sessionStorage.swatches)
                this.loaded = true
                return
            }

            axios.get('/api/swatches')
                 .then((response) => {
                    this.swatches = response.data
                    sessionStorage.swatches = JSON.stringify(this.swatches)
                    this.loaded = true
                 })
                 .catch((error) => {
                    alert('Something went wrong')
                })
        }
    }
</script>
