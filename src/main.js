// import './assets/main.css'

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
import { base64Encode , base64Decode } from '@/configs/encryption.js'
import ToastPlugin from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-bootstrap.css';
import { alerts } from './configs/alert.js'

import 'admin-lte/plugins/fontawesome-free/css/all.min.css'
import 'admin-lte/dist/css/adminlte.min.css'
import 'admin-lte/plugins/jquery/jquery.min.js'
import 'admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js'
import 'admin-lte/dist/js/adminlte.min.js'
import axios from 'axios';

// axios.defaults.baseURL = 'http://127.0.0.1:8000/api';
// axios.defaults.headers.common['Authorization'] = base64Decode(localStorage.getItem('token'));
// axios.defaults.headers.common['api_key'] = base64Encode('abc');
// axios.defaults.headers.common['type'] = base64Encode('web');
// axios.defaults.headers.post['Content-Type'] = 'application/json';

const app = createApp(App)
const pinia = createPinia()

app.config.globalProperties.$http = AxiosApp;
app.config.globalProperties.$base64Encode = base64Encode;
app.config.globalProperties.$base64Decode = base64Decode;
app.config.globalProperties.$alert = alerts;

app.use(pinia)
app.component('Master',Master)
app.component('Header',Header)
app.component('Body',Body)
app.use(router)
app.use(ToastPlugin)

app.mount('#app')
