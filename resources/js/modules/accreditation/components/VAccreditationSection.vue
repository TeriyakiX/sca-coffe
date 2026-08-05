<template>
    <section class="accreditation">
        <div class="container accreditation__inner">
            <div v-reveal>
                <VSectionHead
                    tag="Аккредитация"
                    title="Аккредитация учебных центров"
                    :subtitle="hero.subtitle"
                />
                <div class="btn-group accreditation__actions">
                    <RouterLink to="/accreditation/apply" class="btn btn--primary">
                        Подать предварительную заявку
                    </RouterLink>
                    <RouterLink to="/accreditation" class="btn btn--outline">
                        Требования и этапы
                    </RouterLink>
                </div>
            </div>
            <div v-reveal="{ delay: 120 }" class="accreditation__card">
                <h3 class="accreditation__card-title">{{ scope.title }}</h3>
                <VCheckList :items="scopeItems" />
            </div>
        </div>
    </section>
</template>
<script setup>
import { computed } from 'vue'
import { RouterLink } from 'vue-router'
import VSectionHead from '@/shared/components/ui/VSectionHead.vue'
import VCheckList from '@/shared/components/ui/VCheckList.vue'

const props = defineProps({
    hero: { type: Object, default: () => ({ subtitle: '' }) },
    scope: { type: Object, default: () => ({ title: '', items: [] }) },
})

const scopeItems = computed(() => (props.scope.items ?? []).map((i) => i.title))
</script>
<style scoped>
.accreditation {
    padding: 88px 0;
    background: var(--color-white);
}

.accreditation__inner {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 48px;
    align-items: center;
}

.accreditation__actions {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.accreditation__card {
    background: var(--color-bg);
    border: 1px solid rgba(0, 0, 0, 0.06);
    border-radius: var(--radius);
    padding: 32px;
}

.accreditation__card-title {
    font-size: 17px;
    font-weight: 700;
    color: var(--color-text);
    margin: 0 0 18px;
}

@media (max-width: 900px) {
    .accreditation__inner { grid-template-columns: 1fr; gap: 28px; }
}

@media (max-width: 680px) {
    .accreditation { padding: 48px 0; }
    .accreditation__actions { flex-direction: column; align-items: stretch; }
    .accreditation__card { padding: 22px; }
}
</style>
