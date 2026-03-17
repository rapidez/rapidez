import './components.js'

import.meta.glob([
    // Automatically import all installed Rapidez module scripts and styles.
    'Vendor/rapidez/*/resources/js/package.js',

    // Exclude specific JS files if needed (https://vitejs.dev/guide/features.html#negative-patterns).
    // '!Vendor/rapidez/account/resources/js/package.js',

    // Or to load all JS files from another vendor (https://vitejs.dev/guide/features.html#multiple-patterns).
    // 'Vendor/<vendor>/*/resources/js/package.js',
], { eager: true });
