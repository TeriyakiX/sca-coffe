<template>
    <MainLayout>
        <VPageHero eyebrow="Партнёры" :title="block('partners.hero').title" :subtitle="block('partners.hero').subtitle">
            <template #actions>
                <RouterLink to="/contacts" class="btn btn--primary">Стать партнёром</RouterLink>
                <RouterLink to="/membership/join" class="btn btn--outline">Вступить в ассоциацию</RouterLink>
            </template>
        </VPageHero>
        <VContentSection alt tag="Кто может стать партнёром" :title="block('partners.audience').title">
            <div class="chips">
                <span v-for="a in items('partners.audience')" :key="a.title" class="chip">{{ a.title }}</span>
            </div>
        </VContentSection>
        <VContentSection tag="Форматы" :title="block('partners.benefits').title">
            <p class="partners-page__lead">{{ block('partners.benefits').subtitle }}</p>
            <div class="grid-3">
                <div v-for="b in items('partners.benefits')" :key="b.title" class="card">
                    <h3 class="card__title">{{ b.title }}</h3>
                    <p class="card__text">{{ b.text }}</p>
                </div>
            </div>
        </VContentSection>
        <VContentSection alt tag="Что получает партнёр" :title="block('partners.gains').title">
            <VCheckList :items="items('partners.gains').map((g) => g.title)" columns />
        </VContentSection>
        <!-- Раздел 5.1 правок: пустой блок партнёров не показываем,
             появится сам, когда будут подтверждённые компании -->
        <VContentSection v-if="partners.length" tag="Партнёры" title="Партнёры Ассоциации">
            <div class="grid-3">
                <div v-for="p in partners" :key="p.id" class="card">
                    <span class="card__label">{{ p.category_label }}</span>
                    <h3 class="card__title">{{ p.name }}</h3>
                    <p class="card__text">{{ p.description }}</p>
                    <p v-if="p.benefit" class="card__text partners-page__benefit">{{ p.benefit }}</p>
                    <a v-if="p.site_url" :href="p.site_url" target="_blank" rel="noopener" class="partners-page__link">
                        Перейти на сайт
                    </a>
                </div>
            </div>
        </VContentSection>
        <VContentSection alt tag="Партнёрство" :title="block('partners.become-steps').title">
            <VSteps :items="items('partners.become-steps')" />
            <RouterLink to="/contacts" class="btn btn--primary partners-page__cta">
                Отправить запрос на партнёрство
            </RouterLink>
        </VContentSection>
    </MainLayout>
</template>
<script setup>
import { onMounted, ref } from 'vue'
import { RouterLink } from 'vue-router'
import MainLayout from '@/app/layouts/MainLayout.vue'
import VPageHero from '@/shared/components/ui/VPageHero.vue'
import VContentSection from '@/shared/components/ui/VContentSection.vue'
import VSteps from '@/shared/components/ui/VSteps.vue'
import VCheckList from '@/shared/components/ui/VCheckList.vue'
import { useContentBlocks } from '@/shared/composables/useContentBlocks'
import { fetchPartners } from '@/shared/api/catalog'

const { block, items } = useContentBlocks('partners')

const partners = ref([])

onMounted(async () => {
    try {
        partners.value = await fetchPartners()
    } catch (e) {
        partners.value = []
    }
})
</script>
<style scoped>
.partners-page__lead {
    margin: 0 0 24px;
    font-size: 16px;
    line-height: 1.65;
    color: var(--color-gray);
    max-width: 820px;
}

.partners-page__benefit { margin-top: 8px; color: var(--color-primary); font-weight: 600; }
.partners-page__link { display: inline-block; margin-top: 12px; font-size: 13.5px; font-weight: 700; color: var(--color-primary); text-decoration: none; }
.partners-page__cta { margin-top: 26px; }
</style>
