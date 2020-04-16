module.exports = {
  theme: {
    extend: {
        colors: {
            primary: 'var(--color-primary)',
            secondary: 'var(--color-secondary)',
        },
        inset: {
            '-full': '-100%',
        }
    }
  },
  variants: {},
  plugins: [
    require('@tailwindcss/custom-forms')
  ]
}
