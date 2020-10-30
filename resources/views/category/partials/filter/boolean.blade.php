<multi-list
    v-else-if="filter.input == 'boolean'"
    :component-id="filter.code"
    :data-field="filter.code+(filter.type != 'int' ? '.keyword' : '')"
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
>
    <span
        slot="renderItem"
        slot-scope="{ label, count }"
    >
        <template v-if="label">@lang('Yes')</template>
        <template v-else>@lang('No')</template>
        <span class="text-gray-400">(@{{ count }})</span>
    </span>
</multi-list>
