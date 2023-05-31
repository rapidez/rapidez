(() => {
    const components = {
        // Eager load all components not containing an extra . in the name
        ...import.meta.glob(['./components/*([^\.]).vue'], { eager: true, import: 'default' }),
        // Lazy load all components not ending with .lazy.vue
        ...import.meta.glob(['./components/*.lazy.vue'], { eager: false, import: 'default' })
    };
    for (const path in components) {
        // Register component using their filename.
        Vue.component(path.split('/').pop().split('.').shift(), components[path])
    }
})();
