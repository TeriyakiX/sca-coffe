<template>
    <AdminLayout title="Обзор">
        <div class="grid-4">
            <RouterLink v-for="card in cards" :key="card.to" :to="card.to" class="card dashboard__card">
                <span class="card__label">{{ card.label }}</span>
                <h3 class="dashboard__value">{{ counts[card.key] ?? '—' }}</h3>
                <p class="card__text">{{ card.hint }}</p>
            </RouterLink>
        </div>
    </AdminLayout>
</template>
<script setup>
import { onMounted, reactive } from 'vue'
import { RouterLink } from 'vue-router'
import AdminLayout from '../components/AdminLayout.vue'
import { adminAccreditation, adminContact, adminMembership, adminNews } from '@/shared/api/admin'

const counts = reactive({})

const cards = [
    { key: 'membership', to: '/admin/membership', label: 'Заявки на вступление', hint: 'Новые обращения о членстве' },
    { key: 'accreditation', to: '/admin/accreditation', label: 'Заявки на аккредитацию', hint: 'Учебные центры и тренеры' },
    { key: 'contacts', to: '/admin/contacts', label: 'Обращения', hint: 'Сообщения через форму контактов' },
    { key: 'news', to: '/admin/news', label: 'Новости', hint: 'Опубликованные материалы' },
]

const total = (payload) => (Array.isArray(payload) ? payload.length : payload?.meta?.total ?? payload?.data?.length ?? 0)

onMounted(async () => {
    const sources = {
        membership: adminMembership,
        accreditation: adminAccreditation,
        contacts: adminContact,
        news: adminNews,
    }

    await Promise.all(
        Object.entries(sources).map(async ([key, api]) => {
            try {
                counts[key] = total(await api.list({ per_page: 1 }))
            } catch (e) {
                counts[key] = '—'
            }
        }),
    )
})
</script>
<style scoped>
.dashboard__card {
    display: block;
    background: var(--color-white);
    text-decoration: none;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.dashboard__card:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-lg);
}

.dashboard__value {
    font-size: 32px;
    font-weight: 700;
    margin: 0 0 6px;
    color: var(--color-text);
}
</style>
