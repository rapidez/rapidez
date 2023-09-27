(() => {
    const components = {
        // Eager load all components not ending with .lazy.vue
        ...import.meta.glob(['./components/**/*.vue', '!./components/**/*.lazy.vue'], { eager: true, import: 'default' }),
        // Lazy load all components not ending with .lazy.vue
        ...import.meta.glob(['./components/**/*.lazy.vue'], { eager: false, import: 'default' })
    };
    for (const path in components) {
        let componentName = path
            .split('/').pop() // Remove directories
            .split('.').shift() // Remove extension
            .replace(/^.|[A-Z]/g, letter => `-${letter.toLowerCase()}`) // PascalCase to snake_case
            .substring(1) // Remove the starting dash

        // Register component using their filename.
        Vue.component(componentName, components[path])
    }
})();
