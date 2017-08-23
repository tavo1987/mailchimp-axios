import Vue from 'vue';
import VeeValidate from 'vee-validate';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(VeeValidate);
Vue.component('app-form', require('./components/Form.vue'));
const app = new Vue({
    el: '#app'
});


/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

/* window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.baseUrl = 'https://us16.api.mailchimp.com/3.0'; */



/**
 * We'll load custom fonts with web font loader to improve page speed
 */

import WebFont from 'webfontloader';

WebFont.load({
    google: {
        families: ['Open Sans:300,400,700']
    }
});

