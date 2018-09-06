import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './components/App'
import Login from './components/Login'
import Home from './components/Home'
import Registration from './components/Registration'
import Sendfile from './components/Sendfile'

Vue.component('Login', Login);
Vue.component('Registration', Registration);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
        },
        {
            path: '/registration',
            name: 'registration',
            component: Registration,
        },
        {
            path: '/sendfile',
            name: 'sendfile',
            component: Sendfile,
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});