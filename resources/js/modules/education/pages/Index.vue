<template>
    <MainLayout>
        <VPageHero
            eyebrow="Обучение и квалификации"
            :title="block('education.hero').title"
            :subtitle="block('education.hero').subtitle"
        >
            <template #actions>
                <RouterLink to="/accreditation/apply" class="btn btn--primary">Подать предварительную заявку от учебного центра</RouterLink>
                <RouterLink to="/standards" class="btn btn--outline">Профессиональные стандарты</RouterLink>
            </template>
        </VPageHero>

        <VContentSection alt tag="Система" :title="block('education.system').title">
            <p class="lead">{{ block('education.system').body }}</p>
            <VSteps :items="items('education.system')" class="education__steps" />
        </VContentSection>

        <VContentSection tag="Направления" :title="block('education.directions').title">
            <div class="chips">
                <span v-for="d in titles('education.directions')" :key="d" class="chip">{{ d }}</span>
            </div>
        </VContentSection>

        <VContentSection alt tag="Тренеры" :title="block('education.trainers').title">
            <p class="lead">{{ block('education.trainers').body }}</p>
            <VCheckList :items="titles('education.trainers')" columns class="education__list" />
        </VContentSection>

        <VContentSection tag="Документы" :title="block('education.documents').title">
            <ul class="docs">
                <li v-for="d in items('education.documents')" :key="d.title" class="docs__item">
                    <VIcon name="document" size="small" />
                    <span class="docs__title">{{ d.title }}</span>
                    <span class="docs__status">{{ d.status }}</span>
                </li>
            </ul>
            <p class="education__note">{{ block('education.documents').body }}</p>
        </VContentSection>

        <VContentSection alt tag="Обучение" :title="block('education.where').title">
            <p class="lead">{{ block('education.where').body }}</p>
            <div class="education__actions">
                <RouterLink to="/registries" class="btn btn--primary">Смотреть реестры</RouterLink>
                <RouterLink to="/membership/join" class="btn btn--outline">Вступить в ассоциацию</RouterLink>
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

const { block, items } = useContentBlocks('education')

const titles = (key) => items(key).map((i) => i.title)
</script>

<style scoped>
.education__steps { margin-top: 28px; }
.education__list { margin-top: 22px; }
.education__note { margin: 18px 0 0; font-size: 14.5px; color: var(--color-gray); }

.education__actions {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    margin-top: 26px;
}

@media (max-width: 680px) {
    .education__actions { flex-direction: column; align-items: stretch; }
}
</style>
