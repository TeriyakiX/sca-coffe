<template>
    <section class="membership">
        <div v-reveal class="container">
            <VSectionHead
                tag="Членство"
                :title="hero.title"
                :subtitle="hero.subtitle"
            />
            <div class="membership__audience">
                <span class="membership__audience-label">Для кого</span>
                <div class="chips">
                    <span v-for="a in audienceItems" :key="a" class="chip">{{ a }}</span>
                </div>
            </div>
            <div v-reveal.stagger class="membership__grid">
                <div v-for="b in benefitItems" :key="b.title" class="benefit">
                    <div class="benefit__icon"><VIcon :name="b.icon || 'check'" size="medium" /></div>
                    <h3 class="benefit__title">{{ b.title }}</h3>
                    <p class="benefit__text">{{ b.text }}</p>
                </div>
            </div>
            <div class="btn-group btn-group--center membership__cta">
                <RouterLink to="/membership/join" class="btn btn--primary">
                    Стать членом Ассоциации
                </RouterLink>
                <RouterLink to="/membership" class="btn btn--outline">
                    Условия и категории членства
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
    hero: { type: Object, default: () => ({ title: '', subtitle: '' }) },
    audience: { type: Object, default: () => ({ items: [] }) },
    benefits: { type: Object, default: () => ({ items: [] }) },
})

const audienceItems = computed(() => (props.audience.items ?? []).map((i) => i.title))
const benefitItems = computed(() => (props.benefits.items ?? []).slice(0, 4))
</script>
<style scoped>
.membership {
    padding: 88px 0;
    background: var(--color-bg);
}

.membership__audience {
    margin-bottom: 36px;
}

.membership__audience-label {
    display: block;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.4px;
    color: var(--color-secondary);
    margin-bottom: 14px;
}

.membership__grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
}

.benefit {
    background: var(--color-white);
    border: 1px solid rgba(0, 0, 0, 0.06);
    border-radius: var(--radius);
    padding: 24px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.benefit:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-lg);
}

.benefit__icon {
    width: 46px;
    height: 46px;
    border-radius: 12px;
    background: rgba(45, 147, 89, 0.1);
    color: var(--color-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 16px;
}

.benefit__title {
    font-size: 16px;
    font-weight: 700;
    color: var(--color-text);
    margin: 0 0 8px;
    line-height: 1.3;
}

.benefit__text {
    font-size: 14px;
    line-height: 1.55;
    color: rgba(26, 26, 26, 0.6);
    margin: 0;
}

.membership__cta {
    display: flex;
    gap: 14px;
    flex-wrap: wrap;
    justify-content: center;
    margin-top: 40px;
}

@media (max-width: 1024px) {
    .membership__grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 680px) {
    .membership { padding: 48px 0; }
    .membership__audience { margin-bottom: 26px; }
    .membership__grid { grid-template-columns: 1fr; gap: 12px; }
    .benefit { padding: 18px 20px; display: flex; align-items: flex-start; gap: 14px; flex-wrap: wrap; }
    .benefit__icon { width: 40px; height: 40px; border-radius: 10px; margin-bottom: 0; }
    .benefit__title { flex: 1; margin: 0; align-self: center; }
    .benefit__text { flex: 1 1 100%; font-size: 13.5px; }
    .membership__cta { flex-direction: column; align-items: stretch; margin-top: 28px; }
}
</style>
