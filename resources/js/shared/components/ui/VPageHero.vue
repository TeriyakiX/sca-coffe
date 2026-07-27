<template>
    <section class="page-hero">
        <div class="container page-hero__inner">
            <span v-if="eyebrow" class="page-hero__eyebrow">{{ eyebrow }}</span>
            <h1 class="page-hero__title">{{ title }}</h1>
            <p v-if="subtitle" class="page-hero__subtitle">{{ subtitle }}</p>
            <div v-if="$slots.actions" class="page-hero__actions">
                <slot name="actions" />
            </div>
        </div>
    </section>
</template>
<script setup>
defineProps({
    eyebrow: { type: String, default: '' },
    title: { type: String, required: true },
    subtitle: { type: String, default: '' }
})
</script>
<style scoped>
.page-hero {
    position: relative;
    background: linear-gradient(180deg, #FFEDCD 0%, var(--color-bg) 100%);
    padding: 148px 0 62px;
    border-bottom: 1px solid rgba(105, 60, 38, 0.1);
    overflow: hidden;
}

.page-hero::after {
    content: '';
    position: absolute;
    top: -160px;
    right: -120px;
    width: 460px;
    height: 460px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(45, 147, 89, 0.1) 0%, transparent 70%);
    pointer-events: none;
}

.page-hero__inner {
    position: relative;
    z-index: 1;
}

.page-hero__eyebrow {
    display: inline-block;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2.4px;
    color: var(--color-secondary);
    opacity: 0.8;
    margin-bottom: 16px;
}

.page-hero__title {
    max-width: 900px;
    font-size: clamp(26px, 5.4vw, 44px);
    font-weight: 700;
    line-height: 1.15;
    letter-spacing: -1.2px;
    color: var(--color-text);
    margin: 0 0 18px;
    text-wrap: balance;
}

.page-hero__subtitle {
    max-width: 780px;
    font-size: clamp(15.5px, 1.8vw, 18px);
    line-height: 1.65;
    color: rgba(26, 26, 26, 0.65);
    margin: 0;
}

.page-hero__actions {
    display: flex;
    flex-wrap: wrap;
    gap: 14px;
    margin-top: 32px;
}

@media (max-width: 768px) {
    .page-hero { padding: 116px 0 42px; }
    .page-hero__eyebrow { font-size: 10.5px; letter-spacing: 1.8px; margin-bottom: 12px; }
    .page-hero__title { letter-spacing: -0.5px; }
    .page-hero__actions { margin-top: 26px; gap: 10px; }
}

@media (max-width: 680px) {
    .page-hero__actions { flex-direction: column; align-items: stretch; }
}
</style>
