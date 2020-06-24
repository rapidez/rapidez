window._ = require('lodash');
window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.magento = axios.create()
window.magento.defaults.baseURL = config.magento_url + '/rest/' + config.store_code + '/V1/'

// It's not possible to set global interceptors like headers
// or the base url can; so we set them for all instances.
// See: https://github.com/axios/axios/issues/510
const instances = [window.axios, window.magento]
instances.forEach(function (instance) {
    instance.interceptors.request.use(function (config) {
        window.app.$data.loading = true
        return config;
    }, function (error) {
        return Promise.reject(error);
    });

    instance.interceptors.response.use(function (response) {
        window.app.$data.loading = false
        return response
    }, function(error) {
        window.app.$data.loading = false
        return Promise.reject(error)
    });
})
