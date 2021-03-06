import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './store/index';
import Projects from './components/Projects';
import ProjectDetails from './components/ProjectDetails';
import Login from './components/Login';
import Dashboard from './components/Dashboard';

Vue.use(VueRouter);

const Router = new VueRouter({
    routes: [
        { path: '/', component: Login, name: 'home' },
        { path: '/login', component: Login, name: 'login', alias: '/' },
        { path: '/dashboard', component: Dashboard, name: 'dashboard', meta: { requiredAuth: true } },
        { path: '/projects', component: Projects, name: 'projects', meta: { requiredAuth: true } },
        { path: '/projects/:id', component: ProjectDetails, name: 'project-details', meta: { requiredAuth: true }, props: true },
    ],
    mode: 'history'
});

Router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiredAuth)) {
        if (!store.getters.authenticated) {
            next({ name: 'login' })
        } else {
            next();
        }
    }
    next();
});

export default Router;