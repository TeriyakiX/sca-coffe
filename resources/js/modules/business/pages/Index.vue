<template>
    <MainLayout>
        <div class="biz">

            <!-- HERO -->
            <div class="biz__hero">
                <div class="container biz__hero-inner">
                    <nav class="biz__breadcrumbs">
                        <a href="/" class="biz__bc-link">Главная</a>
                        <span class="biz__bc-sep">•</span>
                        <span class="biz__bc-current">Бизнес</span>
                    </nav>
                    <div class="biz__hero-body">
                        <div class="biz__hero-text">
                            <div class="biz__eyebrow">
                                <span class="biz__eyebrow-line"></span>
                                {{ data.hero.tag }}
                            </div>
                            <h1 class="biz__title">{{ data.hero.title }}</h1>
                            <p class="biz__subtitle">{{ data.hero.text }}</p>
                            <button class="biz__hero-btn">
                                {{ data.hero.buttonText }}
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14M12 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                        <div class="biz__hero-img-wrap">
                            <img src="/images/business-hero.jpg" alt="Бизнес-образование" class="biz__hero-img" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="container biz__body">

                <!-- Почему это важно -->
                <section class="biz__section">
                    <h2 class="biz__section-title">Почему это важно для вашего бизнеса</h2>
                    <div class="biz__features">
                        <div v-for="feature in data.features" :key="feature.title" class="biz__feature">
                            <div class="biz__feature-dot"></div>
                            <div>
                                <h3 class="biz__feature-title">{{ feature.title }}</h3>
                                <p class="biz__feature-text">{{ feature.text }}</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Онлайн-обучение -->
                <section class="biz__section biz__online">
                    <div class="biz__online-img-wrap">
                        <img src="/images/business-online.jpg" alt="Онлайн-обучение" class="biz__online-img" />
                    </div>
                    <div class="biz__online-content">
                        <div class="biz__eyebrow biz__eyebrow--dark">
                            <span class="biz__eyebrow-line biz__eyebrow-line--dark"></span>
                            Онлайн-обучение
                        </div>
                        <h2 class="biz__online-title">{{ data.online.title }}</h2>
                        <p class="biz__online-text">{{ data.online.text }}</p>
                    </div>
                </section>

                <!-- Программа -->
                <section class="biz__section">
                    <h2 class="biz__section-title">Что вы узнаете</h2>
                    <p class="biz__section-sub">
                        Программа построена вокруг четырёх ключевых областей и разработана
                        опытными профессионалами с практическим опытом управления.
                    </p>
                    <div class="biz__curriculum">
                        <div v-for="area in data.curriculum" :key="area.id" class="biz__curriculum-card">
                            <h3 class="biz__curriculum-title">{{ area.title }}</h3>
                            <ul class="biz__curriculum-list">
                                <li v-for="item in area.items" :key="item">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#2D9359" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"/>
                                    </svg>
                                    {{ item }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>

                <!-- CTA -->
                <section class="biz__cta">
                    <div class="biz__cta-inner">
                        <span class="biz__cta-badge">Не пропустите</span>
                        <h2 class="biz__cta-title">Зарегистрируйтесь сегодня!</h2>
                        <p class="biz__cta-text">Получите ранний доступ к программе</p>
                        <button class="biz__cta-btn">
                            Записаться
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14M12 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                </section>

                <!-- FAQ -->
                <section class="biz__section biz__section--last">
                    <h2 class="biz__section-title">Часто задаваемые вопросы</h2>
                    <div class="biz__faq">
                        <div v-for="(faq, i) in data.faqs" :key="i" class="biz__faq-item" :class="{ 'is-open': openFaq === i }">
                            <button class="biz__faq-q" @click="toggleFaq(i)">
                                <span>{{ faq.question }}</span>
                                <svg class="biz__faq-caret" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="6 9 12 15 18 9"/>
                                </svg>
                            </button>
                            <transition name="faq">
                                <div v-if="openFaq === i" class="biz__faq-a">
                                    {{ faq.answer }}
                                </div>
                            </transition>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { ref } from 'vue'
import MainLayout from '@/app/layouts/MainLayout.vue'
import { businessData } from '../constants/businessData'

const data = businessData
const openFaq = ref(null)
const toggleFaq = (i) => { openFaq.value = openFaq.value === i ? null : i }
</script>

<style scoped>
.biz {
    background: var(--color-bg);
    padding-bottom: 0;
}

/* ============================================
   HERO
   ============================================ */
.biz__hero {
    background: linear-gradient(135deg, #2D9359 0%, #1F6B3F 50%, #693C26 100%);
    padding: 100px 0 48px;
    position: relative;
    overflow: hidden;
}

.biz__hero::after {
    content: '';
    position: absolute;
    right: -60px; bottom: -80px;
    width: 380px; height: 380px;
    border-radius: 50%;
    background: rgba(255,255,255,0.04);
    pointer-events: none;
}

.biz__hero::before {
    content: '';
    position: absolute;
    right: 40px; bottom: -120px;
    width: 260px; height: 260px;
    border-radius: 50%;
    background: rgba(255,255,255,0.03);
    pointer-events: none;
}

.biz__hero-inner { position: relative; z-index: 1; }

.biz__breadcrumbs {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    margin-bottom: 32px;
}

.biz__bc-link {
    color: rgba(255,255,255,0.75);
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s;
}
.biz__bc-link:hover { color: #fff; }
.biz__bc-sep { color: rgba(255,255,255,0.4); font-size: 11px; }
.biz__bc-current { color: rgba(255,255,255,0.85); }

.biz__hero-body {
    display: flex;
    align-items: center;
    gap: 48px;
    justify-content: space-between;
}

.biz__hero-text { flex: 1; }

.biz__eyebrow {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2.5px;
    color: rgba(255,255,255,0.7);
    margin-bottom: 16px;
}

.biz__eyebrow--dark { color: rgba(51,51,51,0.5); }

.biz__eyebrow-line {
    display: block;
    width: 28px; height: 1px;
    background: rgba(255,255,255,0.4);
}

.biz__eyebrow-line--dark { background: rgba(105,60,38,0.3); }

.biz__title {
    font-size: 48px;
    font-weight: 800;
    color: #fff;
    margin: 0 0 16px;
    letter-spacing: -1px;
    line-height: 1.08;
}

.biz__subtitle {
    font-size: 17px;
    line-height: 1.65;
    color: rgba(255,255,255,0.75);
    max-width: 480px;
    margin: 0 0 32px;
}

.biz__hero-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 15px;
    font-weight: 700;
    color: #2D9359;
    background: #fff;
    border: 2px solid #fff;
    border-radius: 50px;
    padding: 14px 32px;
    cursor: pointer;
    font-family: var(--font-family);
    transition: all 0.25s ease;
    box-shadow: 0 8px 24px rgba(0,0,0,0.15);
}
.biz__hero-btn:hover { background: #FFEDCD; border-color: #FFEDCD; transform: translateY(-2px); }
.biz__hero-btn svg { transition: transform 0.2s; }
.biz__hero-btn:hover svg { transform: translateX(4px); }

.biz__hero-img-wrap {
    flex-shrink: 0;
    width: 340px; height: 240px;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 24px 60px rgba(0,0,0,0.25);
    border: 4px solid rgba(255,255,255,0.15);
}

.biz__hero-img { width: 100%; height: 100%; object-fit: cover; }

/* ============================================
   BODY
   ============================================ */
.biz__body {
    padding-top: 56px;
    padding-bottom: 80px;
    display: flex;
    flex-direction: column;
}

.biz__section {
    padding-bottom: 56px;
    margin-bottom: 56px;
    border-bottom: 1px solid rgba(105,60,38,0.1);
}

.biz__section--last { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }

.biz__section-title {
    font-size: 28px;
    font-weight: 800;
    color: #333;
    margin: 0 0 8px;
    letter-spacing: -0.3px;
}

.biz__section-sub {
    font-size: 15px;
    color: rgba(51,51,51,0.55);
    line-height: 1.65;
    max-width: 640px;
    margin: 0 0 28px;
}

/* ============================================
   ПРЕИМУЩЕСТВА
   ============================================ */
.biz__features {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-top: 28px;
}

.biz__feature {
    background: #fff;
    border-radius: 12px;
    padding: 24px;
    display: flex;
    gap: 16px;
    align-items: flex-start;
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
    transition: transform 0.2s, box-shadow 0.2s;
}

.biz__feature:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 24px rgba(45,147,89,0.1);
}

.biz__feature-dot {
    flex-shrink: 0;
    width: 8px; height: 8px;
    border-radius: 50%;
    background: #2D9359;
    margin-top: 6px;
}

.biz__feature-title {
    font-size: 15px;
    font-weight: 700;
    color: #333;
    margin: 0 0 6px;
}

.biz__feature-text {
    font-size: 13px;
    color: rgba(51,51,51,0.6);
    line-height: 1.6;
    margin: 0;
}

/* ============================================
   ОНЛАЙН
   ============================================ */
.biz__online {
    display: flex;
    gap: 48px;
    align-items: center;
    border-bottom: 1px solid rgba(105,60,38,0.1);
}

.biz__online-img-wrap {
    flex-shrink: 0;
    width: 320px; height: 220px;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 8px 32px rgba(0,0,0,0.1);
}

.biz__online-img { width: 100%; height: 100%; object-fit: cover; }

.biz__online-content { flex: 1; }

.biz__online-title {
    font-size: 26px;
    font-weight: 800;
    color: #333;
    margin: 0 0 14px;
    letter-spacing: -0.3px;
    line-height: 1.2;
}

.biz__online-text {
    font-size: 15px;
    color: rgba(51,51,51,0.65);
    line-height: 1.7;
    margin: 0;
}

/* ============================================
   ПРОГРАММА
   ============================================ */
.biz__curriculum {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
    margin-top: 4px;
}

.biz__curriculum-card {
    background: #fff;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
    border-top: 3px solid #2D9359;
}

.biz__curriculum-title {
    font-size: 14px;
    font-weight: 800;
    color: #2D9359;
    margin: 0 0 14px;
    line-height: 1.3;
}

.biz__curriculum-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.biz__curriculum-list li {
    display: flex;
    align-items: flex-start;
    gap: 8px;
    font-size: 13px;
    color: rgba(51,51,51,0.7);
    line-height: 1.45;
}

.biz__curriculum-list li svg { flex-shrink: 0; margin-top: 2px; }

/* ============================================
   CTA
   ============================================ */
.biz__cta { margin-bottom: 56px; }

.biz__cta-inner {
    background: linear-gradient(135deg, #2D9359 0%, #1F6B3F 50%, #693C26 100%);
    border-radius: 20px;
    padding: 56px 48px;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.biz__cta-inner::before {
    content: '';
    position: absolute;
    right: -60px; top: -60px;
    width: 280px; height: 280px;
    border-radius: 50%;
    background: rgba(255,255,255,0.04);
}

.biz__cta-badge {
    display: inline-block;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    padding: 5px 18px;
    border: 1px solid rgba(255,255,255,0.3);
    border-radius: 50px;
    color: rgba(255,255,255,0.9);
    background: rgba(255,255,255,0.08);
    margin-bottom: 20px;
}

.biz__cta-title {
    font-size: 32px;
    font-weight: 800;
    color: #fff;
    margin: 0 0 10px;
    letter-spacing: -0.5px;
}

.biz__cta-text {
    font-size: 16px;
    color: rgba(255,255,255,0.75);
    margin: 0 0 28px;
}

.biz__cta-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 15px;
    font-weight: 700;
    color: #2D9359;
    background: #fff;
    border: 2px solid #fff;
    border-radius: 50px;
    padding: 13px 32px;
    cursor: pointer;
    font-family: var(--font-family);
    transition: all 0.25s ease;
    box-shadow: 0 8px 24px rgba(0,0,0,0.15);
}
.biz__cta-btn:hover { background: #FFEDCD; border-color: #FFEDCD; transform: translateY(-2px); }
.biz__cta-btn svg { transition: transform 0.2s; }
.biz__cta-btn:hover svg { transform: translateX(4px); }

/* ============================================
   FAQ
   ============================================ */
.biz__faq {
    max-width: 800px;
    margin-top: 28px;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.biz__faq-item {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
    overflow: hidden;
    border: 1px solid rgba(105,60,38,0.07);
    transition: box-shadow 0.2s;
}

.biz__faq-item.is-open {
    box-shadow: 0 4px 20px rgba(45,147,89,0.1);
}

.biz__faq-q {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    width: 100%;
    padding: 18px 20px;
    background: none;
    border: none;
    cursor: pointer;
    font-family: var(--font-family);
    font-size: 15px;
    font-weight: 600;
    color: #333;
    text-align: left;
    transition: color 0.2s;
}

.biz__faq-q:hover { color: #2D9359; }

.biz__faq-caret {
    flex-shrink: 0;
    color: #2D9359;
    transition: transform 0.28s ease;
}

.biz__faq-item.is-open .biz__faq-caret { transform: rotate(180deg); }

.biz__faq-a {
    padding: 0 20px 18px;
    font-size: 14px;
    color: rgba(51,51,51,0.65);
    line-height: 1.7;
}

.faq-enter-active, .faq-leave-active { transition: opacity 0.2s ease; }
.faq-enter-from, .faq-leave-to { opacity: 0; }

/* ============================================
   АДАПТИВ — 1024px
   ============================================ */
@media (max-width: 1024px) {
    .biz__curriculum { grid-template-columns: repeat(2, 1fr); }
    .biz__hero-img-wrap { width: 280px; height: 200px; }
    .biz__title { font-size: 40px; }
}

/* ============================================
   АДАПТИВ — 768px
   ============================================ */
@media (max-width: 768px) {
    .biz__hero { padding: 90px 0 36px; }
    .biz__hero-body { flex-direction: column; gap: 28px; }
    .biz__hero-img-wrap { width: 100%; height: 200px; }
    .biz__title { font-size: 32px; }
    .biz__subtitle { font-size: 15px; }

    .biz__body { padding-top: 36px; padding-bottom: 48px; }
    .biz__section { padding-bottom: 40px; margin-bottom: 40px; }

    .biz__features { grid-template-columns: 1fr; }

    .biz__online { flex-direction: column; gap: 24px; }
    .biz__online-img-wrap { width: 100%; height: 200px; }
    .biz__online-title { font-size: 22px; }

    .biz__curriculum { grid-template-columns: repeat(2, 1fr); }

    .biz__cta-inner { padding: 36px 24px; }
    .biz__cta-title { font-size: 24px; }
}

/* ============================================
   АДАПТИВ — 480px
   ============================================ */
@media (max-width: 480px) {
    .biz__hero { padding: 80px 0 28px; }
    .biz__title { font-size: 26px; letter-spacing: -0.3px; }
    .biz__subtitle { font-size: 14px; margin-bottom: 24px; }
    .biz__hero-btn { width: 100%; justify-content: center; }
    .biz__hero-img-wrap { height: 180px; border-radius: 12px; }

    .biz__section-title { font-size: 22px; }
    .biz__curriculum { grid-template-columns: 1fr; }

    .biz__cta-inner { padding: 28px 16px; border-radius: 14px; }
    .biz__cta-title { font-size: 20px; }
    .biz__cta-btn { width: 100%; justify-content: center; }
}
</style>
