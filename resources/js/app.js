import './components.js'

import.meta.glob([
    // Automatically import all installed Rapidez module scripts.
    'Vendor/rapidez/*/resources/js/package.js',
    // To exclude a specific file add the path with a !: (https://vitejs.dev/guide/features.html#negative-patterns)
    // '!Vendor/rapidez/account/resources/js/package.js',
    // Or to load all js files from another vendor: (https://vitejs.dev/guide/features.html#multiple-patterns)
    // 'Vendor/<vendor>/*/resources/js/package.js',
], { eager: true });
