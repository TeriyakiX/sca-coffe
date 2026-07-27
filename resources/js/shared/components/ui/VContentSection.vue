<template>
    <section :id="id" class="content-section" :class="{ 'content-section--alt': alt }">
        <div v-reveal class="container">
            <VSectionHead v-if="title" :tag="tag" :title="title" :subtitle="subtitle" />
            <slot />
        </div>
    </section>
</template>
<script setup>
import VSectionHead from './VSectionHead.vue'

defineProps({
    id: { type: String, default: undefined },
    tag: { type: String, default: '' },
    title: { type: String, default: '' },
    subtitle: { type: String, default: '' },
    alt: { type: Boolean, default: false }
})
</script>
<style scoped>
.content-section {
    padding: 72px 0;
    background: var(--color-bg);
    scroll-margin-top: 90px;
}

.content-section--alt {
    background: var(--color-white);
}

@media (max-width: 680px) {
    .content-section { padding: 38px 0; }
}
</style>
