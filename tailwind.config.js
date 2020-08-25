module.exports = {
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
        require('@tailwindcss/custom-forms')
    ],
    experimental: {
        applyComplexClasses: true,
    }
}
