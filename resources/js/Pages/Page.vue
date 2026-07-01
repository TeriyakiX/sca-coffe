<template>
    <MainLayout>
        <div class="page">
            <div v-if="loading" class="page__loading">Загрузка...</div>

            <template v-else>
                <!-- Шапка страницы -->
                <div class="page__hero">
                    <div class="container">
                        <nav class="page__breadcrumbs">
                            <a href="/" class="page__bc-link">Главная</a>
                            <span class="page__bc-sep">/</span>
                            <a href="/info" class="page__bc-link">Сведения об образовательной организации</a>
                            <span class="page__bc-sep">/</span>
                            <span class="page__bc-current">{{ page.title }}</span>
                        </nav>
                        <h1 class="page__title">{{ page.title }}</h1>
                    </div>
                </div>

                <!-- Контент -->
                <div class="container">
                    <div class="page__content" v-html="page.content"></div>
                    <button class="page__back" @click="goBack">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 12H5M12 19l-7-7 7-7"/>
                        </svg>
                        Назад
                    </button>
                </div>
            </template>
        </div>
    </MainLayout>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue'
import { useRoute } from 'vue-router'
import MainLayout from '@/app/layouts/MainLayout.vue'

const route = useRoute()
const loading = ref(true)
const page = ref({ title: '', content: '' })

const fetchPage = async (slug) => {
    loading.value = true
    try {
        const res = await fetch(`/api/pages/${slug}`)
        const data = await res.json()
        page.value = data
    } catch (e) {
        page.value = { title: 'Страница не найдена', content: '<p>Информация отсутствует.</p>' }
    } finally {
        loading.value = false
    }
}

onMounted(() => fetchPage(route.params.slug))
watch(() => route.params.slug, fetchPage)

const goBack = () => window.history.back()
</script>

<style scoped>
/* ============================================
   ОБЁРТКА
   ============================================ */
.page {
    padding-bottom: 64px;
    background: var(--color-bg);
}

/* ============================================
   HERO — в стиле ассоциации
   ============================================ */
.page__hero {
    background: linear-gradient(135deg, #2D9359 0%, #1F6B3F 50%, #693C26 100%);
    padding: 90px 0 48px;
    margin-bottom: 40px;
    position: relative;
    overflow: hidden;
}

.page__hero::before {
    position: absolute;
    right: 40px;
    bottom: -40px;
    font-size: 160px;
    opacity: 0.08;
    pointer-events: none;
}

.page__hero::after {
    content: '';
    position: absolute;
    right: -60px;
    bottom: -80px;
    width: 380px;
    height: 380px;
    border-radius: 50%;
    background: rgba(255,255,255,0.04);
    pointer-events: none;
}

/* ============================================
   ХЛЕБНЫЕ КРОШКИ
   ============================================ */
.page__breadcrumbs {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    margin-bottom: 14px;
    flex-wrap: wrap;
}

.page__bc-link {
    color: rgba(255,255,255,0.75);
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s;
}

.page__bc-link:hover {
    color: #fff;
}

.page__bc-sep {
    color: rgba(255,255,255,0.4);
    font-size: 12px;
}

.page__bc-current {
    color: rgba(255,255,255,0.85);
}

/* ============================================
   ЗАГОЛОВОК
   ============================================ */
.page__title {
    font-size: 34px;
    font-weight: 800;
    color: #fff;
    margin: 0;
    line-height: 1.2;
    letter-spacing: -0.3px;
}

/* ============================================
   КОНТЕНТ-КАРТОЧКА
   ============================================ */
.page__content {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 1px 8px rgba(0,0,0,0.07);
    padding: 40px 44px;
    font-size: 15px;
    line-height: 1.75;
    color: var(--color-text);
    overflow: hidden;
}

.page__content :deep(p) {
    margin: 0 0 14px;
}

.page__content :deep(p:last-child) {
    margin-bottom: 0;
}

.page__content :deep(strong) {
    font-weight: 700;
    color: var(--color-text);
}

.page__content :deep(a) {
    color: var(--color-primary);
    text-decoration: underline;
    text-decoration-color: transparent;
    font-weight: 500;
    transition: text-decoration-color 0.2s;
}

.page__content :deep(a:hover) {
    text-decoration-color: var(--color-primary);
}

.page__content :deep(ul) {
    list-style: none;
    padding: 0;
    margin: 14px 0 0;
}

.page__content :deep(ul li) {
    position: relative;
    padding: 8px 0 8px 24px;
    border-top: 1px solid rgba(0,0,0,0.05);
    line-height: 1.55;
}

.page__content :deep(ul li:last-child) {
    padding-bottom: 0;
}

.page__content :deep(ul li::before) {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--color-primary);
}

.page__content :deep(h2) {
    font-size: 24px;
    font-weight: 700;
    margin: 28px 0 12px;
    color: var(--color-text);
    padding-bottom: 8px;
    border-bottom: 2px solid var(--color-primary);
}

.page__content :deep(h3) {
    font-size: 19px;
    font-weight: 700;
    margin: 22px 0 10px;
    color: var(--color-text);
}

.page__content :deep(table) {
    width: 100%;
    border-collapse: collapse;
    margin: 16px 0;
    font-size: 14px;
}

.page__content :deep(table th) {
    background: var(--color-primary);
    color: #fff;
    padding: 12px 16px;
    text-align: left;
    font-weight: 600;
    font-size: 13px;
}

.page__content :deep(table td) {
    padding: 11px 16px;
    border-bottom: 1px solid var(--color-gray-light);
    font-size: 13px;
}

.page__content :deep(table tr:nth-child(even) td) {
    background: var(--color-bg);
}

.page__content :deep(table tr:last-child td) {
    border-bottom: none;
}

/* ============================================
   КНОПКА НАЗАД
   ============================================ */
.page__back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-top: 24px;
    padding: 12px 28px;
    background: #fff;
    color: var(--color-text);
    border: 2px solid var(--color-gray-light);
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    font-family: var(--font-family);
    cursor: pointer;
    text-decoration: none;
    transition: all 0.25s ease;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}

.page__back:hover {
    color: var(--color-primary);
    border-color: var(--color-primary);
    transform: translateX(-4px);
    box-shadow: 0 4px 16px rgba(45,147,89,0.15);
}

.page__back svg {
    flex-shrink: 0;
    transition: transform 0.25s ease;
}

.page__back:hover svg {
    transform: translateX(-3px);
}

/* ============================================
   АДАПТИВ — как у Клода, но в наших цветах
   ============================================ */
@media (max-width: 768px) {
    .page__hero {
        padding: 32px 0 36px;
        margin-bottom: 28px;
    }

    .page__title {
        font-size: 26px;
    }

    .page__breadcrumbs {
        font-size: 12px;
        gap: 6px;
        margin-bottom: 10px;
    }

    .page__content {
        padding: 24px 20px;
        font-size: 14px;
        border-radius: 10px;
    }

    .page__content :deep(table) {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }

    .page__content :deep(table th),
    .page__content :deep(table td) {
        padding: 8px 12px;
        font-size: 12px;
    }

    .page__content :deep(ul li) {
        padding: 7px 0 7px 20px;
    }

    .page__content :deep(ul li::before) {
        width: 6px;
        height: 6px;
    }

    .page__content :deep(h2) {
        font-size: 20px;
    }

    .page__back {
        width: 100%;
        justify-content: center;
        padding: 12px 20px;
        font-size: 14px;
        margin-top: 20px;
    }
}

@media (max-width: 480px) {
    .page {
        padding-bottom: 40px;
    }

    .page__hero {
        padding: 70px 0 28px;
        margin-bottom: 20px;
    }

    .page__title {
        font-size: 21px;
    }

    .page__breadcrumbs {
        font-size: 11px;
        gap: 4px;
        margin-bottom: 8px;
    }

    .page__bc-sep {
        font-size: 10px;
    }

    .page__content {
        padding: 18px 16px;
        font-size: 13px;
        border-radius: 8px;
    }

    .page__content :deep(ul li) {
        padding: 6px 0 6px 18px;
    }

    .page__content :deep(ul li::before) {
        width: 5px;
        height: 5px;
    }

    .page__content :deep(h2) {
        font-size: 18px;
    }

    .page__content :deep(h3) {
        font-size: 16px;
    }

    .page__back {
        font-size: 13px;
        padding: 10px 16px;
        margin-top: 16px;
        border-width: 1.5px;
    }
}
</style>
