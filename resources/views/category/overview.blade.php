@extends('layouts.app')

@section('title', $category->meta_title ?: $category->name)
@section('description', $category->meta_description)

@section('content')
    <h1 class="font-bold text-3xl">{{ $category->name }}</h1>

    @if($block = App\Models\Block::find($category->banners))
        {!! str_replace('<ul>', '<ul class="flex">', $block->content) !!}
    @endif

    @if($category->is_anchor)
        <category v-cloak>
            <div
                slot-scope="{ loaded, baseStyles, filters, reactiveFilters, sortOptions, categoryQuery, onChange }"
                :style="baseStyles"
            >
                <reactive-base
                    :app="'products_' + config.store"
                    :url="config.es_url"
                    v-if="loaded"
                >
                    <selected-filters />
                    <div class="flex flex-col md:flex-row">
                        <div class="md:w-1/5">
                            @include('category.partials.filters')
                        </div>
                        <div class="md:w-4/5">
                            @include('category.partials.listing')
                        </div>
                    </div>
                </reactive-base>
            </div>
        </category>
    @else
        <i>This is a non anchor category without any content because most likely everything is rendered with layout updates or widgets.</i>
    @endif

    {!! str_replace('<h2>', '<h2 class="font-bold text-2xl">', $category->description) !!}
@endsection

@push('page_end')
    <product-compare-widget
        class-product="py-2 border-b border-primary"
    />
@endpush
