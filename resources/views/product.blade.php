@extends('layouts.app')

@section('title', $product->meta_title)
@section('description', $product->meta_description)

@section('content')
    <h1 class="font-bold text-4xl">{{ $product->name }}</h1>
    <div class="p-3 mb-5 bg-gray-200 rounded">
        {!! $product->description !!}
    </div>

    <div class="font-bold text-3xl mb-3">{{ round($product->price, 2) }}</div>

    <dl class="flex flex-wrap w-64">
        <dt class="w-1/2 font-bold">SKU</dt>
        <dd class="w-1/2">{{ $product->sku }}</dd>
        <dt class="w-1/2 font-bold">Color</dt>
        <dd class="w-1/2">{{ $product->color_value }}</dd>
        <dt class="w-1/2 font-bold">Brand</dt>
        <dd class="w-1/2">{{ $product->manufacturer_value }}</dd>
        <dt class="w-1/2 font-bold">Shoe type</dt>
        <dd class="w-1/2">{{ $product->shoe_type_value }}</dd>
    </dl>
@endsection
