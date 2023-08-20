import { createApp } from 'vue';
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";
import router from './router';
import App from './App.vue';
import {createPinia} from "pinia";
const pinia = createPinia();

createApp(App).mount('#app')
