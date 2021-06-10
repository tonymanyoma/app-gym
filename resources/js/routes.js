import Vue from 'vue/dist/vue.min.js'
import Router from 'vue-router';

window.Vue = require('vue');
Vue.use(Router)

import dashboard from './views/Dashboard'
import clientes from './views/Clientes'
import membresias from './views/Membresias'
import asistencias from './views/Asistencias'
import reportes from './views/Reportes'
import login from './views/Login'
import register from './views/Register'

export default  new Router({
    routes:[

        {
            path: '/register',
            name: 'register',
            component: register,
            meta: {
              auth: false
            }
          },
          {
            path: '/login',
            name: 'login',
            component: login,
            meta: {
              auth: false
            }
          },

       /* {
            path: '/',
            name: 'dashboard',
            component: dashboard,
            meta: {
                auth: true
              }

        },*/

        {
            path: '/',
            name: 'clientes',
            component: clientes,
            meta: {
                auth: true
              }

        },

        {
            path: '/membresia',
            name: 'membresias',
            component: membresias,
            meta: {
                auth: true
              }

        },

        {
            path: '/asistencia',
            name: 'asistencias',
            component: asistencias,
            meta: {
                auth: true
              }

        },

        {
            path: '/reportes',
            name: 'reportes',
            component: reportes,
            meta: {
                auth: true
              }

        },


    ],
    mode: 'history'

})
