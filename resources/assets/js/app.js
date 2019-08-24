
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./contents.js');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// import EventHub from './EventHub'
// Vue.use(EventHub)

Vue.prototype.$eventHub = new Vue();

import { ToggleButton } from 'vue-js-toggle-button'
Vue.use(ToggleButton)

Vue.component('CertificatesDrop', require('./components/certificates/Drop.vue').default);
Vue.component('CertificatesEdit', require('./components/certificates/Edit.vue').default);
Vue.component('CertificatesSubmit', require('./components/certificates/Submit.vue').default);
Vue.component('CertificatesSymlinkButton', require('./components/certificates/SymlinkButton.vue').default);
Vue.component('CertificatesDropSpace', require('./components/certificates/DropSpace.vue').default);
Vue.component('CommonnamesCards', require('./components/commonnames/index.vue').default);


const app = new Vue({
    el: '#app'
});
