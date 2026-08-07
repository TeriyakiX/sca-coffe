<template>
    <MainLayout>
        <VPageHero eyebrow="Сведения об организации" :title="page.title || 'Загрузка…'">
            <template #actions>
                <RouterLink to="/info" class="btn btn--outline">Все разделы сведений</RouterLink>
            </template>
        </VPageHero>

        <VContentSection alt>
            <article v-if="!loading" v-internal-links class="page-content" v-html="page.content"></article>
            <p v-else class="status-note">Загружаем страницу…</p>

            <div class="btn-group page-nav">
                <RouterLink to="/info" class="btn btn--outline">Вернуться к списку</RouterLink>
                <RouterLink to="/contacts" class="btn btn--primary">Задать вопрос</RouterLink>
            </div>
        </VContentSection>
    </MainLayout>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue'
import { RouterLink, useRoute } from 'vue-router'
import MainLayout from '@/app/layouts/MainLayout.vue'
import VPageHero from '@/shared/components/ui/VPageHero.vue'
import VContentSection from '@/shared/components/ui/VContentSection.vue'
import { fetchPage } from '@/shared/api/content'

const route = useRoute()
const loading = ref(true)
const page = ref({ title: '', content: '' })

const load = async (slug) => {
    loading.value = true

    try {
        page.value = await fetchPage(slug)
    } catch (e) {
        page.value = { title: 'Страница не найдена', content: '<p>Информация отсутствует.</p>' }
    } finally {
        loading.value = false
    }

    // У маршрута страницы нет своего meta.title — берём его из загруженных данных
    if (page.value?.title) {
        document.title = `${page.value.title} — Ассоциация специалистов кофейной и чайной индустрии`
    }
}

onMounted(() => load(route.params.slug))
watch(() => route.params.slug, load)
</script>

<style scoped>
.page-nav { margin-top: 34px; }

@media (max-width: 680px) {
    .page-nav { margin-top: 26px; }
}
</style>
