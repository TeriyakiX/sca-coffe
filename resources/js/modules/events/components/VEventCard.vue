<!-- resources/js/modules/events/components/VEventCard.vue -->
<template>
    <div class="event-card">
        <div v-if="event.image" class="event-card__image">
            <img :src="event.image" :alt="event.title" />
            <span class="event-card__badge" :class="`badge-${statusColor}`">
        {{ statusLabel }}
      </span>
        </div>

        <div class="event-card__content">
            <h3 class="event-card__title">{{ event.title }}</h3>
            <p class="event-card__description">{{ event.description }}</p>

            <div class="event-card__meta">
                <span class="event-card__date">📅 {{ formatDate(event.date) }}</span>
                <span class="event-card__location">📍 {{ event.location }}</span>
            </div>

            <div class="event-card__actions">
                <button class="btn btn-primary" @click="$emit('register', event.id)">
                    Зарегистрироваться
                </button>
                <button class="btn btn-outline" @click="$emit('details', event.id)">
                    Подробнее
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue'
import { EVENT_STATUS_LABELS, EVENT_STATUS_COLORS } from '../constants/eventStatus'

const props = defineProps({
    event: { type: Object, required: true }
})

defineEmits(['register', 'details'])

const statusLabel = computed(() => EVENT_STATUS_LABELS[props.event.status] || props.event.status)
const statusColor = computed(() => EVENT_STATUS_COLORS[props.event.status] || 'gray')

const formatDate = (date) => {
    return new Date(date).toLocaleDateString('ru-RU', {
        day: 'numeric',
        month: 'long',
        year: 'numeric'
    })
}
</script>

<style scoped>
.event-card {
    background: var(--color-white);
    border-radius: var(--radius);
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: all 0.3s ease;
}

.event-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-xl);
}

.event-card__image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.event-card__image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.event-card__badge {
    position: absolute;
    top: 12px;
    right: 12px;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.badge-success { background: var(--color-success); color: white; }
.badge-warning { background: #FFC107; color: var(--color-text); }
.badge-danger { background: var(--color-error); color: white; }
.badge-gray { background: var(--color-gray-light); color: var(--color-text); }

.event-card__content {
    padding: 20px 24px;
}

.event-card__title {
    font-size: 20px;
    font-weight: 700;
    margin: 0 0 8px 0;
    color: var(--color-text);
}

.event-card__description {
    color: var(--color-gray);
    font-size: 14px;
    margin: 0 0 16px 0;
    line-height: 1.5;
}

.event-card__meta {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    margin-bottom: 16px;
    font-size: 14px;
    color: var(--color-gray);
}

.event-card__meta span {
    display: flex;
    align-items: center;
    gap: 4px;
}

.event-card__actions {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.btn {
    padding: 8px 16px;
    border: none;
    border-radius: var(--radius-sm);
    font-family: var(--font-family);
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 14px;
}

.btn-primary {
    background: var(--color-primary);
    color: white;
}
.btn-primary:hover {
    background: var(--color-primary-dark);
}

.btn-outline {
    background: transparent;
    color: var(--color-primary);
    border: 2px solid var(--color-primary);
}
.btn-outline:hover {
    background: var(--color-primary);
    color: white;
}
</style>
