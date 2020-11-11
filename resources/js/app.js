window._ = require('lodash')
window.axios = require('axios')
window.Vue = require('vue')

window.Turbolinks = require('turbolinks')
Turbolinks.start()
import TurbolinksAdapter from 'vue-turbolinks'
Vue.use(TurbolinksAdapter)

import ReactiveSearch from '@appbaseio/reactivesearch-vue'
Vue.use(ReactiveSearch)

import AsyncComputed from 'vue-async-computed'
Vue.use(AsyncComputed)

require('Vendor/rapidez/core/resources/js/axios')
require('Vendor/rapidez/core/resources/js/filters')
require('Vendor/rapidez/core/resources/js/mixins')
require('Vendor/rapidez/core/resources/js/turbolinks')

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('cart', require('Vendor/rapidez/core/resources/js/components/Cart/Cart.vue').default)
Vue.component('category', require('Vendor/rapidez/core/resources/js/components/Category/Category.vue').default)
Vue.component('category-filter', require('Vendor/rapidez/core/resources/js/components/Category/Filters/CategoryFilter.vue').default)
Vue.component('swatch-filter', require('Vendor/rapidez/core/resources/js/components/Category/Filters/SwatchFilter.vue').default)
Vue.component('checkout', require('Vendor/rapidez/core/resources/js/components/Checkout/Checkout.vue').default)
Vue.component('login', require('Vendor/rapidez/core/resources/js/components/Checkout/Login.vue').default)
Vue.component('coupon', require('Vendor/rapidez/core/resources/js/components/Coupon/Coupon.vue').default)
Vue.component('toggler', require('Vendor/rapidez/core/resources/js/components/Elements/Toggler.vue').default)
Vue.component('add-to-cart', require('Vendor/rapidez/core/resources/js/components/Product/AddToCart.vue').default)
Vue.component('user', require('Vendor/rapidez/core/resources/js/components/User/User.vue').default)

Vue.component('product-compare-widget', require('Vendor/rapidez/compare/src/components/Widget.vue').default)
Vue.component('product-compare-checkbox', require('Vendor/rapidez/compare/src/components/Checkbox.vue').default)
Vue.component('product-compare-overview', require('Vendor/rapidez/compare/src/components/Overview.vue').default)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

document.addEventListener('turbolinks:load', () => {
    Vue.prototype.config = window.config
    window.app = new Vue({
        el: '#app',
        data: {
            config: window.config,
            loading: false,
            guestEmail: null,
            user: null,
            cart: null,
            checkout: {
                step: 1,
                shipping_address: {
                    'firstname': process.env.MIX_DEBUG ? 'Roy' : null,
                    'lastname': process.env.MIX_DEBUG ? 'Duineveld' : null,
                    'zipcode': process.env.MIX_DEBUG ? '1823CW' : null,
                    'housenumber': process.env.MIX_DEBUG ? 7 : null,
                    'street': process.env.MIX_DEBUG ? 'Pettemerstraat' : null,
                    'city': process.env.MIX_DEBUG ? 'Alkmaar' : null,
                    'telephone': process.env.MIX_DEBUG ? '0727100094' : null,
                },
                billing_address: {},

                shipping_method: null,
                shipping_methods: [],

                payment_method: null,
                payment_methods: [],
            }
        },
    })
})
