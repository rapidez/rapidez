@extends('layouts.app')

@section('title', $product->meta_title)
@section('description', $product->meta_description)

@section('content')
    <div class="flex mb-5">
        <div class="w-2/3">
            Images
        </div>
        <div class="w-1/3">
            <h1 class="font-bold text-4xl">{{ $product->name }}</h1>
            <div class="font-bold text-3xl mb-3">{{ round($product->price, 2) }}</div>

            @if($product->variants)
                <div class="flex">
                    @foreach($product->variants as $variant)
                        <a href="{{ $variant->url_key }}" title="{{ $variant->name }}" class="w-16">
                            <img src="{{ config('shop.media_url').'/catalog/product'.$variant->image }}">
                        </a>
                    @endforeach
                </div>
            @endif

            <form>
                @foreach ($product->super_attributes as $superAttributeId => $superAttribute)
                    <label for="super_attribute_{{ $superAttributeId }}">{{ $superAttribute->label }}</label>
                    <div class="inline-block relative w-64 mb-3">
                        <select id="super_attribute_{{ $superAttributeId }}" name="{{ $superAttributeId }}" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                            @foreach($product->{Str::slug($superAttribute->code, '_')} as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                @endforeach

                <button type="submit" class="block btn btn-primary">Add to cart</button>
            </form>
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
