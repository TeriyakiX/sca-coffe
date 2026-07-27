<template>
    <MainLayout>
        <VPageHero
            eyebrow="Новости и события"
            title="Новости индустрии"
            subtitle="Новости кофейной и чайной индустрии России и мира, регулирование, профессиональные стандарты, обучение, мероприятия, исследования и экспертные материалы."
        />
        <VContentSection alt>
            <div class="news-page__filters">
                <button
                    v-for="cat in categories"
                    :key="cat.slug"
                    class="news-page__filter"
                    :class="{ 'is-active': active === cat.slug }"
                    @click="select(cat.slug)"
                >
                    {{ cat.label }}
                </button>
            </div>
            <div v-if="items.length" v-reveal.stagger class="grid-3">
                <VNewsCard v-for="item in items" :key="item.id" :item="item" />
            </div>
            <p v-else-if="!loading" class="status-note">Материалов в этой категории пока нет.</p>
        </VContentSection>
        <VContentSection tag="Мероприятия" title="Ближайшие события">
            <ul v-if="events.length" class="events">
                <li v-for="e in events" :key="e.id">
                    <RouterLink :to="`/events/${e.slug}`" class="events__item">
                        <time class="events__date" :datetime="e.starts_at">{{ formatDate(e.starts_at) }}</time>
                        <div class="events__body">
                            <h3 class="events__title">{{ e.title }}</h3>
                            <span class="events__meta">{{ e.type_label }}<template v-if="e.place"> · {{ e.place }}</template></span>
                        </div>
                        <VIcon name="arrow-right" size="small" class="events__arrow" />
                    </RouterLink>
                </li>
            </ul>
            <p v-else class="status-note">Ближайшие мероприятия будут опубликованы.</p>
        </VContentSection>
    </MainLayout>
</template>
<script setup>
import { onMounted, ref } from 'vue'
import { RouterLink } from 'vue-router'
import MainLayout from '@/app/layouts/MainLayout.vue'
import VPageHero from '@/shared/components/ui/VPageHero.vue'
import VContentSection from '@/shared/components/ui/VContentSection.vue'
import VIcon from '@/shared/components/ui/VIcon.vue'
import VNewsCard from '../components/VNewsCard.vue'
import { fetchEvents, fetchNews } from '@/shared/api/catalog'
import { formatDate } from '@/shared/utils/date'

const categories = [
    { slug: 'all', label: 'Все материалы' },
    { slug: 'association', label: 'Новости Ассоциации' },
    { slug: 'standards', label: 'Профессиональные стандарты' },
    { slug: 'education', label: 'Образование и аккредитация' },
    { slug: 'coffee-ru', label: 'Кофейная индустрия России' },
    { slug: 'tea-ru', label: 'Чайная индустрия России' },
    { slug: 'international', label: 'Международные новости' },
    { slug: 'events', label: 'Мероприятия и чемпионаты' },
    { slug: 'interviews', label: 'Интервью и экспертные материалы' },
    { slug: 'regulation', label: 'Регулирование и документы' },
]

const active = ref('all')
const items = ref([])
const events = ref([])
const loading = ref(true)

const load = async () => {
    loading.value = true

    try {
        const params = active.value === 'all' ? {} : { category: active.value }
        const payload = await fetchNews({ ...params, per_page: 24 })

        items.value = payload?.data ?? []
    } catch (e) {
        items.value = []
    } finally {
        loading.value = false
    }
}

const select = (slug) => {
    active.value = slug
    load()
}

onMounted(async () => {
    await load()

    try {
        const payload = await fetchEvents({ upcoming: 1, per_page: 10 })

        events.value = payload?.data ?? []
    } catch (e) {
        events.value = []
    }
})
</script>
<style scoped>
.news-page__filters {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 28px;
}

.news-page__filter {
    padding: 9px 16px;
    border-radius: 50px;
    background: var(--color-white);
    border: 1px solid rgba(0, 0, 0, 0.1);
    font-family: var(--font-family);
    font-size: 13.5px;
    font-weight: 600;
    color: var(--color-text);
    cursor: pointer;
    transition: all 0.18s ease;
}

.news-page__filter:hover { border-color: var(--color-primary); color: var(--color-primary); }

.news-page__filter.is-active {
    background: var(--color-primary);
    border-color: var(--color-primary);
    color: #fff;
}

.events { list-style: none; margin: 0; padding: 0; display: grid; gap: 12px; }

.events__item {
    display: flex;
    align-items: center;
    gap: 24px;
    padding: 20px 24px;
    background: var(--color-white);
    border: 1px solid rgba(0, 0, 0, 0.06);
    border-radius: var(--radius-sm);
    text-decoration: none;
    transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
}

.events__item:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
    border-color: rgba(45, 147, 89, 0.35);
}

.events__body { flex: 1; min-width: 0; }

.events__arrow {
    color: var(--color-gray);
    flex-shrink: 0;
    transition: transform 0.2s ease, color 0.2s ease;
}

.events__item:hover .events__arrow {
    color: var(--color-primary);
    transform: translateX(3px);
}

.events__date {
    font-size: 13.5px;
    font-weight: 700;
    color: var(--color-primary);
    white-space: nowrap;
    min-width: 150px;
}

.events__title {
    font-size: 16.5px;
    font-weight: 700;
    line-height: 1.35;
    color: var(--color-text);
    margin: 0 0 4px;
}

.events__item:hover .events__title { color: var(--color-primary); }

.events__meta { font-size: 13.5px; color: var(--color-gray); }

@media (max-width: 680px) {
    .news-page__filters {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
        scroll-snap-type: x proximity;
        margin: 0 -16px 22px;
        padding: 0 16px 6px;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
    }

    .news-page__filters::-webkit-scrollbar { display: none; }

    .news-page__filter {
        flex: 0 0 auto;
        scroll-snap-align: start;
        font-size: 13px;
        padding: 9px 14px;
    }

    .events__item { flex-direction: column; align-items: flex-start; gap: 8px; padding: 16px 18px; }
    .events__date { min-width: 0; }
    .events__title { font-size: 15.5px; }
}
</style>
