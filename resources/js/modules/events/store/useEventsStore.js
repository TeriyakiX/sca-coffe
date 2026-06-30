// resources/js/modules/events/store/useEventsStore.js
import { defineStore } from 'pinia'

export const useEventsStore = defineStore('events', {
    state: () => ({
        events: [],
        selectedEvent: null,
        loading: false,
        error: null,
        filters: {
            status: 'upcoming'
        }
    }),

    actions: {
        async fetchEvents() {
            this.loading = true
            this.error = null

            try {
                // Мок-данные
                this.events = [
                    {
                        id: 1,
                        title: 'World of Coffee Brussels',
                        description: 'Крупнейшее кофейное мероприятие в Европе. Выставка, чемпионаты, мастер-классы.',
                        date: '2026-06-25',
                        location: 'Brussels, Belgium',
                        status: 'upcoming',
                        image: 'https://picsum.photos/seed/coffee1/400/300'
                    },
                    {
                        id: 2,
                        title: 'World Barista Championship 2026',
                        description: 'Чемпионат мира среди бариста. Возвращается в Латинскую Америку.',
                        date: '2026-10-23',
                        location: 'Panama City, Panama',
                        status: 'upcoming',
                        image: 'https://picsum.photos/seed/coffee2/400/300'
                    },
                    {
                        id: 3,
                        title: 'World of Coffee Dubai 2027',
                        description: 'Международная выставка кофе в Дубае. Инновации и новые тренды.',
                        date: '2027-01-26',
                        location: 'Dubai, UAE',
                        status: 'upcoming',
                        image: 'https://picsum.photos/seed/coffee3/400/300'
                    },
                    {
                        id: 4,
                        title: 'Coffee Roasting Masterclass',
                        description: 'Интенсивный курс по обжарке кофе от мировых экспертов.',
                        date: '2025-12-15',
                        location: 'London, UK',
                        status: 'past',
                        image: 'https://picsum.photos/seed/coffee4/400/300'
                    }
                ]
            } catch (error) {
                this.error = error.message
            } finally {
                this.loading = false
            }
        },

        setFilters(filters) {
            this.filters = { ...this.filters, ...filters }
            this.fetchEvents()
        }
    },

    getters: {
        upcomingEvents: (state) =>
            state.events.filter(e => e.status === 'upcoming'),

        pastEvents: (state) =>
            state.events.filter(e => e.status === 'past')
    }
})
