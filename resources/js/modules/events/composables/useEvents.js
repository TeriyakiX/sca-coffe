// resources/js/modules/events/composables/useEvents.js
import { computed, onMounted } from 'vue'
import { useEventsStore } from '../store/useEventsStore'

export function useEvents() {
    const store = useEventsStore()

    onMounted(() => {
        store.fetchEvents()
    })

    return {
        events: computed(() => store.events),
        loading: computed(() => store.loading),
        error: computed(() => store.error),
        upcomingEvents: computed(() => store.upcomingEvents),
        fetchEvents: store.fetchEvents,
        setFilters: store.setFilters
    }
}
