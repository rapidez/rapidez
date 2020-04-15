<template>
    <div>
        <label>
            <input type="checkbox" v-model="compared"> Compare
        </label>
    </div>
</template>

<script>
    import ProductCompare from 'Extensions/Compare/mixins/ProductCompare'

    export default {
        mixins: [ProductCompare],
    }
</script>
