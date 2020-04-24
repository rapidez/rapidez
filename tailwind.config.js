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
  variants: {},
  plugins: [
    require('@tailwindcss/custom-forms')
  ]
}
