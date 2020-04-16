<template>
    <label :class="classLabel">
        <input
            type="checkbox"
            :checked="checked"
            @change="compareToggle(productId)"
            :class="classCheckbox"
        />
            Compare
    </label>
</template>

<script>
    import CheckboxLogic from './mixins/CheckboxLogic'

    export default {
        mixins: [CheckboxLogic],

        props: {
            classLabel: {
                default: '',
            },
            classCheckbox: {
                default: '',
            },
        },
    }
</script>
