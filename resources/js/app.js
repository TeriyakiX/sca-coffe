import './bootstrap'
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import router from './router'
import App from './Components/App.vue'
import { reveal } from './shared/directives/reveal'

import './app/assets/styles/main.css'

const app = createApp(App)
const pinia = createPinia()

app.use(pinia)
app.use(router)
app.directive('reveal', reveal)

app.mount('#app')
