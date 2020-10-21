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
        @foreach(['style_general', 'pattern', 'climate', 'activity', 'style_bags', 'material', 'strap_bags', 'features_bags', 'gender', 'category_gear', 'format', 'style_bottom', 'style_general'] as $attribute)
            @if($product->$attribute)
                <dt class="w-1/2 font-bold">{{ ucfirst(str_replace('_', ' ', $attribute)) }}</dt>
                <dd class="w-1/2">{{ is_array($product->$attribute) ? implode(', ', $product->$attribute) : $product->$attribute }}</dd>
            @endif
        @endforeach
    </dl>
@endsection
