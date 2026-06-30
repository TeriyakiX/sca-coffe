<template>
    <MainLayout>
        <div class="info-index">

            <!-- Шапка страницы -->
            <div class="info-index__hero">
                <div class="container">
                    <nav class="info-index__breadcrumbs">
                        <a href="/" class="info-index__bc-link">Главная</a>
                        <span class="info-index__bc-sep">•</span>
                        <span class="info-index__bc-current">Сведения об образовательной организации</span>
                    </nav>
                    <h1 class="info-index__title">Сведения об образовательной организации</h1>
                </div>
            </div>

            <!-- Список разделов -->
            <div class="container">
                <ul class="info-index__list">
                    <li
                        v-for="(item, i) in items"
                        :key="item.slug"
                        class="info-index__item"
                        :style="{ '--i': i }"
                    >
                        <a :href="`/page/${item.slug}`" class="info-index__link">
                            <span class="info-index__link-num">{{ String(i + 1).padStart(2, '0') }}</span>
                            <span class="info-index__link-text">{{ item.title }}</span>
                            <svg class="info-index__link-arrow" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14M12 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/app/layouts/MainLayout.vue'

defineProps({
    items: { type: Array, required: true }
})
</script>

<style scoped>
/* ============================================
   ОБЁРТКА
   ============================================ */
.info-index {
    padding-bottom: 64px;
    background: var(--color-bg);
    min-height: 60vh;
}

/* ============================================
   HERO — в стиле ассоциации
   ============================================ */
.info-index__hero {
    background: linear-gradient(135deg, #2D9359 0%, #1F6B3F 50%, #693C26 100%);
    padding: 92px 0 48px;
    margin-bottom: 40px;
    position: relative;
    overflow: hidden;
}

.info-index__hero::after {
    content: '';
    position: absolute;
    right: -60px;
    bottom: -80px;
    width: 380px;
    height: 380px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.04);
    pointer-events: none;
}

.info-index__hero::before {
    content: '';
    position: absolute;
    right: 40px;
    bottom: -120px;
    width: 260px;
    height: 260px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.03);
    pointer-events: none;
}

/* ============================================
   ХЛЕБНЫЕ КРОШКИ
   ============================================ */
.info-index__breadcrumbs {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    margin-bottom: 14px;
    flex-wrap: wrap;
}

.info-index__bc-link {
    color: rgba(255, 255, 255, 0.75);
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s;
}

.info-index__bc-link:hover {
    color: #fff;
}

.info-index__bc-sep {
    color: rgba(255, 255, 255, 0.4);
    font-size: 12px;
}

.info-index__bc-current {
    color: rgba(255, 255, 255, 0.85);
}

/* ============================================
   ЗАГОЛОВОК
   ============================================ */
.info-index__title {
    font-size: 34px;
    font-weight: 800;
    color: #fff;
    margin: 0;
    line-height: 1.2;
    letter-spacing: -0.3px;
}

/* ============================================
   СПИСОК РАЗДЕЛОВ
   ============================================ */
.info-index__list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 0;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 1px 8px rgba(0,0,0,0.07);
    overflow: hidden;
}

.info-index__item {
    opacity: 0;
    animation: fadeUp 0.4s ease forwards;
    animation-delay: calc(0.04s * var(--i));
}

.info-index__link {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 20px 24px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.06);
    text-decoration: none;
    color: var(--color-text);
    transition: all 0.25s ease;
    position: relative;
}

.info-index__item:last-child .info-index__link {
    border-bottom: none;
}

.info-index__link:hover {
    background: var(--color-bg);
    color: var(--color-primary);
    padding-left: 32px;
}

.info-index__link-num {
    font-size: 13px;
    font-weight: 700;
    color: var(--color-primary);
    opacity: 0.5;
    flex-shrink: 0;
    width: 28px;
    transition: opacity 0.2s;
    font-variant-numeric: tabular-nums;
}

.info-index__link:hover .info-index__link-num {
    opacity: 1;
}

.info-index__link-text {
    flex: 1;
    font-size: 15px;
    font-weight: 500;
    line-height: 1.4;
}

.info-index__link-arrow {
    flex-shrink: 0;
    color: var(--color-primary);
    opacity: 0;
    transform: translateX(-6px);
    transition: opacity 0.25s ease, transform 0.25s ease;
}

.info-index__link:hover .info-index__link-arrow {
    opacity: 1;
    transform: translateX(0);
}

/* ============================================
   АНИМАЦИЯ
   ============================================ */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(10px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ============================================
   АДАПТИВ
   ============================================ */
@media (max-width: 1024px) {
    .info-index__hero {
        padding: 44px 0 40px;
        margin-bottom: 32px;
    }

    .info-index__title {
        font-size: 30px;
    }
}

@media (max-width: 768px) {
    .info-index {
        padding-bottom: 48px;
    }

    .info-index__hero {
        padding: 32px 0 28px;
        margin-bottom: 28px;
    }

    .info-index__title {
        font-size: 26px;
    }

    .info-index__link {
        padding: 16px 20px;
        gap: 12px;
    }

    .info-index__link:hover {
        padding-left: 24px;
    }

    .info-index__link-text {
        font-size: 14px;
    }
}

@media (max-width: 480px) {
    .info-index {
        padding-bottom: 32px;
    }

    .info-index__hero {
        padding: 70px 0 20px;
        margin-bottom: 20px;
    }

    .info-index__title {
        font-size: 22px;
        letter-spacing: 0;
    }

    .info-index__breadcrumbs {
        font-size: 12px;
        gap: 6px;
        margin-bottom: 10px;
    }

    .info-index__bc-sep {
        font-size: 10px;
    }

    .info-index__link {
        padding: 14px 16px;
        gap: 10px;
    }

    .info-index__link-num {
        display: none;
    }

    .info-index__link-arrow {
        opacity: 0.3;
        transform: none;
    }

    .info-index__link:hover .info-index__link-arrow {
        opacity: 0.6;
        transform: none;
    }

    .info-index__link-text {
        font-size: 14px;
    }

    .info-index__hero::before,
    .info-index__hero::after {
        display: none;
    }
}
</style>
