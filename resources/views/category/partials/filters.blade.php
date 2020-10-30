<x-slideover>
    <x-slot name="button">
        <button type="button" class="md:hidden btn btn-primary w-full mb-3" @click="toggle">@lang('Filters')</button>
    </x-slot>

    <reactive-component component-id="category">
        <div slot-scope="{ setQuery }">
            <category-filter :set-query="setQuery"></category-filter>
        </div>
    </reactive-component>

    <template v-for="filter in filters">
        @include('category.partials.filter.price')
        @include('category.partials.filter.swatch')
        @include('category.partials.filter.boolean')
        @include('category.partials.filter.select')
    </template>
</x-slideover>
