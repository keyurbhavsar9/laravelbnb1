/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import router from "./routes";
import VueRouter from "vue-router";
import Index from './index.vue'
import moment from "moment";

window.Vue = require('vue');

Vue.filter("fromNow",value=>moment(value).fromNow());


// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('example-2', require('./components/Example2.vue').default); // commenting this will work

Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    router,
    components:{
        "index" : Index
    }
});
