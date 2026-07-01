// resources/js/app.js
import './bootstrap'
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { ZiggyVue } from '../../vendor/tightenco/ziggy'

// Импортируем глобальные стили
import './app/assets/styles/main.css'

// Импортируем Pinia
import { createPinia } from 'pinia'

const appName = import.meta.env.VITE_APP_NAME || 'SCA Coffee'

const pages = import.meta.glob([
    './Pages/**/*.vue',
    './modules/**/pages/*.vue'
], { eager: true })

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        let page = pages[`./Pages/${name}.vue`]
        if (page) return page
        const parts = name.split('/')
        const module = parts[0].toLowerCase()
        const component = parts[1] || 'Index'
        page = pages[`./modules/${module}/pages/${component}.vue`]
        if (page) return page

        throw new Error(`Page not found: ${name}`)
    },
    setup({ el, App, props, plugin }) {
        const pinia = createPinia()

        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(pinia)
            .use(ZiggyVue)
            .mount(el)
    },
    progress: {
        color: '#2D9359',
    },
})
