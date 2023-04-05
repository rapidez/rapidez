# Components

This folder will contain your Vue components. Any `.vue` file present in this folder will be registered; any file a level deeper will not!

## Lazy loading

Setting the file extension of your file in this folder as `.lazy.vue` will ensure that it is bundled separately and not included in the `app.js` bundle. Note that you do not deal with them differently than any other vue component. Though if you know it's going to be used above the fold on a page you can ensure it is preloaded on that page using the following:

```blade
@pushOnce('head')
    @if($file = vite_filename_path('<filename_or_end_of_path>.vue'))
        @vite([$file])
    @endif
@endPushOnce
```

This will ensure the file and it's dependencies are loaded as fast as possible. We're using this in the `listing.blade.php`. See: https://github.com/rapidez/core/blob/master/resources/views/components/listing.blade.php
