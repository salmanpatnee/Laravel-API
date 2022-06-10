import Vue from 'vue';
import VueRouter from 'vue-router';
import Projects from './components/Projects';
import Login from './components/Login';
import Dashboard from './components/Dashboard';

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        { path: '/', component: Login, name: 'home' },
        { path: '/login', component: Login, name: 'login', alias: '/' },
        { path: '/dashboard', component: Dashboard, name: 'dashboard' },
        { path: '/projects', component: Projects },
    ],
    mode: 'history'
});