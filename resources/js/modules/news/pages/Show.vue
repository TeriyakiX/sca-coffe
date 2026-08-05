<template>
    <MainLayout>
        <VPageHero
            :eyebrow="item.category_label || 'Новости'"
            :title="item.title || 'Загрузка…'"
            :subtitle="item.excerpt || ''"
        >
            <template #actions>
                <RouterLink to="/news" class="btn btn--outline">Все материалы</RouterLink>
            </template>
        </VPageHero>

        <VContentSection alt>
            <!-- Чек-лист документа: автор, дата публикации и дата обновления -->
            <p v-if="item.published_at || item.author" class="news-show__date">
                <span v-if="item.author">{{ item.author }}</span>
                <span v-if="item.author && item.published_at" class="news-show__sep">·</span>
                <span v-if="item.published_at">{{ formatDate(item.published_at) }}</span>
                <span v-if="showUpdated" class="news-show__updated">
                    Обновлено {{ formatDate(item.updated_at) }}
                </span>
            </p>

            <article v-if="item.content" v-internal-links class="page-content" v-html="item.content"></article>
            <p v-else-if="!loading" class="status-note">Полный текст материала готовится к публикации.</p>

            <div class="btn-group news-show__nav">
                <RouterLink to="/news" class="btn btn--outline">Вернуться к новостям</RouterLink>
                <RouterLink to="/membership/join" class="btn btn--primary">Вступить в ассоциацию</RouterLink>
            </div>
        </VContentSection>
    </MainLayout>
</template>

<script setup>
import { computed, onMounted, ref, watch } from 'vue'
import { RouterLink, useRoute } from 'vue-router'
import MainLayout from '@/app/layouts/MainLayout.vue'
import VPageHero from '@/shared/components/ui/VPageHero.vue'
import VContentSection from '@/shared/components/ui/VContentSection.vue'
import { fetchNewsItem } from '@/shared/api/catalog'
import { formatDate } from '@/shared/utils/date'

const route = useRoute()
const item = ref({})
const loading = ref(true)

// Дату обновления показываем, только если материал реально правили после публикации
const showUpdated = computed(() => {
    const { published_at: published, updated_at: updated } = item.value

    if (!published || !updated) {
        return false
    }

    return new Date(updated).getTime() - new Date(published).getTime() > 86400000
})

const load = async (slug) => {
    loading.value = true

    try {
        item.value = await fetchNewsItem(slug)
    } catch (e) {
        item.value = { title: 'Материал не найден', excerpt: 'Возможно, публикация была удалена или ещё не опубликована.' }
    } finally {
        loading.value = false
    }

    // Заголовок вкладки при переходе внутри сайта: у маршрута новости
    // своего meta.title нет, поэтому выставляем его из загруженного материала
    if (item.value?.title) {
        document.title = `${item.value.title} — Ассоциация специалистов кофейной и чайной индустрии России`
    }
}

onMounted(() => load(route.params.slug))
watch(() => route.params.slug, load)
</script>

<style scoped>
.news-show__date {
    display: flex;
    flex-wrap: wrap;
    align-items: baseline;
    gap: 8px;
    font-size: 13.5px;
    font-weight: 600;
    color: var(--color-primary);
    margin: 0 0 18px;
}

.news-show__sep { color: rgba(26, 26, 26, 0.25); }

.news-show__updated {
    font-weight: 500;
    color: var(--color-gray);
}

.news-show__nav { margin-top: 34px; }

@media (max-width: 680px) {
    .news-show__nav { margin-top: 26px; }
}
</style>
