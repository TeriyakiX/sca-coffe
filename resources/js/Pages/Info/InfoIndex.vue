<template>
    <MainLayout>
        <VPageHero
            eyebrow="Сведения об организации"
            title="Сведения об образовательной организации"
            subtitle="Обязательные сведения о деятельности Ассоциации: документы, руководство, образование, материально-техническое обеспечение и условия обучения."
        />

        <VContentSection alt>
            <div v-if="items.length" v-reveal.stagger class="info-list">
                <RouterLink
                    v-for="(item, i) in items"
                    :key="item.slug"
                    :to="`/page/${item.slug}`"
                    class="info-list__item"
                >
                    <span class="info-list__num">{{ String(i + 1).padStart(2, '0') }}</span>
                    <span class="info-list__title">{{ item.title }}</span>
                    <VIcon name="arrow-right" size="small" class="info-list__arrow" />
                </RouterLink>
            </div>
            <p v-else class="status-note">Разделы загружаются…</p>
        </VContentSection>
    </MainLayout>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { RouterLink } from 'vue-router'
import MainLayout from '@/app/layouts/MainLayout.vue'
import VPageHero from '@/shared/components/ui/VPageHero.vue'
import VContentSection from '@/shared/components/ui/VContentSection.vue'
import VIcon from '@/shared/components/ui/VIcon.vue'
import { fetchPages } from '@/shared/api/content'

const items = ref([])

onMounted(async () => {
    try {
        items.value = await fetchPages()
    } catch (e) {
        items.value = []
    }
})
</script>

<style scoped>
.info-list {
    display: grid;
    gap: 10px;
}

.info-list__item {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 18px 22px;
    background: var(--color-white);
    border: 1px solid rgba(0, 0, 0, 0.06);
    border-radius: var(--radius);
    text-decoration: none;
    transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
}

.info-list__item:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
    border-color: rgba(45, 147, 89, 0.35);
}

.info-list__num {
    font-size: 13px;
    font-weight: 700;
    color: var(--color-primary);
    letter-spacing: 0.6px;
    flex-shrink: 0;
}

.info-list__title {
    flex: 1;
    font-size: 16px;
    font-weight: 600;
    line-height: 1.4;
    color: var(--color-text);
}

.info-list__arrow {
    color: var(--color-gray);
    flex-shrink: 0;
    transition: transform 0.2s ease, color 0.2s ease;
}

.info-list__item:hover .info-list__arrow {
    color: var(--color-primary);
    transform: translateX(3px);
}

@media (max-width: 680px) {
    .info-list__item { padding: 15px 16px; gap: 12px; }
    .info-list__title { font-size: 15px; }
    .info-list__num { font-size: 12px; }
}
</style>
