<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', '')</title>
    <meta name="description" content="@yield('description', '')"/>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-white antialiased">
    <div id="app">
        <layout-header
            store="{{ config('shop.store') }}"
            category="{{ $category->entity_id }}"
            media-url="{{ config('shop.media_url') }}"
        >
        </layout-header>
        <div class="mx-5">
            @yield('content')
        </div>
        <layout-footer></layout-footer>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
