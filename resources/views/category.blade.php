@extends('layouts.app')

@section('title', $category->meta_title)
@section('description', $category->meta_description)

@section('content')
    <h1 class="font-bold text-3xl">{{ $category->name }}</h1>
    {!! $category->description !!}
@endsection
