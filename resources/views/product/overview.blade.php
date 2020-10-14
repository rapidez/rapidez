@extends('layouts.app')

@section('title', $product->meta_title ?: $product->name)
@section('description', $product->meta_description)

@section('content')
    <div class="flex mb-5">
        <div class="w-2/3">
            <div class="flex flex-wrap items-center">
                @foreach($product->images as $image)
                    <img src="/image/467/catalog/product{{ $image->value }}" alt="{{ $product->name }}" class="w-1/2">
                @endforeach
            </div>
        </div>
        <div class="w-1/3">
            <h1 class="font-bold text-4xl">{{ $product->name }}</h1>
            <div class="font-bold text-3xl mb-3">{{ $product->formattedPrice }}</div>

            @if($product->variants)
                <div class="flex items-center">
                    @foreach($product->variants as $variant)
                        <a href="{{ $variant->url_key }}" title="{{ $variant->name }}" class="w-16">
                            <img src="/image/64x64/catalog/product{{ $variant->image }}" alt="{{ $variant->name }}">
                        </a>
                    @endforeach
                </div>
            @endif

            <add-to-cart btn-class="block btn btn-primary" />
        </div>
    </div>

    <div class="p-3 mb-5 bg-gray-200 rounded">
        {!! $product->description !!}
    </div>

    <dl class="flex flex-wrap w-64">
        <dt class="w-1/2 font-bold">ID</dt>
        <dd class="w-1/2">{{ $product->id }}</dd>
        <dt class="w-1/2 font-bold">SKU</dt>
        <dd class="w-1/2">{{ $product->sku }}</dd>
        <dt class="w-1/2 font-bold">Style</dt>
        <dd class="w-1/2">{{ implode(', ', $product->style_general) }}</dd>
        <dt class="w-1/2 font-bold">Pattern</dt>
        <dd class="w-1/2">{{ implode(', ', $product->pattern) }}</dd>
        <dt class="w-1/2 font-bold">Climate</dt>
        <dd class="w-1/2">{{ implode(', ', $product->climate) }}</dd>
    </dl>
@endsection
