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
            <p v-if="item.published_at" class="news-show__date">{{ formatDate(item.published_at) }}</p>

            <article v-if="item.content" class="page-content" v-html="item.content"></article>
            <p v-else-if="!loading" class="status-note">Полный текст материала готовится к публикации.</p>

            <div class="btn-group news-show__nav">
                <RouterLink to="/news" class="btn btn--outline">Вернуться к новостям</RouterLink>
                <RouterLink to="/membership/join" class="btn btn--primary">Вступить в ассоциацию</RouterLink>
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
import { fetchNewsItem } from '@/shared/api/catalog'
import { formatDate } from '@/shared/utils/date'

const route = useRoute()
const item = ref({})
const loading = ref(true)

const load = async (slug) => {
    loading.value = true

    try {
        item.value = await fetchNewsItem(slug)
    } catch (e) {
        item.value = { title: 'Материал не найден', excerpt: 'Возможно, публикация была удалена или ещё не опубликована.' }
    } finally {
        loading.value = false
    }
}

onMounted(() => load(route.params.slug))
watch(() => route.params.slug, load)
</script>

<style scoped>
.news-show__date {
    font-size: 13.5px;
    font-weight: 600;
    color: var(--color-primary);
    margin: 0 0 18px;
}

.news-show__nav { margin-top: 34px; }

@media (max-width: 680px) {
    .news-show__nav { margin-top: 26px; }
}
</style>
