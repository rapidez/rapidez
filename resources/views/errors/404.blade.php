@extends('layouts.app')
@php
$page = \App\Models\Page::firstWhere('identifier', 'no-route')
@endphp

@section('title', $page->meta_title ?: $page->title)
@section('description', $page->meta_description)

@section('content')
    <h1 class="font-bold text-4xl">{{ $page->content_heading }}</h1>
    <div class="mb-5">
        {!! $page->content !!}
    </div>
@endsection
