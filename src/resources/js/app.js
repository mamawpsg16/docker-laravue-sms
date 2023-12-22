import './bootstrap';
import { createApp } from 'vue'
import App from '@/views/App.vue';
import router from '@/router/index.js';
import 'vue3-form-wizard/dist/style.css'
import '@fortawesome/fontawesome-free/css/all.min.css';
import '@vuepic/vue-datepicker/dist/main.css'
import 'vue-multiselect/dist/vue-multiselect.css'

const app = createApp(App);
app.use(router);
app.mount('#app');