<script>
    export default {
        data: () => ({
            loaded: false,
            attributes: [],
            baseStyles: {},
        }),

        render() {
            return this.$scopedSlots.default({
                loaded: this.loaded,
                baseStyles: this.baseStyles,

                categoryQuery: this.categoryQuery,
                onChange: this.onChange,

                filters: this.filters,
                reactiveFilters: this.reactiveFilters,
                sortOptions: this.sortOptions,
            })
        },

        mounted() {
            if (sessionStorage.getItem('height')) {
                this.baseStyles = {
                    minHeight: sessionStorage.getItem('height') + 'px'
                }
            }

            if (sessionStorage.getItem('attributes')) {
                this.attributes = JSON.parse(sessionStorage.getItem('attributes'))
                this.loaded = true
                return;
            }

            axios.get('/api/attributes')
                 .then((response) => {
                    this.attributes = response.data
                    sessionStorage.setItem('attributes', JSON.stringify(this.attributes))
                    this.loaded = true
                 })
                 .catch((error) => {
                    alert('Something went wrong')
                })
        },

        methods: {
            categoryQuery() {
                return {
                    "query": {
                        "terms": {
                            "category_ids": [ this.$root.config.category.entity_id ]
                        }
                    }
                }
            },
            onChange() {
                sessionStorage.setItem('height', this.$el.clientHeight)
            },
        },

        computed: {
            filters: function () {
                return _.filter(this.attributes, function (attribute) {
                    return attribute.filter;
                })
            },
            sortings: function () {
                return _.filter(this.attributes, function (attribute) {
                    return attribute.sorting;
                })
            },
            reactiveFilters: function () {
                return _.map(this.filters, function (filter) {
                    return 'filter_' + filter.code + (filter.text_swatch || filter.visual_swatch ? '_swatch' : '');
                });
            },
            sortOptions: function () {
                return _.flatMap(this.sortings, function (sorting) {
                    return _.map(['asc', 'desc'], function (direction) {
                        return {
                            label: sorting.name + ' ' + direction,
                            dataField: sorting.code + (sorting.code != 'price' ? '.keyword' : ''),
                            sortBy: direction
                        }
                    })
                })
            }
        }
    }
</script>
