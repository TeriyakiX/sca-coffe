<template>
    <MainLayout>
        <VPageHero
            eyebrow="Профессиональные стандарты"
            :title="block('standards.hero').title"
            :subtitle="block('standards.hero').subtitle"
        >
            <template #actions>
                <RouterLink to="/membership/join" class="btn btn--primary">Принять участие в рабочей группе</RouterLink>
            </template>
        </VPageHero>

        <VContentSection alt tag="О стандартах" :title="block('standards.what').title">
            <p class="lead">{{ block('standards.what').body }}</p>

            <div class="split">
                <div class="split__col">
                    <h3 class="split__title">{{ block('standards.why').title }}</h3>
                    <VCheckList :items="titles('standards.why')" />
                </div>
                <div class="split__col">
                    <h3 class="split__title">{{ block('standards.developed').title }}</h3>
                    <VCheckList :items="titles('standards.developed')" />
                </div>
            </div>
        </VContentSection>

        <VContentSection tag="Направления" :title="block('standards.directions').title">
            <div class="chips">
                <span v-for="d in titles('standards.directions')" :key="d" class="chip">{{ d }}</span>
            </div>
        </VContentSection>

        <VContentSection alt tag="Этапы" :title="block('standards.stages').title">
            <VSteps :items="items('standards.stages')" />
        </VContentSection>

        <VContentSection id="working-groups" tag="Рабочие группы" :title="block('standards.working-groups').title">
            <div class="grid-3">
                <div v-for="g in items('standards.working-groups')" :key="g.title" class="card">
                    <span class="card__label">{{ g.label }}</span>
                    <h3 class="card__title">{{ g.title }}</h3>
                    <p class="card__text">{{ g.text }}</p>
                </div>
            </div>

            <h3 class="split__title standards-page__docs-title">{{ block('standards.documents').title }}</h3>
            <ul class="docs">
                <li v-for="d in items('standards.documents')" :key="d.title" class="docs__item">
                    <VIcon name="document" size="small" />
                    <span class="docs__title">{{ d.title }}</span>
                    <span class="docs__status">{{ d.status }}</span>
                </li>
            </ul>

            <div class="btn-group standards-page__cta">
                <RouterLink to="/membership/join" class="btn btn--primary">Подать заявку на участие</RouterLink>
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

const { block, items } = useContentBlocks('standards')

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

.split__title {
    font-size: 16px;
    font-weight: 700;
    color: var(--color-text);
    margin: 0 0 18px;
    padding-bottom: 14px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.08);
}

.standards-page__docs-title { margin-top: 34px; }
.standards-page__cta { margin-top: 26px; }

@media (max-width: 900px) {
    .split { grid-template-columns: 1fr; gap: 14px; }
}

@media (max-width: 680px) {
    .split { margin-top: 24px; }
    .split__col { padding: 20px; }
    .split__title { font-size: 15.5px; margin-bottom: 14px; padding-bottom: 12px; }
}
</style>
