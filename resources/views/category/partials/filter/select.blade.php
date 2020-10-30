<multi-list
    v-else
    :component-id="filter.code"
    :data-field="filter.code+'.keyword'"
    :inner-class="{
        title: 'capitalize font-semibold',
        count: 'text-gray-400',
        list: 'max-h-none-important',
        label: 'text-gray-600'
    }"
    :title="filter.name.replace('_', ' ')"
    :react="{and: reactiveFilters}"
    :query-format="filter.input == 'multiselect' ? 'and' : 'or'"
    :show-search="false"
    u-r-l-params
></multi-list>
