import axios from 'axios'

const http = axios.create({
    baseURL: '/api/v1',
    withCredentials: true,
    withXSRFToken: true,
    headers: {
        Accept: 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
    },
})

const isAdminRequest = (config) => (config?.url ?? '').includes('/admin/')

const isAdminPage = () => window.location.pathname.startsWith('/admin')

http.interceptors.response.use(
    (response) => response,
    (error) => {
        const status = error?.response?.status
        const unauthorized = status === 401 || status === 419 || status === 403

        if (unauthorized && isAdminRequest(error.config) && isAdminPage()) {
            if (!window.location.pathname.startsWith('/admin/login')) {
                window.location.assign('/admin/login')
            }
        }

        return Promise.reject(error)
    },
)

export const unwrap = (response) => response.data?.data ?? null

export const extractErrors = (error) => {
    const response = error?.response

    if (response?.status === 422) {
        return {
            message: response.data?.message ?? 'Проверьте правильность заполнения полей',
            fields: response.data?.errors ?? {},
        }
    }

    if (response?.status === 401 || response?.status === 419) {
        return {
            message: 'Сессия истекла. Войдите в панель заново.',
            fields: {},
        }
    }

    return {
        message: response?.data?.message ?? 'Не удалось выполнить запрос. Попробуйте позже.',
        fields: {},
    }
}

export default http
