<template>
    <section class="news">
        <div v-reveal class="container">
            <div class="news__head">
                <VSectionHead
                    tag="Новости и события"
                    title="Новости отрасли и работа Ассоциации"
                    subtitle="Проекты профессиональных стандартов, образование и аккредитация, регулирование, рынок кофе и чая, мероприятия, исследования и международные практики."
                />
                <RouterLink to="/news" class="news__all">
                    Все материалы
                    <VIcon name="arrow-right" size="small" />
                </RouterLink>
            </div>
            <div v-if="items.length" v-reveal.stagger class="news__grid">
                <VNewsCard v-for="item in items" :key="item.id" :item="item" />
            </div>
            <p v-else-if="!loading" class="status-note">Материалы скоро появятся.</p>
        </div>
    </section>
</template>
<script setup>
import { onMounted, ref } from 'vue'
import { RouterLink } from 'vue-router'
import VSectionHead from '@/shared/components/ui/VSectionHead.vue'
import VIcon from '@/shared/components/ui/VIcon.vue'
import VNewsCard from './VNewsCard.vue'
import { fetchNews } from '@/shared/api/catalog'

const items = ref([])
const loading = ref(true)

onMounted(async () => {
    try {
        const payload = await fetchNews({ per_page: 3 })

        items.value = payload?.data ?? []
    } catch (e) {
        items.value = []
    } finally {
        loading.value = false
    }
})
</script>
<style scoped>
.news {
    padding: 88px 0;
    background: var(--color-bg);
}

.news__head {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 24px;
}

.news__all {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: var(--color-primary);
    text-decoration: none;
    white-space: nowrap;
    padding-top: 34px;
}

.news__grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

@media (max-width: 900px) {
    .news__grid { grid-template-columns: repeat(2, 1fr); }
    .news__head { flex-direction: column; gap: 0; }
    .news__all { padding-top: 0; margin-bottom: 24px; }
}

@media (max-width: 680px) {
    .news { padding: 48px 0; }
    .news__grid { grid-template-columns: 1fr; gap: 12px; }
    .news__all { margin-bottom: 20px; font-size: 12.5px; }
}
</style>
