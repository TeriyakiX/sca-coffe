import { defineStore } from 'pinia'
import { login, logout, me } from '@/shared/api/admin'

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null,
        checked: false,
    }),

    getters: {
        isAdmin: (state) => Boolean(state.user?.is_admin),
    },

    actions: {
        async check() {
            if (this.checked) {
                return this.user
            }

            try {
                this.user = await me()
            } catch (e) {
                this.user = null
            } finally {
                this.checked = true
            }

            return this.user
        },

        async signIn(credentials) {
            this.user = await login(credentials)
            this.checked = true

            return this.user
        },

        async signOut() {
            await logout()

            this.user = null
            this.checked = true
        },
    },
})
