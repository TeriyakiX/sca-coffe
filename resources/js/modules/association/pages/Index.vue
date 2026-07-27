<template>
    <MainLayout>
        <VPageHero eyebrow="Ассоциация" :title="block('association.hero').title" :subtitle="block('association.hero').subtitle">
            <template #actions>
                <RouterLink to="/membership/join" class="btn btn--primary">Вступить в ассоциацию</RouterLink>
                <RouterLink to="/standards" class="btn btn--outline">Узнать о профстандартах</RouterLink>
            </template>
        </VPageHero>

        <VContentSection alt tag="Миссия и цели" :title="block('association.mission').title">
            <p class="lead">{{ block('association.mission').body }}</p>

            <div class="split">
                <div class="split__col">
                    <h3 class="split__title">{{ block('association.goals').title }}</h3>
                    <VCheckList :items="titles('association.goals')" />
                </div>
                <div class="split__col">
                    <h3 class="split__title">{{ block('association.audience').title }}</h3>
                    <div class="chips">
                        <span v-for="a in titles('association.audience')" :key="a" class="chip">{{ a }}</span>
                    </div>
                </div>
            </div>
        </VContentSection>

        <VContentSection tag="Задачи" :title="block('association.tasks').title">
            <div class="grid-3">
                <div v-for="t in items('association.tasks')" :key="t.title" class="card">
                    <h3 class="card__title">{{ t.title }}</h3>
                    <p class="card__text">{{ t.text }}</p>
                </div>
            </div>
        </VContentSection>

        <VContentSection alt tag="Дорожная карта" :title="block('association.roadmap').title">
            <VSteps :items="items('association.roadmap')" />
        </VContentSection>

        <VContentSection tag="Команда и документы" :title="block('association.team').title">
            <div class="grid-2">
                <div v-for="m in items('association.team')" :key="m.label" class="card">
                    <span class="card__label">{{ m.label }}</span>
                    <h3 class="card__title">{{ m.title }}</h3>
                    <p class="card__text">{{ m.text }}</p>
                </div>
            </div>

            <h3 class="split__title association__docs-title">{{ block('association.documents').title }}</h3>
            <ul class="docs">
                <li v-for="d in items('association.documents')" :key="d.title" class="docs__item">
                    <VIcon name="document" size="small" />
                    <span class="docs__title">{{ d.title }}</span>
                    <span class="docs__status">{{ d.status }}</span>
                </li>
            </ul>
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

const { block, items } = useContentBlocks('association')

const titles = (key) => items(key).map((i) => i.title)
</script>

<style scoped>
.split {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 20px;
    margin-top: 32px;
}

.split__col {
    background: var(--color-bg);
    border: 1px solid rgba(0, 0, 0, 0.06);
    border-radius: var(--radius);
    padding: 26px 28px;
}

.content-section--alt .split__col { background: var(--color-bg); }

.split__title {
    font-size: 16px;
    font-weight: 700;
    color: var(--color-text);
    margin: 0 0 18px;
    padding-bottom: 14px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.08);
}

.association__docs-title { margin-top: 34px; }

@media (max-width: 900px) {
    .split { grid-template-columns: 1fr; gap: 14px; }
}

@media (max-width: 680px) {
    .split { margin-top: 24px; }
    .split__col { padding: 20px; }
    .split__title { font-size: 15.5px; margin-bottom: 14px; padding-bottom: 12px; }
}
</style>
