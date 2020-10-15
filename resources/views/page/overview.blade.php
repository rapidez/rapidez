@extends('layouts.app')

@section('title', $page->meta_title ?: $page->title)
@section('description', $page->meta_description)

@section('content')
    <h1 class="font-bold text-4xl">{{ $page->content_heading }}</h1>
    <div class="mb-5">
        {!! $page->content ?: '<i>This page doesn\'t have any content because most likely everything is rendered with layout updates or widgets.</i>' !!}
    </div>
@endsection
