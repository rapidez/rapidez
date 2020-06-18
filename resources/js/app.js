/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import ReactiveSearch from '@appbaseio/reactivesearch-vue';
Vue.use(ReactiveSearch);
require('./filters');

var Turbolinks = require("turbolinks")
Turbolinks.start()
import TurbolinksAdapter from 'vue-turbolinks';
Vue.use(TurbolinksAdapter)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('product-compare-widget', require('Extensions/Compare/components/Widget.vue').default);
Vue.component('product-compare-checkbox', require('Extensions/Compare/components/Checkbox.vue').default);
Vue.component('product-compare-overview', require('Extensions/Compare/components/Overview.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

document.addEventListener('turbolinks:load', () => {
    Vue.prototype.config = window.config;
    window.app = new Vue({
        el: '#app',
        data: {
            config: window.config,
            loading: false,
            cart: null,
        },
    });
});
