require('./bootstrap');
window.Vue = require('vue');
import Vue from 'vue'
import VueSimplemde from 'vue-simplemde'
Vue.component('vue-simplemde', VueSimplemde)
import User from './Helpers/User'
window.User = User
console.log(User.id())
window.EventBus = new Vue();
Vue.component('app-home', require('./components/AppHome.vue').default);
import router from './Router/router.js'
const app = new Vue({
    el: '#app',
    router
});
