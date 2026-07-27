<template>
    <ul class="check-list" :class="{ 'check-list--cols': columns }">
        <li v-for="item in items" :key="item" class="check-list__item">
            <VIcon name="check" size="small" />
            <span>{{ item }}</span>
        </li>
    </ul>
</template>
<script setup>
import VIcon from './VIcon.vue'

defineProps({
    items: { type: Array, required: true },
    columns: { type: Boolean, default: false }
})
</script>
<style scoped>
.check-list {
    list-style: none;
    display: grid;
    gap: 12px;
    margin: 0;
    padding: 0;
}

.check-list--cols {
    grid-template-columns: repeat(2, 1fr);
    gap: 12px 32px;
}

.check-list__item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 15.5px;
    line-height: 1.55;
    color: var(--color-text);
}

.check-list__item :deep(.icon) {
    color: var(--color-primary);
    margin-top: 3px;
}

@media (max-width: 700px) {
    .check-list--cols { grid-template-columns: 1fr; }
    .check-list { gap: 10px; }
    .check-list__item { font-size: 14.5px; }
}
</style>
