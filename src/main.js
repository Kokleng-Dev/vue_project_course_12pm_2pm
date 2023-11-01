// import './assets/main.css'
import 'admin-lte/plugins/fontawesome-free/css/all.min.css'
import 'admin-lte/dist/css/adminlte.min.css'
import 'admin-lte/plugins/jquery/jquery.min.js'
import 'admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js'
import 'admin-lte/dist/js/adminlte.min.js'
import jquery from 'jquery';
window.$ = window.jQuery = jquery;

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

import Master from '@/components/Layouts/Master.vue'
import Header from '@/components/UI/Header.vue'
import Body from '@/components/UI/Body.vue'
import { AxiosApp } from '@/configs/service.js'

const app = createApp(App)
const pinia = createPinia()

app.config.globalProperties.$http = AxiosApp;
app.use(pinia)
app.component('Master',Master)
app.component('Header',Header)
app.component('Body',Body)
app.use(router)

app.mount('#app')
