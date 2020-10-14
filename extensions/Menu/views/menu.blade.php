<ul class="{{ config('menu-extension.classes.'.(isset($loop->depth) ? $loop->depth + 1 : 1).'.ul') }}">
    @foreach ($items as $item)
        @include('menu-extension::item')
    @endforeach
</ul>
