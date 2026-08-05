<template>
    <MainLayout>
        <VPageHero eyebrow="Членство" :title="block('membership.hero').title" :subtitle="block('membership.hero').subtitle">
            <template #actions>
                <RouterLink to="/membership/join" class="btn btn--primary">Вступить в ассоциацию</RouterLink>
                <RouterLink to="/partners" class="btn btn--outline">Бонусы партнёров</RouterLink>
            </template>
        </VPageHero>
        <VContentSection alt tag="Для кого" :title="block('membership.audience').title">
            <div class="chips">
                <span v-for="a in titles('membership.audience')" :key="a" class="chip">{{ a }}</span>
            </div>
        </VContentSection>
        <VContentSection tag="Преимущества" :title="block('membership.benefits').title">
            <div class="grid-4">
                <div v-for="b in items('membership.benefits')" :key="b.title" class="card">
                    <div class="member-icon"><VIcon :name="b.icon || 'check'" size="medium" /></div>
                    <h3 class="card__title">{{ b.title }}</h3>
                    <p class="card__text">{{ b.text }}</p>
                </div>
            </div>
            <!-- Будущие возможности отделены от действующих: обещать их
                 как уже доступные нельзя (правило статусов документа) -->
            <div v-if="items('membership.upcoming').length" class="membership__upcoming">
                <h3 class="membership__upcoming-title">{{ block('membership.upcoming').title }}</h3>
                <VCheckList :items="titles('membership.upcoming')" />
            </div>
        </VContentSection>
        <VContentSection alt tag="Категории" :title="block('membership.tiers').title">
            <div class="grid-4">
                <div
                    v-for="t in items('membership.tiers')"
                    :key="t.title"
                    class="card tier"
                    :class="{ 'tier--featured': t.featured }"
                >
                    <h3 class="card__title">{{ t.title }}</h3>
                    <p class="tier__for">{{ t.text }}</p>
                    <VCheckList :items="t.features ?? []" />
                    <RouterLink to="/membership/join" class="btn btn--sm btn--primary tier__btn">
                        Подать заявку
                    </RouterLink>
                </div>
            </div>
        </VContentSection>
        <VContentSection tag="Условия" :title="block('membership.join-steps').title">
            <VSteps :items="items('membership.join-steps')" />
            <p class="tier__note">{{ block('membership.join-steps').body }}</p>
        </VContentSection>
        <VContentSection alt tag="FAQ" :title="block('membership.faq').title">
            <div class="faq">
                <details v-for="f in items('membership.faq')" :key="f.title" class="faq__item">
                    <summary class="faq__q">{{ f.title }}</summary>
                    <p class="faq__a">{{ f.text }}</p>
                </details>
            </div>
        </VContentSection>
    </MainLayout>
</template>
<script setup>
import { RouterLink } from 'vue-router'
import MainLayout from '@/app/layouts/MainLayout.vue'
import VPageHero from '@/shared/components/ui/VPageHero.vue'
import VContentSection from '@/shared/components/ui/VContentSection.vue'
import VCheckList from '@/shared/components/ui/VCheckList.vue'
import VSteps from '@/shared/components/ui/VSteps.vue'
import VIcon from '@/shared/components/ui/VIcon.vue'
import { useContentBlocks } from '@/shared/composables/useContentBlocks'

const { block, items } = useContentBlocks('membership')

const titles = (key) => items(key).map((i) => i.title)
</script>
<style scoped>
.member-icon {
    width: 46px;
    height: 46px;
    border-radius: 12px;
    background: rgba(45, 147, 89, 0.1);
    color: var(--color-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 16px;
}

.tier { display: flex; flex-direction: column; }

.tier--featured {
    border-color: var(--color-primary);
    box-shadow: 0 10px 30px rgba(45, 147, 89, 0.12);
}

.tier__for {
    font-size: 13.5px;
    line-height: 1.5;
    color: var(--color-gray);
    margin: 0 0 16px;
}

.tier :deep(.check-list) { flex: 1; margin-bottom: 20px; }
.tier :deep(.check-list__item) { font-size: 14px; }

.tier__btn { width: 100%; }

.tier__note {
    margin: 24px 0 0;
    font-size: 14.5px;
    color: var(--color-gray);
}

.membership__upcoming {
    margin-top: 32px;
    padding: 24px;
    background: var(--color-bg);
    border: 1px dashed rgba(0, 0, 0, 0.14);
    border-radius: var(--radius);
}

.membership__upcoming-title {
    font-size: 16px;
    font-weight: 700;
    margin: 0 0 14px;
}

.faq { display: grid; gap: 10px; }

.faq__item {
    background: var(--color-white);
    border: 1px solid rgba(0, 0, 0, 0.06);
    border-radius: var(--radius-sm);
    padding: 18px 20px;
}

.faq__q {
    font-size: 16px;
    font-weight: 700;
    color: var(--color-text);
    cursor: pointer;
    list-style: none;
}

.faq__q::-webkit-details-marker { display: none; }

.faq__q::after {
    content: '+';
    float: right;
    color: var(--color-primary);
    font-size: 20px;
    line-height: 1;
}

.faq__item[open] .faq__q::after { content: '−'; }

.faq__a {
    margin: 12px 0 0;
    font-size: 15px;
    line-height: 1.65;
    color: rgba(26, 26, 26, 0.65);
}
</style>
