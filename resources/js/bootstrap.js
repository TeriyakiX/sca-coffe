import axios from 'axios'

window.axios = axios
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
window.axios.defaults.withCredentials = true
window.axios.defaults.withXSRFToken = true

import { router } from '@inertiajs/vue3'

router.on('error', (error) => {
    console.error('Inertia error:', error)
})
