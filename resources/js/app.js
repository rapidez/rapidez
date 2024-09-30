import './components.js'

import.meta.glob([
    // Automatically import all installed Rapidez module scripts and styles.
    'Vendor/rapidez/*/resources/js/package.js',
    'Vendor/rapidez/*/resources/css/package.css',

    // Exclude specific JS or CSS files if needed (https://vitejs.dev/guide/features.html#negative-patterns).
    // '!Vendor/rapidez/account/resources/js/package.js',
    // '!Vendor/rapidez/account/resources/css/package.css',

    // Or to load all JS or CSS files from another vendor (https://vitejs.dev/guide/features.html#multiple-patterns).
    // 'Vendor/<vendor>/*/resources/js/package.js',
    // 'Vendor/<vendor>/*/resources/css/package.css',
], { eager: true });
