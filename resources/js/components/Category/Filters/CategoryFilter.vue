<script>
export default {
    props: {
        setQuery: Function
    },
    mounted() {
        this.setQuery({
            query: {
                terms: {
                    category_ids: [ this.$root.config.category.entity_id ]
                }
            }
        });
    },
    render: h => null
};
</script>
