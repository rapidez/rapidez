<ul class="{{ config('snowdogmenu-extension.classes.'.(isset($loop->depth) ? $loop->depth + 1 : 1).'.ul') }}">
    @foreach ($items as $item)
        @include('snowdogmenu-extension::item')
    @endforeach
</ul>
