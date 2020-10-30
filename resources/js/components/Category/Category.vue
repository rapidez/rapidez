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
                    return filter.code;
                }).concat(['category']);
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
