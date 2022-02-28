require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from './routes'

Vue.config.productionTip = false
window.Vue = require('vue').default;

Vue.component('index-client', require('./components/Index').default);
Vue.use(VueRouter)

const app = new Vue({
    el: '#app',
    router: new VueRouter({
        routes,
        mode: 'history'
    })
});
