<template>
    <MainLayout>
        <VPageHero
            eyebrow="Реестры"
            :title="block('registries.hero').title"
            :subtitle="block('registries.hero').subtitle"
        />

        <VContentSection alt tag="Реестры" :title="block('registries.list').title">
            <p class="lead">{{ block('registries.list').body }}</p>

            <div class="grid-3 registries__grid">
                <div v-for="r in items('registries.list')" :key="r.title" class="card registries__card">
                    <div class="registries__icon"><VIcon name="list" size="medium" /></div>
                    <h3 class="card__title">{{ r.title }}</h3>
                    <p class="card__text">{{ r.text }}</p>
                    <span class="registries__status">{{ r.status }}</span>
                </div>
            </div>
        </VContentSection>

        <VContentSection tag="Поиск" :title="block('registries.filters').title">
            <div class="chips">
                <span v-for="f in titles('registries.filters')" :key="f" class="chip">{{ f }}</span>
            </div>

            <!-- «Попасть в реестр специалистов» убрано до запуска процедуры оценки:
                 членство и включение в реестр — разные действия (помета документа) -->
            <div class="registries__actions">
                <RouterLink to="/standards/working-group" class="btn btn--primary">Подать заявку в рабочую группу</RouterLink>
                <RouterLink to="/accreditation/apply" class="btn btn--outline">Подать предварительную заявку от учебного центра</RouterLink>
            </div>
        </VContentSection>
    </MainLayout>
</template>

<script setup>
import { RouterLink } from 'vue-router'
import MainLayout from '@/app/layouts/MainLayout.vue'
import VPageHero from '@/shared/components/ui/VPageHero.vue'
import VContentSection from '@/shared/components/ui/VContentSection.vue'
import VIcon from '@/shared/components/ui/VIcon.vue'
import { useContentBlocks } from '@/shared/composables/useContentBlocks'

const { block, items } = useContentBlocks('registries')

const titles = (key) => items(key).map((i) => i.title)
</script>

<style scoped>
.registries__grid { margin-top: 28px; }

.registries__card { display: flex; flex-direction: column; }

.registries__icon {
    width: 46px;
    height: 46px;
    border-radius: 12px;
    background: rgba(105, 60, 38, 0.1);
    color: var(--color-secondary);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 16px;
}

.registries__status {
    align-self: flex-start;
    margin-top: 16px;
    font-size: 12.5px;
    color: var(--color-gray);
    background: var(--color-gray-light);
    padding: 6px 13px;
    border-radius: 50px;
}

.registries__actions {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    margin-top: 28px;
}

@media (max-width: 680px) {
    .registries__icon { width: 40px; height: 40px; margin-bottom: 12px; }
    .registries__actions { flex-direction: column; align-items: stretch; }
}
</style>
