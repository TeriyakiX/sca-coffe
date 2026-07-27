<template>
    <section class="flow">
        <div v-reveal class="container">
            <VSectionHead
                tag="Система квалификаций"
                :title="block.title"
                :subtitle="block.subtitle"
                center
                light
            />
            <div v-reveal.stagger class="flow__grid">
                <div v-for="step in items" :key="step.num" class="flow__step">
                    <span class="flow__num">{{ step.num }}</span>
                    <h3 class="flow__title">{{ step.title }}</h3>
                    <p class="flow__text">{{ step.text }}</p>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup>
import { computed } from 'vue'
import VSectionHead from '@/shared/components/ui/VSectionHead.vue'

const props = defineProps({
    block: { type: Object, default: () => ({ title: '', subtitle: '', items: [] }) },
})

const items = computed(() => props.block.items ?? [])
</script>
<style scoped>
.flow {
    padding: 88px 0;
    background: var(--color-secondary-dark);
}

.flow__grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
}

.flow__step {
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: var(--radius);
    padding: 26px;
}

.flow__num {
    display: inline-block;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 1px;
    color: var(--color-primary-light);
    margin-bottom: 12px;
}

.flow__title {
    font-size: 17px;
    font-weight: 700;
    color: #fff;
    margin: 0 0 8px;
    line-height: 1.3;
}

.flow__text {
    font-size: 14.5px;
    line-height: 1.6;
    color: rgba(255, 255, 255, 0.7);
    margin: 0;
}

@media (max-width: 900px) {
    .flow__grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 680px) {
    .flow { padding: 48px 0; }
    .flow__grid { grid-template-columns: 1fr; gap: 12px; }
    .flow__step { padding: 18px 20px; }
    .flow__num { margin-bottom: 8px; }
    .flow__title { font-size: 16px; }
    .flow__text { font-size: 14px; }
}
</style>
