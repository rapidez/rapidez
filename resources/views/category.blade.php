@extends('layouts.app')

@section('title', $category->meta_title)
@section('description', $category->meta_description)

@section('content')
    <h1 class="font-bold text-3xl">{{ $category->name }}</h1>

    @if($block = App\Block::find($category->banners))
        {!! str_replace('<ul>', '<ul class="flex">', $block->content) !!}
    @endif

    <products
        store="{{ config('shop.store') }}"
        category="{{ $category->entity_id }}"
        media-url="{{ config('shop.media_url') }}"
    ></products>

    {!! str_replace('<h2>', '<h2 class="font-bold text-2xl">', $category->description) !!}
@endsection
