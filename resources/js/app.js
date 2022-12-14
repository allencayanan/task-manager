import './bootstrap'
import { createApp } from 'vue'

import App from './App.vue'
import router from './router'
import VueAxios from 'vue-axios';
import axios from 'axios';
import store from './store'


import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap'

createApp(App)
  .use(store)
  .use(router)
  .use(VueAxios, axios)
  .mount('#app')
