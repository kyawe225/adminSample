import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import { } from 'vuetify';
import { createRouter,createWebHashHistory } from 'vue-router';
import { createVuetify } from 'vuetify';
import routes from './routes';

const router=createRouter({
    routes,
    history:createWebHashHistory()
})

const vuetify=createVuetify();



createApp(App).use(router).use(vuetify).mount('#app')
