@extends('layouts.app')

@section('title', $product->meta_title ?: $product->name)
@section('description', $product->meta_description)

@section('content')
    <div class="flex mb-5">
        <div class="w-2/3">
            <div class="flex flex-wrap">
                @foreach($product->images as $image)
                    <img src="{{ config('shop.media_url').'/catalog/product'.$image->value }}" alt="{{ $product->name }}" class="w-1/2">
                @endforeach
            </div>
        </div>
        <div class="w-1/3">
            <h1 class="font-bold text-4xl">{{ $product->name }}</h1>
            <div class="font-bold text-3xl mb-3">{{ $product->formattedPrice }}</div>

            @if($product->variants)
                <div class="flex">
                    @foreach($product->variants as $variant)
                        <a href="{{ $variant->url_key }}" title="{{ $variant->name }}" class="w-16">
                            <img src="{{ config('shop.media_url').'/catalog/product'.$variant->image }}" alt="{{ $variant->name }}">
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
        <dt class="w-1/2 font-bold">Color</dt>
        <dd class="w-1/2">{{ $product->color }}</dd>
        <dt class="w-1/2 font-bold">Brand</dt>
        <dd class="w-1/2">{{ $product->manufacturer }}</dd>
        <dt class="w-1/2 font-bold">Shoe type</dt>
        <dd class="w-1/2">{{ $product->shoe_type }}</dd>
    </dl>
@endsection
