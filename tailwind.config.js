module.exports = {
    purge: [
        './resources/views/**/*.blade.php',
        './resources/css/**/*.css',
        './resources/js/**/*.vue',

        './vendor/rapidez/core/resources/views/**/*.blade.php',
        './vendor/rapidez/core/resources/css/**/*.css',
        './vendor/rapidez/core/resources/js/**/*.vue',

        './vendor/rapidez/menu/src/config/menu.php',
    ],
    theme: {
        extend: {
            colors: {
                primary: 'var(--color-primary)',
                secondary: 'var(--color-secondary)',
            },
            inset: {
                '-full': '-100%',
                '1/2': '50%',
            },
            width: {
                '80': '20rem',
                '400px': '400px',
                '960px': '960px'
            }
        }
    },
    variants: {
        cursor: ['responsive', 'disabled'],
        display: ['responsive', 'group-hover'],
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
    },
    plugins: [
        require('@tailwindcss/ui'),
    ],
    experimental: {
        applyComplexClasses: true,
    }
}
