<template>
    <section class="partners">
        <div v-reveal class="container">
            <VSectionHead
                tag="Партнёры"
                title="Партнёрская программа формируется"
                :subtitle="block.subtitle"
                center
            />
            <div v-reveal.stagger class="partners__grid">
                <div v-for="b in items" :key="b.title" class="partners__item">
                    <h3 class="partners__item-title">{{ b.title }}</h3>
                    <p class="partners__item-text">{{ b.text }}</p>
                </div>
            </div>
            <div class="partners__note">
                <span class="status-note">Раздел находится в стадии формирования</span>
                <RouterLink to="/partners" class="partners__link">
                    Стать партнёром Ассоциации
                    <VIcon name="arrow-right" size="small" />
                </RouterLink>
            </div>
        </div>
    </section>
</template>
<script setup>
import { computed } from 'vue'
import { RouterLink } from 'vue-router'
import VSectionHead from '@/shared/components/ui/VSectionHead.vue'
import VIcon from '@/shared/components/ui/VIcon.vue'

const props = defineProps({
    block: { type: Object, default: () => ({ subtitle: '', items: [] }) },
})

const items = computed(() => props.block.items ?? [])
</script>
<style scoped>
.partners {
    padding: 88px 0;
    background: var(--color-white);
}

.partners__grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
}

.partners__item {
    background: var(--color-bg);
    border: 1px solid rgba(0, 0, 0, 0.06);
    border-radius: var(--radius);
    padding: 24px;
}

.partners__item-title {
    font-size: 16px;
    font-weight: 700;
    color: var(--color-text);
    margin: 0 0 8px;
}

.partners__item-text {
    font-size: 14.5px;
    line-height: 1.55;
    color: rgba(26, 26, 26, 0.6);
    margin: 0;
}

.partners__note {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
    margin-top: 32px;
}

.partners__link {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: var(--color-primary);
    text-decoration: none;
}

@media (max-width: 1024px) {
    .partners__grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 680px) {
    .partners { padding: 48px 0; }
    .partners__grid { grid-template-columns: 1fr; gap: 12px; }
    .partners__item { padding: 18px 20px; }
    .partners__note { flex-direction: column; gap: 14px; margin-top: 26px; text-align: center; }
}
</style>
