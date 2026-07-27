<template>
    <section class="directions">
        <div v-reveal class="container">
            <VSectionHead
                tag="Направления работы"
                :title="block.title"
                :subtitle="block.subtitle"
            />
            <div v-reveal.stagger class="directions__grid">
                <RouterLink
                    v-for="item in items"
                    :key="item.title"
                    :to="item.to || '/'"
                    class="direction"
                >
                    <div class="direction__icon">
                        <VIcon :name="item.icon || 'document'" size="medium" />
                    </div>
                    <h3 class="direction__title">{{ item.title }}</h3>
                    <p class="direction__text">{{ item.text }}</p>
                    <span class="direction__link">
                        Подробнее
                        <VIcon name="arrow-right" size="small" />
                    </span>
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
    block: { type: Object, default: () => ({ title: '', subtitle: '', items: [] }) },
})

const items = computed(() => props.block.items ?? [])
</script>
<style scoped>
.directions {
    padding: 88px 0;
    background: var(--color-bg);
}

.directions__grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

.direction {
    display: flex;
    flex-direction: column;
    background: var(--color-white);
    border: 1px solid rgba(0, 0, 0, 0.06);
    border-radius: var(--radius);
    padding: 28px;
    text-decoration: none;
    transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease;
}

.direction:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
    border-color: rgba(45, 147, 89, 0.35);
}

.direction__icon {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    background: rgba(45, 147, 89, 0.1);
    color: var(--color-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
}

.direction__title {
    font-size: 19px;
    font-weight: 700;
    line-height: 1.3;
    color: var(--color-text);
    margin: 0 0 10px;
}

.direction__text {
    font-size: 15px;
    line-height: 1.6;
    color: rgba(26, 26, 26, 0.62);
    margin: 0 0 20px;
    flex: 1;
}

.direction__link {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: var(--color-primary);
}

.direction:active { transform: translateY(-1px) scale(0.995); }

@media (max-width: 980px) {
    .directions__grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 680px) {
    .directions { padding: 48px 0; }
    .directions__grid { grid-template-columns: 1fr; gap: 14px; }
    .direction { padding: 20px; }
    .direction__icon { width: 44px; height: 44px; border-radius: 12px; margin-bottom: 14px; }
    .direction__title { font-size: 17px; }
    .direction__text { font-size: 14.5px; margin-bottom: 14px; }
}
</style>
