import './bootstrap';
import './custom'
import '@fortawesome/fontawesome-free/js/all.js';


import { createApp } from "vue/dist/vue.esm-bundler.js"

import Category from './pages/Category.vue'

const app = createApp({})


app.component('category', Category)

app.mount('#app')
