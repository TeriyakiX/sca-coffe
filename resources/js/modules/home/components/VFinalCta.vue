<template>
    <section class="cta">
        <div class="container">
            <div v-reveal class="cta__inner">
                <span class="cta__tag">Присоединиться</span>
                <h2 class="cta__title">{{ block.title }}</h2>
                <p class="cta__text">{{ block.subtitle }}</p>
                <div class="btn-group btn-group--center cta__actions">
                    <RouterLink to="/membership/join" class="btn btn--lg btn--primary">
                        Вступить в ассоциацию
                    </RouterLink>
                    <RouterLink to="/accreditation/apply" class="btn btn--lg btn--outline">
                        Подать предварительную заявку
                    </RouterLink>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { RouterLink } from 'vue-router'

defineProps({
    block: { type: Object, default: () => ({ title: '', subtitle: '' }) },
})
</script>

<style scoped>
.cta {
    padding: 88px 0;
    background: var(--color-bg);
}

.cta__inner {
    position: relative;
    max-width: 900px;
    margin: 0 auto;
    padding: 56px 48px;
    text-align: center;
    background: var(--color-white);
    border: 1px solid rgba(0, 0, 0, 0.07);
    border-radius: 24px;
    box-shadow: 0 24px 60px rgba(0, 0, 0, 0.06);
    overflow: hidden;
}

.cta__inner::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--color-primary);
}

.cta__tag {
    display: inline-block;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2.4px;
    color: var(--color-primary);
    margin-bottom: 14px;
}

.cta__title {
    font-size: clamp(23px, 4.2vw, 34px);
    font-weight: 700;
    line-height: 1.2;
    letter-spacing: -0.8px;
    color: var(--color-text);
    margin: 0 0 16px;
    text-wrap: balance;
}

.cta__text {
    font-size: 16.5px;
    line-height: 1.65;
    color: rgba(26, 26, 26, 0.62);
    margin: 0 auto 32px;
    max-width: 700px;
}

.cta__actions {
    display: flex;
    gap: 14px;
    justify-content: center;
    flex-wrap: wrap;
}

@media (max-width: 768px) {
    .cta { padding: 52px 0; }
    .cta__inner { padding: 36px 24px; border-radius: 20px; }
    .cta__text { font-size: 15.5px; margin-bottom: 26px; }
}

@media (max-width: 560px) {
    .cta__inner { padding: 30px 20px; }
    .cta__actions { flex-direction: column; align-items: stretch; }
}
</style>
