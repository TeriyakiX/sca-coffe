<template>
    <MainLayout>
        <div class="join">

            <!-- HERO -->
            <div class="join__hero">
                <div class="container join__hero-inner">
                    <nav class="join__breadcrumbs">
                        <a href="/" class="join__bc-link">Главная</a>
                        <span class="join__bc-sep">•</span>
                        <span class="join__bc-current">Членство</span>
                    </nav>
                    <div class="join__hero-body">
                        <div class="join__hero-text">
                            <div class="join__eyebrow">
                                <span class="join__eyebrow-line"></span>
                                Присоединяйтесь к нам
                            </div>
                            <h1 class="join__title">Станьте членом<br>ассоциации</h1>
                            <p class="join__subtitle">
                                Присоединяйтесь к глобальному сообществу профессионалов
                                кофейной и чайной индустрии.
                            </p>
                            <a href="#pricing" class="join__hero-btn" @click.prevent="scrollToPricing">
                                Выбрать тариф
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14M12 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                        <div class="join__hero-logo">
                            <img src="/images/logo.png" alt="Логотип" class="join__logo" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="container join__body">

                <!-- Преимущества -->
                <section class="join__section">
                    <h2 class="join__section-title">Зачем становиться членом</h2>
                    <p class="join__section-sub">
                        Членство даёт практические инструменты, доступ к отрасли
                        и реальные возможности для развития.
                    </p>
                    <div class="join__benefits">
                        <div v-for="benefit in benefits" :key="benefit.id" class="join__benefit">
                            <span class="join__benefit-num">{{ String(benefit.id).padStart(2,'0') }}</span>
                            <div>
                                <h3 class="join__benefit-title">{{ benefit.title }}</h3>
                                <p class="join__benefit-text">{{ benefit.text }}</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Индивидуальное членство -->
                <section id="pricing" class="join__section">
                    <h2 class="join__section-title">Индивидуальное членство</h2>
                    <p class="join__section-sub">Для специалистов, бариста, обжарщиков и всех профессионалов индустрии.</p>

                    <div class="join__individual">
                        <div class="join__individual-price">
                            <span class="join__price-amount">$100</span>
                            <span class="join__price-period">/ €90 в год</span>
                        </div>
                        <div class="join__individual-features">
                            <div v-for="f in individualFeatures" :key="f" class="join__feature">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2D9359" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"/>
                                </svg>
                                <span>{{ f }}</span>
                            </div>
                        </div>
                        <button class="join__cta-btn" @click="handleJoin">
                            Оформить членство
                        </button>
                    </div>
                </section>

                <!-- Корпоративное членство -->
                <section class="join__section join__section--last">
                    <h2 class="join__section-title">Корпоративное членство</h2>
                    <p class="join__section-sub">
                        Поддержите свою команду и получите доступ к преимуществам для всей организации.
                    </p>
                    <div class="join__tiers">
                        <div v-for="tier in corporateTiers" :key="tier.name" class="join__tier">
                            <div class="join__tier-header">
                                <h3 class="join__tier-name">{{ tier.name }}</h3>
                                <p class="join__tier-desc">{{ tier.desc }}</p>
                            </div>
                            <div class="join__tier-price">
                                <span class="join__tier-amount">{{ tier.price }}</span>
                                <span class="join__tier-period">/ год</span>
                            </div>
                            <ul class="join__tier-features">
                                <li v-for="f in tier.features" :key="f">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#2D9359" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"/>
                                    </svg>
                                    {{ f }}
                                </li>
                            </ul>
                            <button class="join__tier-btn" @click="handleCorporateJoin(tier.name)">
                                Выбрать
                            </button>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/app/layouts/MainLayout.vue'

const scrollToPricing = () => {
    document.getElementById('pricing')?.scrollIntoView({ behavior: 'smooth', block: 'start' })
}

const benefits = [
    { id: 1, title: 'Глобальное сообщество', text: 'Присоединяйтесь к сети производителей, бариста, обжарщиков и владельцев бизнеса по всему миру.' },
    { id: 2, title: 'Исследования и ресурсы', text: 'Ранний доступ к отчётам, аналитическим документам и практическим инструментам индустрии.' },
    { id: 3, title: 'Авторитет в индустрии', text: 'Получите признание через программы и участие в деятельности ассоциации.' },
    { id: 4, title: 'Скидки на мероприятия', text: 'Специальные цены на выставки, конференции и образовательные программы.' },
]

const individualFeatures = [
    'Ранний доступ к исследованиям и отчётам',
    'Бесплатная печатная версия журнала',
    'Скидки на мероприятия ассоциации',
    'Право голоса на выборах',
    'Скидка 20% в магазине ассоциации',
]

const corporateTiers = [
    { name: 'Малая компания',    desc: 'Годовой доход менее $1 млн',          price: '$420 / €390',   features: ['Доступ к мероприятиям', 'Скидки на обучение', 'Нетворкинг'] },
    { name: 'Средняя компания',  desc: 'Годовой доход от $1 до $5 млн',        price: '$840 / €770',   features: ['Все преимущества малой компании', 'Приоритетная поддержка'] },
    { name: 'Крупная компания',  desc: 'Годовой доход от $5 до $20 млн',       price: '$1 600 / €1 650', features: ['Все преимущества средней компании', 'Специальные предложения'] },
    { name: 'Корпоративный',     desc: 'Годовой доход более $20 млн',          price: '$2 600 / €2 400', features: ['Все преимущества крупной компании', 'Персональный менеджер'] },
    { name: 'НКО',               desc: 'Для некоммерческих организаций',        price: '$420 / €390',   features: ['Специальные условия для НКО', 'Доступ к ресурсам'] },
]

const handleJoin = () => alert('Форма оформления индивидуального членства')
const handleCorporateJoin = (name) => alert(`Тариф "${name}" — форма оформления`)
</script>

<style scoped>
.join {
    background: var(--color-bg);
    padding-bottom: 0;
}

/* ============================================
   HERO
   ============================================ */
.join__hero {
    background: linear-gradient(135deg, #2D9359 0%, #1F6B3F 50%, #693C26 100%);
    padding: 100px 0 48px;
    position: relative;
    overflow: hidden;
}

.join__hero::after {
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

.join__hero::before {
    content: '';
    position: absolute;
    right: 40px;
    bottom: -120px;
    width: 260px;
    height: 260px;
    border-radius: 50%;
    background: rgba(255,255,255,0.03);
    pointer-events: none;
}

.join__hero-inner { position: relative; z-index: 1; }

.join__breadcrumbs {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    margin-bottom: 32px;
}

.join__bc-link {
    color: rgba(255,255,255,0.75);
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s;
}
.join__bc-link:hover { color: #fff; }

.join__bc-sep { color: rgba(255,255,255,0.4); font-size: 11px; }
.join__bc-current { color: rgba(255,255,255,0.85); }

.join__hero-body {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 40px;
}

.join__hero-text { flex: 1; }
.join__hero-logo { flex-shrink: 0; }

.join__logo {
    width: 160px;
    height: 160px;
    object-fit: contain;
    filter: drop-shadow(0 8px 32px rgba(0,0,0,0.2));
}

.join__eyebrow {
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

.join__eyebrow-line {
    display: block;
    width: 28px;
    height: 1px;
    background: rgba(255,255,255,0.4);
}

.join__title {
    font-size: 52px;
    font-weight: 800;
    color: #fff;
    margin: 0 0 16px;
    letter-spacing: -1px;
    line-height: 1.08;
}

.join__subtitle {
    font-size: 17px;
    line-height: 1.65;
    color: rgba(255,255,255,0.75);
    max-width: 480px;
    margin: 0 0 32px;
}

.join__hero-btn {
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
    text-decoration: none;
    cursor: pointer;
    font-family: var(--font-family);
    transition: all 0.25s ease;
    box-shadow: 0 8px 24px rgba(0,0,0,0.15);
}

.join__hero-btn:hover {
    background: #FFEDCD;
    border-color: #FFEDCD;
    transform: translateY(-2px);
}

.join__hero-btn svg { transition: transform 0.2s; }
.join__hero-btn:hover svg { transform: translateX(4px); }

/* ============================================
   BODY
   ============================================ */
.join__body {
    padding-top: 64px;
    padding-bottom: 80px;
    display: flex;
    flex-direction: column;
    gap: 0;
}

.join__section {
    padding-bottom: 64px;
    margin-bottom: 64px;
    border-bottom: 1px solid rgba(105,60,38,0.1);
}

.join__section--last {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.join__section-title {
    font-size: 28px;
    font-weight: 800;
    color: #333;
    margin: 0 0 10px;
    letter-spacing: -0.3px;
}

.join__section-sub {
    font-size: 16px;
    color: rgba(51,51,51,0.6);
    line-height: 1.65;
    max-width: 600px;
    margin: 0 0 36px;
}

/* ============================================
   ПРЕИМУЩЕСТВА
   ============================================ */
.join__benefits {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

.join__benefit {
    background: #fff;
    border-radius: 12px;
    padding: 24px;
    display: flex;
    gap: 16px;
    align-items: flex-start;
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
    transition: box-shadow 0.2s, transform 0.2s;
}

.join__benefit:hover {
    box-shadow: 0 6px 24px rgba(45,147,89,0.1);
    transform: translateY(-2px);
}

.join__benefit-num {
    flex-shrink: 0;
    font-size: 13px;
    font-weight: 800;
    color: #2D9359;
    opacity: 0.45;
    min-width: 26px;
    padding-top: 2px;
}

.join__benefit-title {
    font-size: 15px;
    font-weight: 700;
    color: #333;
    margin: 0 0 6px;
}

.join__benefit-text {
    font-size: 13px;
    color: rgba(51,51,51,0.6);
    line-height: 1.6;
    margin: 0;
}

/* ============================================
   ИНДИВИДУАЛЬНОЕ ЧЛЕНСТВО
   ============================================ */
.join__individual {
    background: #fff;
    border-radius: 16px;
    padding: 36px;
    box-shadow: 0 4px 24px rgba(45,147,89,0.1);
    border: 2px solid #2D9359;
    max-width: 600px;
}

.join__individual-price {
    display: flex;
    align-items: baseline;
    gap: 10px;
    padding-bottom: 24px;
    margin-bottom: 24px;
    border-bottom: 1px solid rgba(105,60,38,0.1);
}

.join__price-amount {
    font-size: 48px;
    font-weight: 800;
    color: #2D9359;
    letter-spacing: -2px;
    line-height: 1;
}

.join__price-period {
    font-size: 16px;
    color: rgba(51,51,51,0.5);
    font-weight: 500;
}

.join__individual-features {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 28px;
}

.join__feature {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    color: #333;
    font-weight: 500;
}

.join__feature svg { flex-shrink: 0; }

.join__cta-btn {
    width: 100%;
    padding: 15px;
    background: #2D9359;
    color: #fff;
    border: none;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    font-family: var(--font-family);
    transition: all 0.25s ease;
    box-shadow: 0 6px 20px rgba(45,147,89,0.25);
}

.join__cta-btn:hover {
    background: #1F6B3F;
    transform: translateY(-2px);
    box-shadow: 0 10px 28px rgba(45,147,89,0.32);
}

/* ============================================
   КОРПОРАТИВНЫЕ ТАРИФЫ
   ============================================ */
.join__tiers {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
}

.join__tier {
    background: #fff;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
    border: 1px solid rgba(105,60,38,0.08);
    display: flex;
    flex-direction: column;
    transition: box-shadow 0.2s, transform 0.2s;
}

.join__tier:hover {
    box-shadow: 0 8px 28px rgba(45,147,89,0.1);
    transform: translateY(-3px);
}

.join__tier-header { margin-bottom: 16px; }

.join__tier-name {
    font-size: 16px;
    font-weight: 800;
    color: #333;
    margin: 0 0 4px;
}

.join__tier-desc {
    font-size: 12px;
    color: rgba(51,51,51,0.5);
    margin: 0;
    line-height: 1.4;
}

.join__tier-price {
    display: flex;
    align-items: baseline;
    gap: 4px;
    padding: 12px 0;
    border-top: 1px solid rgba(105,60,38,0.08);
    border-bottom: 1px solid rgba(105,60,38,0.08);
    margin-bottom: 16px;
}

.join__tier-amount {
    font-size: 20px;
    font-weight: 800;
    color: #2D9359;
    letter-spacing: -0.5px;
}

.join__tier-period {
    font-size: 12px;
    color: rgba(51,51,51,0.45);
}

.join__tier-features {
    list-style: none;
    padding: 0;
    margin: 0 0 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.join__tier-features li {
    display: flex;
    align-items: flex-start;
    gap: 8px;
    font-size: 13px;
    color: rgba(51,51,51,0.7);
    line-height: 1.4;
}

.join__tier-features li svg { flex-shrink: 0; margin-top: 2px; }

.join__tier-btn {
    width: 100%;
    padding: 11px;
    background: transparent;
    color: #2D9359;
    border: 1.5px solid rgba(45,147,89,0.35);
    border-radius: 8px;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    font-family: var(--font-family);
    transition: all 0.2s ease;
    margin-top: auto;
}

.join__tier-btn:hover {
    background: #2D9359;
    color: #fff;
    border-color: #2D9359;
}

/* ============================================
   АДАПТИВ — 1024px
   ============================================ */
@media (max-width: 1024px) {
    .join__tiers { grid-template-columns: repeat(2, 1fr); }
}

/* ============================================
   АДАПТИВ — 768px
   ============================================ */
@media (max-width: 768px) {
    .join__hero { padding: 90px 0 36px; }
    .join__hero-body { flex-direction: column-reverse; gap: 20px; }
    .join__logo { width: 100px; height: 100px; }
    .join__title { font-size: 36px; }
    .join__subtitle { font-size: 15px; }

    .join__body { padding-top: 40px; padding-bottom: 48px; }
    .join__section { padding-bottom: 40px; margin-bottom: 40px; }

    .join__benefits { grid-template-columns: 1fr; }
    .join__tiers { grid-template-columns: 1fr; }

    .join__individual { padding: 24px; }
    .join__price-amount { font-size: 36px; }
}

/* ============================================
   АДАПТИВ — 480px
   ============================================ */
@media (max-width: 480px) {
    .join__hero { padding: 80px 0 28px; }
    .join__hero-logo { display: none; }
    .join__title { font-size: 28px; letter-spacing: -0.3px; }
    .join__subtitle { font-size: 14px; margin-bottom: 24px; }
    .join__hero-btn { width: 100%; justify-content: center; }

    .join__body { padding-top: 28px; padding-bottom: 36px; }
    .join__section { padding-bottom: 32px; margin-bottom: 32px; }
    .join__section-title { font-size: 22px; }

    .join__individual { padding: 20px; }
    .join__cta-btn { font-size: 14px; }
}
</style>
