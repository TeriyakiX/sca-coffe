<template>
    <section class="standards">
        <div class="container standards__inner">
            <div v-reveal class="standards__left">
                <VSectionHead
                    tag="Главная стратегическая задача"
                    title="Профессиональные стандарты для кофейной и чайной индустрии"
                />
                <p class="standards__intro">
                    Профессиональный стандарт описывает, какие функции выполняет специалист, что он должен знать
                    и уметь, как может развиваться в профессии и по каким критериям оценивается его квалификация.
                </p>
                <p class="standards__intro">
                    Сейчас Ассоциация формирует рабочие группы и разрабатывает проекты стандартов
                    по кофейному, чайному и образовательному направлениям.
                </p>
                <h3 class="standards__label">{{ developed.title }}</h3>
                <VCheckList :items="developedItems" />
                <div class="btn-group standards__actions">
                    <RouterLink to="/standards" class="btn btn--primary">
                        Посмотреть направления разработки
                    </RouterLink>
                    <RouterLink to="/standards/working-group" class="btn btn--outline">
                        Подать заявку в рабочую группу
                    </RouterLink>
                </div>
            </div>
            <aside v-reveal="{ delay: 120 }" class="standards__right">
                <h3 class="standards__aside-title">{{ directions.title }}</h3>
                <div class="chips">
                    <span v-for="d in directionItems" :key="d" class="chip">{{ d }}</span>
                </div>
            </aside>
        </div>
    </section>
</template>
<script setup>
import { computed } from 'vue'
import { RouterLink } from 'vue-router'
import VSectionHead from '@/shared/components/ui/VSectionHead.vue'
import VCheckList from '@/shared/components/ui/VCheckList.vue'

const props = defineProps({
    hero: { type: Object, default: () => ({ subtitle: '' }) },
    developed: { type: Object, default: () => ({ title: '', items: [] }) },
    directions: { type: Object, default: () => ({ title: '', items: [] }) },
})

const developedItems = computed(() => (props.developed.items ?? []).map((i) => i.title))
const directionItems = computed(() => (props.directions.items ?? []).map((i) => i.title))
</script>
<style scoped>
.standards__intro {
    font-size: 15.5px;
    line-height: 1.7;
    color: rgba(26, 26, 26, 0.7);
    margin: 0 0 14px;
    max-width: 620px;
}

.standards {
    padding: 88px 0;
    background: var(--color-white);
}

.standards__inner {
    display: grid;
    grid-template-columns: 1.35fr 1fr;
    gap: 48px;
    align-items: start;
}

.standards__label {
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    color: var(--color-secondary);
    margin: 0 0 16px;
}

.standards :deep(.check-list) { margin-bottom: 32px; }

.standards__actions {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.standards__right {
    background: var(--color-bg);
    border: 1px solid rgba(0, 0, 0, 0.06);
    border-radius: var(--radius);
    padding: 28px;
    position: sticky;
    top: 100px;
}

.standards__aside-title {
    font-size: 16px;
    font-weight: 700;
    color: var(--color-text);
    margin: 0 0 18px;
}

@media (max-width: 900px) {
    .standards__inner { grid-template-columns: 1fr; gap: 28px; }
    .standards__right { position: static; }
}

@media (max-width: 680px) {
    .standards { padding: 48px 0; }
    .standards :deep(.check-list) { margin-bottom: 24px; }
    .standards__right { padding: 22px; }
    .standards__actions { flex-direction: column; align-items: stretch; }
}
</style>
