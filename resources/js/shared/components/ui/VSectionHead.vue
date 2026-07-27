<template>
    <div class="section-head" :class="{ 'section-head--center': center, 'section-head--light': light }">
        <span v-if="tag" class="section-head__tag">{{ tag }}</span>
        <h2 class="section-head__title">{{ title }}</h2>
        <p v-if="subtitle" class="section-head__subtitle">{{ subtitle }}</p>
    </div>
</template>
<script setup>
defineProps({
    tag: { type: String, default: '' },
    title: { type: String, required: true },
    subtitle: { type: String, default: '' },
    center: { type: Boolean, default: false },
    light: { type: Boolean, default: false }
})
</script>
<style scoped>
.section-head {
    margin-bottom: 44px;
}

.section-head--center {
    max-width: 760px;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
}

.section-head__tag {
    display: inline-block;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2.4px;
    color: var(--color-primary);
    margin-bottom: 14px;
}

.section-head__title {
    font-size: clamp(23px, 4.2vw, 34px);
    font-weight: 700;
    line-height: 1.2;
    letter-spacing: -0.8px;
    color: var(--color-text);
    margin: 0;
    text-wrap: balance;
}

.section-head__subtitle {
    font-size: clamp(15px, 1.6vw, 17px);
    line-height: 1.65;
    color: rgba(26, 26, 26, 0.62);
    margin: 14px 0 0;
    max-width: 780px;
}

.section-head--center .section-head__subtitle { max-width: none; }

.section-head--light .section-head__tag { color: rgba(255, 255, 255, 0.8); }
.section-head--light .section-head__title { color: #fff; }
.section-head--light .section-head__subtitle { color: rgba(255, 255, 255, 0.78); }

@media (max-width: 768px) {
    .section-head { margin-bottom: 28px; }
    .section-head__tag { font-size: 10.5px; letter-spacing: 1.8px; margin-bottom: 10px; }
    .section-head__title { letter-spacing: -0.3px; }
}
</style>
