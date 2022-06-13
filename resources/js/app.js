import Vue from 'vue';
import router from './router';
import store from './store/index';

require('./bootstrap');
import axios from 'axios';
axios.defaults.withCredentials = true;
axios.defaults.baseURL = 'http://laravel-api.test/'

import App from './components/App';

store.dispatch('getUser').then(() => {

    const app = new Vue({
        el: '#app',
        components: {
            App
        },
        router,
        store
    });
});
