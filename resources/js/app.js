import router from './routes';
import VueRouter from 'vue-router'
import Vue from 'vue';

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';

import moment from 'moment'

import 'es6-promise/auto'
import axios from 'axios'
import VueAuth from '@websanova/vue-auth'
import VueAxios from 'vue-axios'
import auth from './auth'

// Moment
Vue.prototype.moment = moment

Vue.router = router
Vue.use(VueRouter)


// Set Vue authentication
Vue.use(VueAxios, axios)
Vue.use(VueAuth, auth)

//sweet alert
Vue.use(VueSweetalert2);

Vue.component('v-select', vSelect)

require('./bootstrap');

window.Vue = require('vue');



Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('app', require('./components/AppComponent.vue').default);

Vue.component('principal', require('./components/layouts/Principal.vue').default);
Vue.component('spinner', require('./components/Spinner.vue').default);

Vue.component('dashboard', require('./views/Dashboard.vue').default);
Vue.component('clientes', require('./views/Clientes.vue').default);
Vue.component('membresias', require('./views/Membresias.vue').default);
Vue.component('asistencias', require('./views/Asistencias.vue').default);
Vue.component('reportes', require('./views/Reportes.vue').default);
Vue.component('login', require('./views/Login.vue').default);
Vue.component('register', require('./views/Register.vue').default);

const app = new Vue({
    el: '#app',
    router
});

