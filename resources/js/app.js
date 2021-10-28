// require('./bootstrap');

// Require Vue
window.Vue = require('vue').default;

// Register Vue Components
Vue.component('list-component', require('./components/ListComponent.vue').default);
Vue.component('creative-button', require('./components/CreativeUploadButtonComponent.vue').default);

// Initialize Vue
new Vue({
    el: '#app',
});