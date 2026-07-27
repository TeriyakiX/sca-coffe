<template>
    <section class="why">
        <div v-reveal class="container">
            <VSectionHead
                tag="Зачем отрасли Ассоциация"
                :title="block.title"
                :subtitle="block.subtitle"
            />
            <div v-if="rows.length" class="why__table">
                <div class="why__head why__head--now">Сейчас на рынке</div>
                <div class="why__head why__head--next">Что формирует Ассоциация</div>
                <template v-for="(row, i) in rows" :key="i">
                    <div class="why__cell why__cell--now">{{ row.now }}</div>
                    <div class="why__cell why__cell--next">
                        <VIcon name="check" size="small" class="why__check" />
                        {{ row.next }}
                    </div>
                </template>
            </div>
        </div>
    </section>
</template>
<script setup>
import { computed } from 'vue'
import VSectionHead from '@/shared/components/ui/VSectionHead.vue'
import VIcon from '@/shared/components/ui/VIcon.vue'

const props = defineProps({
    block: { type: Object, default: () => ({ title: '', subtitle: '', items: [] }) },
})

const rows = computed(() => props.block.items ?? [])
</script>
<style scoped>
.why {
    padding: 88px 0;
    background: var(--color-white);
}

.why__table {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    align-items: stretch;
}

.why__head {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.4px;
    padding: 12px 20px;
    border-radius: var(--radius-sm);
}

.why__head--now {
    color: var(--color-gray);
    background: var(--color-gray-light);
}

.why__head--next {
    color: #fff;
    background: var(--color-primary);
}

.why__cell {
    font-size: 15.5px;
    line-height: 1.5;
    padding: 18px 20px;
    border-radius: var(--radius-sm);
    display: flex;
    align-items: center;
    gap: 10px;
}

.why__cell--now {
    color: var(--color-gray);
    background: var(--color-bg);
    text-decoration: line-through;
    text-decoration-color: rgba(107, 114, 128, 0.4);
}

.why__cell--next {
    color: var(--color-text);
    font-weight: 600;
    background: rgba(45, 147, 89, 0.08);
}

.why__check {
    color: var(--color-primary);
    flex-shrink: 0;
}

@media (max-width: 680px) {
    .why { padding: 48px 0; }

    .why__table {
        grid-template-columns: 1fr;
        gap: 0;
        border: 1px solid rgba(0, 0, 0, 0.07);
        border-radius: var(--radius);
        overflow: hidden;
        background: var(--color-white);
    }

    .why__head { display: none; }

    .why__cell {
        font-size: 14.5px;
        padding: 13px 16px;
        border-radius: 0;
        gap: 8px;
    }

    .why__cell--now {
        padding-bottom: 4px;
        background: transparent;
        font-size: 13px;
    }

    .why__cell--next {
        background: transparent;
        border-bottom: 1px solid rgba(0, 0, 0, 0.06);
        padding-top: 4px;
        padding-bottom: 16px;
    }

    .why__table > :last-child { border-bottom: none; }
}
</style>
