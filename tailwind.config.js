module.exports = {
    purge: [
        './resources/views/**/*.blade.php',
        './resources/css/**/*.css',
        './resources/js/**/*.vue',
        './extensions/**/*.vue',
        './extensions/**/*.blade.php',
        './extensions/Menu/config/menu-extension.php',
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
