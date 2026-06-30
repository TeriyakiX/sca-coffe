// resources/js/app.js
import './bootstrap'
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ZiggyVue } from '../../vendor/tightenco/ziggy'

// Импортируем глобальные стили
import './app/assets/styles/main.css'

// Импортируем Pinia
import { createPinia } from 'pinia'

const appName = import.meta.env.VITE_APP_NAME || 'SCA Coffee'

// Собираем все страницы из модулей и Pages
const pages = import.meta.glob([
    './Pages/**/*.vue',
    './modules/**/pages/*.vue'
])

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        // Пробуем найти страницу в модулях
        // Например: Membership/Join -> ./modules/membership/pages/Join.vue
        const modulePath = `./modules/${name.toLowerCase()}.vue`

        // Ищем среди всех страниц
        for (const [path, resolver] of Object.entries(pages)) {
            // Проверяем совпадение
            const normalizedPath = path.replace('./modules/', '').replace('./Pages/', '')
            const normalizedName = name.replace(/\\/g, '/')

            if (normalizedPath.includes(normalizedName) ||
                path.includes(`modules/${name.split('/')[0].toLowerCase()}/pages/${name.split('/')[1]}.vue`)) {
                return resolver()
            }
        }

        // Если не нашли - ищем в Pages
        return resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue')
        )
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
