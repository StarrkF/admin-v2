import './bootstrap';
import './custom'
import '@fortawesome/fontawesome-free/js/all.js';


import { createApp } from "vue/dist/vue.esm-bundler.js"

import Category from './pages/Category.vue'
import Project from './pages/Project.vue'

const app = createApp({})


app.component('category', Category)
app.component('project', Project)

app.mount('#app')
