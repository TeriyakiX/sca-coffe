<template>
    <section class="hero">
        <div class="hero__bg-circle hero__bg-circle--1" aria-hidden="true"></div>
        <div class="hero__bg-circle hero__bg-circle--2" aria-hidden="true"></div>
        <div class="container hero__inner">
            <div class="hero__content">
                <span class="hero__eyebrow">Профессиональная инфраструктура отрасли</span>
                <h1 class="hero__title">{{ block.title }}</h1>
                <p class="hero__subtitle">{{ block.subtitle }}</p>
                <div class="btn-group hero__actions">
                    <RouterLink to="/membership/join" class="btn btn--lg btn--primary">
                        Вступить в ассоциацию
                    </RouterLink>
                    <RouterLink to="/standards" class="btn btn--lg btn--outline">
                        Узнать о профстандартах
                    </RouterLink>
                </div>
            </div>
            <div v-if="pillars.length" v-reveal.stagger="{ delay: 120 }" class="hero__pillars">
                <div v-for="p in pillars" :key="p.title" class="hero__pillar">{{ p.title }}</div>
            </div>
        </div>
    </section>
</template>
<script setup>
import { computed } from 'vue'
import { RouterLink } from 'vue-router'

const props = defineProps({
    block: { type: Object, default: () => ({ title: '', subtitle: '', body: '', items: [] }) },
})

const pillars = computed(() => props.block.items ?? [])
</script>
<style scoped>
.hero {
    background: linear-gradient(180deg, #FBF7F0 0%, var(--color-bg) 100%);
    position: relative;
    overflow: hidden;
    padding: 168px 0 76px;
}

.hero__bg-circle {
    position: absolute;
    border-radius: 50%;
    pointer-events: none;
}

.hero__bg-circle--1 {
    width: 600px;
    height: 600px;
    top: -220px;
    right: -160px;
    background: radial-gradient(circle, rgba(45, 147, 89, 0.1) 0%, transparent 70%);
}

.hero__bg-circle--2 {
    width: 420px;
    height: 420px;
    bottom: -140px;
    left: -120px;
    background: radial-gradient(circle, rgba(105, 60, 38, 0.08) 0%, transparent 70%);
}

.hero__inner {
    position: relative;
    z-index: 1;
}

.hero__content {
    max-width: 880px;
}

.hero__eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 22px;
    padding: 8px 16px;
    border-radius: 50px;
    background: rgba(45, 147, 89, 0.1);
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.4px;
    color: var(--color-primary-dark);
}

.hero__title {
    font-size: clamp(28px, 5.6vw, 54px);
    font-weight: 700;
    line-height: 1.12;
    letter-spacing: -1.6px;
    color: #333;
    margin: 0 0 22px;
    text-wrap: balance;
}

.hero__subtitle {
    font-size: clamp(15.5px, 2vw, 19px);
    line-height: 1.65;
    color: rgba(51, 51, 51, 0.68);
    max-width: 720px;
    margin: 0 0 36px;
}

.hero__actions {
    display: flex;
    gap: 14px;
    flex-wrap: wrap;
}

.hero__pillars {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
    margin-top: 56px;
    padding-top: 34px;
    border-top: 1px solid rgba(105, 60, 38, 0.15);
}

.hero__pillar {
    font-size: 14px;
    font-weight: 600;
    color: #333;
    padding-left: 14px;
    border-left: 3px solid var(--color-primary);
    line-height: 1.4;
}

@media (max-width: 900px) {
    .hero__pillars { grid-template-columns: repeat(2, 1fr); gap: 18px; }
}

@media (max-width: 768px) {
    .hero { padding: 118px 0 48px; }
    .hero__eyebrow { font-size: 11px; padding: 7px 14px; margin-bottom: 18px; }
    .hero__title { letter-spacing: -0.6px; margin-bottom: 16px; }
    .hero__subtitle { margin-bottom: 28px; }
    .hero__bg-circle--1 { width: 380px; height: 380px; top: -150px; right: -120px; }
    .hero__bg-circle--2 { display: none; }
}

@media (max-width: 560px) {
    .hero__actions { flex-direction: column; align-items: stretch; }
    .hero__pillars {
        grid-template-columns: 1fr;
        gap: 12px;
        margin-top: 36px;
        padding-top: 24px;
    }
    .hero__pillar { font-size: 13.5px; }
    }
</style>
