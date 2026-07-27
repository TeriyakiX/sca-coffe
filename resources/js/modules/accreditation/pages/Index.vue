<template>
    <MainLayout>
        <VPageHero eyebrow="Аккредитация" :title="block('accreditation.hero').title" :subtitle="block('accreditation.hero').subtitle">
            <template #actions>
                <RouterLink to="/accreditation/apply" class="btn btn--primary">Подать заявку на аккредитацию</RouterLink>
                <RouterLink to="/standards" class="btn btn--outline">Профессиональные стандарты</RouterLink>
            </template>
        </VPageHero>

        <VContentSection alt tag="Требования" title="Что проверяет Ассоциация">
            <div class="facts">
                <div v-for="group in requirementGroups" :key="group.key" class="facts__item">
                    <h3 class="facts__title">{{ block(group.key).title }}</h3>
                    <VCheckList :items="titles(group.key)" />
                </div>
            </div>
        </VContentSection>

        <VContentSection tag="Этапы" :title="block('accreditation.stages').title">
            <VSteps :items="items('accreditation.stages')" />
        </VContentSection>

        <VContentSection alt tag="Документы" :title="block('accreditation.documents').title">
            <ul class="docs">
                <li v-for="d in items('accreditation.documents')" :key="d.title" class="docs__item">
                    <VIcon name="document" size="small" />
                    <span class="docs__title">{{ d.title }}</span>
                    <span class="docs__status">{{ d.status }}</span>
                </li>
            </ul>
            <p class="acc-page__note">{{ block('accreditation.documents').body }}</p>

            <div class="btn-group acc-page__cta">
                <RouterLink to="/accreditation/apply" class="btn btn--primary">Подать заявку</RouterLink>
                <RouterLink to="/education" class="btn btn--outline">Обучение и квалификации</RouterLink>
            </div>
        </VContentSection>
    </MainLayout>
</template>

<script setup>
import { RouterLink } from 'vue-router'
import MainLayout from '@/app/layouts/MainLayout.vue'
import VPageHero from '@/shared/components/ui/VPageHero.vue'
import VContentSection from '@/shared/components/ui/VContentSection.vue'
import VCheckList from '@/shared/components/ui/VCheckList.vue'
import VSteps from '@/shared/components/ui/VSteps.vue'
import VIcon from '@/shared/components/ui/VIcon.vue'
import { useContentBlocks } from '@/shared/composables/useContentBlocks'

const { block, items } = useContentBlocks('accreditation')

const requirementGroups = [
    { key: 'accreditation.scope' },
    { key: 'accreditation.center-requirements' },
    { key: 'accreditation.trainer-requirements' },
]

const titles = (key) => items(key).map((i) => i.title)
</script>

<style scoped>
.facts {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 28px;
}

.facts__title {
    font-size: 17px;
    font-weight: 700;
    color: var(--color-text);
    margin: 0 0 16px;
    padding-bottom: 12px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.08);
}

.acc-page__note { margin: 18px 0 0; font-size: 14.5px; color: var(--color-gray); }
.acc-page__cta { margin-top: 22px; }

@media (max-width: 900px) {
    .facts { grid-template-columns: 1fr; gap: 22px; }
}

@media (max-width: 680px) {
    .facts__title { font-size: 15.5px; margin-bottom: 12px; padding-bottom: 10px; }
}
</style>
