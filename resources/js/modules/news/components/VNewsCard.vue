<template>
    <RouterLink :to="`/news/${item.slug}`" class="news-card">
        <div class="news-card__meta">
            <span class="news-card__category">{{ item.category_label }}</span>
            <time class="news-card__date" :datetime="item.published_at">{{ formatDate(item.published_at) }}</time>
        </div>
        <h3 class="news-card__title">{{ item.title }}</h3>
        <p class="news-card__excerpt">{{ item.excerpt }}</p>
        <span class="news-card__more">
            Читать
            <VIcon name="arrow-right" size="small" />
        </span>
    </RouterLink>
</template>

<script setup>
import { RouterLink } from 'vue-router'
import VIcon from '@/shared/components/ui/VIcon.vue'
import { formatDate } from '@/shared/utils/date'

defineProps({
    item: { type: Object, required: true },
})
</script>

<style scoped>
.news-card {
    display: flex;
    flex-direction: column;
    background: var(--color-white);
    border: 1px solid rgba(0, 0, 0, 0.06);
    border-radius: var(--radius);
    padding: 24px;
    height: 100%;
    text-decoration: none;
    transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
}

.news-card:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-lg);
    border-color: rgba(45, 147, 89, 0.35);
}

.news-card:active { transform: translateY(-1px) scale(0.995); }

.news-card__meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 14px;
}

.news-card__category {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: var(--color-primary);
}

.news-card__date {
    font-size: 12.5px;
    color: var(--color-gray);
    white-space: nowrap;
}

.news-card__title {
    font-size: 17px;
    font-weight: 700;
    line-height: 1.35;
    color: var(--color-text);
    margin: 0 0 10px;
}

.news-card__excerpt {
    font-size: 14.5px;
    line-height: 1.6;
    color: rgba(26, 26, 26, 0.6);
    margin: 0 0 16px;
    flex: 1;
}

.news-card__more {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-size: 12.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: var(--color-primary);
}

@media (max-width: 680px) {
    .news-card { padding: 20px; }
    .news-card__title { font-size: 16px; }
}
</style>
