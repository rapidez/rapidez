@extends('layouts.app')

@section('title', $category->meta_title)
@section('description', $category->meta_description)

@section('content')
    <h1 class="font-bold text-3xl">{{ $category->name }}</h1>

    @if($block = App\Block::find($category->banners))
        {!! str_replace('<ul>', '<ul class="flex">', $block->content) !!}
    @endif

    <products></products>

    {!! str_replace('<h2>', '<h2 class="font-bold text-2xl">', $category->description) !!}
@endsection

@push('page_end')
    <product-compare-widget
        class-wrapper="fixed right-0 bottom-0 mr-16 p-3 bg-blue-500 rounded-t"
        class-product="border-b"
    />
@endpush
