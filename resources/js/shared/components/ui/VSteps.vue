<template>
    <ol class="steps">
        <li v-for="step in items" :key="step.num || step.title" class="steps__item">
            <span class="steps__num">{{ step.num || step.stage }}</span>
            <div>
                <h3 class="steps__title">{{ step.title }}</h3>
                <p class="steps__text">{{ step.text }}</p>
            </div>
        </li>
    </ol>
</template>
<script setup>
defineProps({
    items: { type: Array, required: true }
})
</script>
<style scoped>
.steps {
    list-style: none;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
    margin: 0;
    padding: 0;
}

.steps__item {
    display: flex;
    gap: 14px;
    background: var(--color-white);
    border: 1px solid rgba(0, 0, 0, 0.06);
    border-radius: var(--radius);
    padding: 22px;
}

.steps__num {
    font-size: 13px;
    font-weight: 700;
    color: var(--color-primary);
    letter-spacing: 0.6px;
    flex-shrink: 0;
    padding-top: 2px;
}

.steps__title {
    font-size: 16.5px;
    font-weight: 700;
    color: var(--color-text);
    margin: 0 0 6px;
    line-height: 1.3;
}

.steps__text {
    font-size: 14.5px;
    line-height: 1.55;
    color: rgba(26, 26, 26, 0.6);
    margin: 0;
}

@media (max-width: 900px) {
    .steps { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 680px) {
    .steps { grid-template-columns: 1fr; gap: 10px; }
    .steps__item { padding: 16px 18px; gap: 12px; }
    .steps__title { font-size: 15.5px; margin-bottom: 4px; }
    .steps__text { font-size: 14px; }
}
</style>
