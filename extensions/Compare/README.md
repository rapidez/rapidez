# Compare

## Compare checkbox

Create a Vue component (for example: `ProductCompareCheckbox.vue`) and make sure the product ID is set as the key (`<product-compare-checkbox :key="item.id" />`). You can make use of the mixin for the funtionality:
```
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
```
