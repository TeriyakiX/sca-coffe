// resources/js/bootstrap.js
import axios from 'axios'

// Настройка axios
window.axios = axios
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
window.axios.defaults.withCredentials = true
window.axios.defaults.withXSRFToken = true

// Импортируем Inertia
import { router } from '@inertiajs/vue3'

// Глобальный обработчик ошибок
router.on('error', (error) => {
    console.error('Inertia error:', error)
})
