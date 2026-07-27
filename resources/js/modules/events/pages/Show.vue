<template>
    <MainLayout>
        <VPageHero
            :eyebrow="item.type_label || 'Мероприятие'"
            :title="item.title || 'Загрузка…'"
        >
            <template #actions>
                <a v-if="item.registration_url" :href="item.registration_url" target="_blank" rel="noopener" class="btn btn--primary">
                    Зарегистрироваться
                </a>
                <RouterLink to="/news" class="btn btn--outline">Все мероприятия</RouterLink>
            </template>
        </VPageHero>

        <VContentSection alt>
            <dl class="event-meta">
                <div class="event-meta__row">
                    <dt>Дата</dt>
                    <dd>{{ formatDate(item.starts_at) }}<template v-if="item.ends_at"> — {{ formatDate(item.ends_at) }}</template></dd>
                </div>
                <div v-if="item.place" class="event-meta__row">
                    <dt>Место</dt>
                    <dd>{{ item.place }}</dd>
                </div>
                <div v-if="item.type_label" class="event-meta__row">
                    <dt>Формат</dt>
                    <dd>{{ item.type_label }}</dd>
                </div>
            </dl>

            <p v-if="item.description" class="lead event-show__text">{{ item.description }}</p>
            <p v-else-if="!loading" class="status-note">Программа мероприятия готовится.</p>

            <div class="btn-group event-show__nav">
                <RouterLink to="/news" class="btn btn--outline">Вернуться к событиям</RouterLink>
                <RouterLink to="/contacts" class="btn btn--primary">Задать вопрос</RouterLink>
            </div>
        </VContentSection>
    </MainLayout>
</template>

<script setup>
import { onMounted, ref, watch } from 'vue'
import { RouterLink, useRoute } from 'vue-router'
import MainLayout from '@/app/layouts/MainLayout.vue'
import VPageHero from '@/shared/components/ui/VPageHero.vue'
import VContentSection from '@/shared/components/ui/VContentSection.vue'
import { fetchEventItem } from '@/shared/api/catalog'
import { formatDate } from '@/shared/utils/date'

const route = useRoute()
const item = ref({})
const loading = ref(true)

const load = async (slug) => {
    loading.value = true

    try {
        item.value = await fetchEventItem(slug)
    } catch (e) {
        item.value = { title: 'Мероприятие не найдено' }
    } finally {
        loading.value = false
    }
}

onMounted(() => load(route.params.slug))
watch(() => route.params.slug, load)
</script>

<style scoped>
.event-meta {
    display: grid;
    gap: 10px;
    margin: 0 0 28px;
    max-width: 620px;
}

.event-meta__row {
    display: flex;
    align-items: baseline;
    gap: 16px;
    padding: 14px 18px;
    background: var(--color-bg);
    border: 1px solid rgba(0, 0, 0, 0.06);
    border-radius: var(--radius-sm);
}

.event-meta__row dt {
    flex: 0 0 110px;
    font-size: 11.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.1px;
    color: var(--color-gray);
}

.event-meta__row dd {
    margin: 0;
    font-size: 15.5px;
    font-weight: 600;
    color: var(--color-text);
}

.event-show__text { margin-bottom: 0; }
.event-show__nav { margin-top: 34px; }

@media (max-width: 680px) {
    .event-meta__row { flex-direction: column; gap: 4px; padding: 13px 16px; }
    .event-meta__row dt { flex: none; }
    .event-meta__row dd { font-size: 15px; }
    .event-show__nav { margin-top: 26px; }
}
</style>
