<template>
    <div v-if="loaded">
         <toggle-button
            :componentId="attributeData.code+'_swatch'"
            :dataField="attributeData.code+'_swatch.keyword'"
            :title="attributeData.name"
            :data="getSwatchOptionByCode(attributeData.code)"
            :multiSelect="true"
            :showFilter="true"
            :URLParams="true"
            :innerClass="{button: 'flex flex-wrap bg-transparent'}"
        >
            <div
                slot="renderItem"
                slot-scope="{ item }"
                :class="swatchClasses"
                :style="isVisualSwatch ? { 'background': item.value } : null"
            >
                <div v-if="!isVisualSwatch">
                    <span>
                        {{item.value}}
                    </span>
                </div>
            </div>
        </toggle-button>
    </div>
</template>

<script>
    export default {
        props: ['attributeData', 'dataType', 'swatchClasses'],

        data: () => ({
            swatchValues: [],
            loaded: false,
        }),

        computed: {
            getSwatchOptionByCode() {
                return code => _.values(_.mapValues(this.swatchValues[code].values, (value, key) => {
                    return { 'label': key, 'value': value }
                }));
            },
            isVisualSwatch() {
                return this.dataType == 'visual'
            },
        },

        mounted() {
            if (sessionStorage.swatchValues) {
                this.swatchValues = JSON.parse(sessionStorage.swatchValues)
                this.loaded = true
                return
            }

            axios.get('/api/swatches')
                 .then((response) => {
                    this.swatchValues = response.data
                    sessionStorage.swatchValues = JSON.stringify(this.swatchValues)
                    this.loaded = true
                 })
                 .catch((error) => {
                    alert('Something went wrong')
                })
        }
    }
</script>
