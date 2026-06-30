<template>
    <MainLayout>
        <div class="about">

            <!-- HERO — кремовый в стиле бренда -->
            <div class="about__hero">
                <div class="container about__hero-inner">
                    <nav class="about__breadcrumbs">
                        <a href="/" class="about__bc-link">Главная</a>
                        <span class="about__bc-sep">•</span>
                        <span class="about__bc-current">О нас</span>
                    </nav>

                    <div class="about__hero-body">
                        <div class="about__hero-text">
                            <div class="about__eyebrow">
                                <span class="about__eyebrow-line"></span>
                                Профессиональное сообщество
                            </div>
                            <h1 class="about__title">О нас</h1>
                            <p class="about__subtitle">
                                Глобальная площадка, где пересекаются культура,
                                коммерция и сообщество кофейной и чайной индустрии.
                            </p>
                        </div>
                        <div class="about__hero-logo">
                            <img src="/images/logo.png" alt="Логотип" class="about__logo" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- КОНТЕНТ -->
            <div class="container about__body">

                <!-- Наша цель -->
                <section class="about__section">
                    <div class="about__section-label">01</div>
                    <div class="about__section-content">
                        <h2 class="about__section-title">Наша цель</h2>
                        <p class="about__text">
                            Ассоциация способствует развитию мирового кофейного и чайного сообщества,
                            поддерживая деятельность, направленную на то, чтобы индустрия стала
                            процветающей, справедливой и устойчивой для всей цепочки создания стоимости.
                        </p>
                    </div>
                </section>

                <!-- Наша история -->
                <section class="about__section">
                    <div class="about__section-label">02</div>
                    <div class="about__section-content">
                        <h2 class="about__section-title">Наша история</h2>
                        <p class="about__text">
                            Ассоциация была создана в 2017 году в результате объединения двух старейших отраслевых организаций:
                        </p>
                        <div class="about__history-cards">
                            <div class="about__history-card">
                                <span class="about__history-year">1982</span>
                                <strong>Ассоциация спешелти кофе Америки (SCAA)</strong>
                                <p>Основана в 1982 году, стала первопроходцем в стандартах качества кофе в США.</p>
                            </div>
                            <div class="about__history-card">
                                <span class="about__history-year">1998</span>
                                <strong>Ассоциация спешелти кофе Европы (SCAE)</strong>
                                <p>Основана в 1998 году, объединила европейских профессионалов кофейной индустрии.</p>
                            </div>
                        </div>
                        <p class="about__text">
                            Вместе с World Coffee Events эти организации сыграли важную роль
                            в формировании индустрии через образование, стандарты качества
                            и глобальное сотрудничество.
                        </p>
                    </div>
                </section>

                <!-- Стратегические цели -->
                <section class="about__section">
                    <div class="about__section-label">03</div>
                    <div class="about__section-content">
                        <h2 class="about__section-title">Стратегические цели</h2>
                        <p class="about__text">Для достижения своей миссии мы уделяем особое внимание четырём ключевым приоритетам:</p>
                        <div class="about__goals">
                            <div v-for="goal in goals" :key="goal.id" class="about__goal">
                                <span class="about__goal-num">{{ String(goal.id).padStart(2, '0') }}</span>
                                <p class="about__goal-text">{{ goal.text }}</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Годовые отчёты -->
                <section class="about__section">
                    <div class="about__section-label">04</div>
                    <div class="about__section-content">
                        <h2 class="about__section-title">Годовые отчёты</h2>
                        <div class="about__reports">
                            <div v-for="report in reports" :key="report.year" class="about__report">
                                <div class="about__report-year">{{ report.year }}</div>
                                <div class="about__report-body">
                                    <h3>Годовой отчёт за {{ report.year }} год</h3>
                                    <p>{{ report.description }}</p>
                                </div>
                                <a href="#" class="about__report-btn">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>
                                    </svg>
                                    Скачать
                                </a>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Контакты -->
                <section class="about__contact">
                    <div class="about__contact-inner">
                        <img src="/images/logo.png" alt="" class="about__contact-logo" aria-hidden="true" />
                        <h2 class="about__contact-title">Свяжитесь с нами</h2>
                        <p class="about__contact-text">
                            Мы будем рады вашим вопросам, идеям и сотрудничеству
                            со всеми участниками цепочки создания стоимости кофе и чая.
                        </p>
                        <a href="mailto:info@coffee-association.ru" class="about__contact-btn">
                            Связаться с нами
                        </a>
                    </div>
                </section>

            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/app/layouts/MainLayout.vue'

const goals = [
    { id: 1, text: 'Объединять сообщества через общий язык и разнообразие впечатлений' },
    { id: 2, text: 'Повышать вовлечённость потребителей для развития индустрии' },
    { id: 3, text: 'Развивать коллективный разум для устойчивой и процветающей отрасли' },
    { id: 4, text: 'Создавать культуру инноваций и гибкости' },
]

const reports = [
    {
        year: 2023,
        description: 'Проведены исследования, разработаны стандарты, расширены образовательные программы и организованы мероприятия с глобальным охватом.'
    },
    {
        year: 2024,
        description: 'Приняты новые стандарты оценки качества, представлен World of Coffee в Азии и объявлена первая версия в стране-производителе кофе.'
    },
]
</script>

<style scoped>
.about {
    padding-bottom: 0;
    background: var(--color-bg);
}

/* ============================================
   HERO
   ============================================ */
.about__hero {
    background: linear-gradient(135deg, #2D9359 0%, #1F6B3F 50%, #693C26 100%);
    padding: 100px 0 48px;
    position: relative;
    overflow: hidden;
}

.about__hero::after {
    content: '';
    position: absolute;
    right: -60px;
    bottom: -80px;
    width: 380px;
    height: 380px;
    border-radius: 50%;
    border: 2px solid rgba(255, 255, 255, 0.08);
    pointer-events: none;
}

.about__hero::before {
    content: '';
    position: absolute;
    right: 40px;
    bottom: -120px;
    width: 260px;
    height: 260px;
    border-radius: 50%;
    border: 2px solid rgba(255, 255, 255, 0.06);
    pointer-events: none;
}

.about__hero-inner {
    position: relative;
    z-index: 1;
}

/* хлебные крошки */
.about__breadcrumbs {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    margin-bottom: 32px;
}

.about__bc-link {
    color: rgba(255,255,255,0.75);
    text-decoration: none;
    font-weight: 500;
    transition: opacity 0.2s;
}

.about__bc-link:hover { color: #fff; }

.about__bc-sep {
    color: rgba(255,255,255,0.4);
    font-size: 11px;
}

.about__bc-current {
    color: rgba(255,255,255,0.85);
}

/* hero body — две колонки */
.about__hero-body {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 40px;
}

.about__hero-text {
    flex: 1;
}

.about__hero-logo {
    flex-shrink: 0;
}

.about__logo {
    width: 160px;
    height: 160px;
    object-fit: contain;
    filter: drop-shadow(0 8px 32px rgba(45,147,89,0.15));
}

/* eyebrow */
.about__eyebrow {
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

.about__eyebrow-line {
    display: block;
    width: 28px;
    height: 1px;
    background: rgba(255,255,255,0.4);
}

.about__title {
    font-size: 52px;
    font-weight: 800;
    color: #fff;
    margin: 0 0 16px;
    letter-spacing: -1px;
    line-height: 1.1;
}

.about__subtitle {
    font-size: 17px;
    line-height: 1.65;
    color: rgba(255,255,255,0.75);
    max-width: 520px;
    margin: 0;
}

/* ============================================
   BODY
   ============================================ */
.about__body {
    padding-top: 64px;
    padding-bottom: 64px;
    display: flex;
    flex-direction: column;
    gap: 0;
}

/* ============================================
   СЕКЦИИ
   ============================================ */
.about__section {
    display: flex;
    gap: 40px;
    padding-bottom: 56px;
    margin-bottom: 56px;
    border-bottom: 1px solid rgba(105,60,38,0.1);
}

.about__section:last-of-type {
    border-bottom: none;
    margin-bottom: 0;
}

.about__section-label {
    flex-shrink: 0;
    width: 48px;
    font-size: 13px;
    font-weight: 800;
    color: #2D9359;
    opacity: 0.45;
    letter-spacing: 1px;
    padding-top: 6px;
}

.about__section-content {
    flex: 1;
}

.about__section-title {
    font-size: 26px;
    font-weight: 800;
    color: #333333;
    margin: 0 0 16px;
    letter-spacing: -0.3px;
}

.about__text {
    font-size: 16px;
    line-height: 1.75;
    color: rgba(51,51,51,0.7);
    margin: 0 0 20px;
}

.about__text:last-child { margin-bottom: 0; }

/* история — карточки */
.about__history-cards {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin: 20px 0 24px;
}

.about__history-card {
    background: #fff;
    border-radius: 12px;
    padding: 20px;
    border-left: 3px solid #2D9359;
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
}

.about__history-year {
    display: inline-block;
    font-size: 11px;
    font-weight: 800;
    color: #2D9359;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 8px;
    background: rgba(45,147,89,0.08);
    padding: 3px 8px;
    border-radius: 4px;
}

.about__history-card strong {
    display: block;
    font-size: 14px;
    font-weight: 700;
    color: #333;
    margin-bottom: 8px;
    line-height: 1.4;
}

.about__history-card p {
    font-size: 13px;
    color: rgba(51,51,51,0.6);
    line-height: 1.6;
    margin: 0;
}

/* цели */
.about__goals {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    margin-top: 20px;
}

.about__goal {
    background: #fff;
    border-radius: 12px;
    padding: 20px;
    display: flex;
    gap: 14px;
    align-items: flex-start;
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
    transition: box-shadow 0.2s, transform 0.2s;
}

.about__goal:hover {
    box-shadow: 0 6px 24px rgba(45,147,89,0.1);
    transform: translateY(-2px);
}

.about__goal-num {
    flex-shrink: 0;
    font-size: 13px;
    font-weight: 800;
    color: #2D9359;
    opacity: 0.5;
    min-width: 24px;
    padding-top: 1px;
}

.about__goal-text {
    font-size: 14px;
    line-height: 1.6;
    color: #333;
    margin: 0;
}

/* отчёты */
.about__reports {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-top: 20px;
}

.about__report {
    background: #fff;
    border-radius: 12px;
    padding: 20px 24px;
    display: flex;
    align-items: center;
    gap: 24px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
    transition: box-shadow 0.2s;
}

.about__report:hover {
    box-shadow: 0 6px 24px rgba(0,0,0,0.08);
}

.about__report-year {
    flex-shrink: 0;
    font-size: 28px;
    font-weight: 800;
    color: #2D9359;
    letter-spacing: -1px;
    min-width: 64px;
}

.about__report-body {
    flex: 1;
}

.about__report-body h3 {
    font-size: 15px;
    font-weight: 700;
    color: #333;
    margin: 0 0 4px;
}

.about__report-body p {
    font-size: 13px;
    color: rgba(51,51,51,0.6);
    line-height: 1.55;
    margin: 0;
}

.about__report-btn {
    flex-shrink: 0;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    font-weight: 600;
    color: #2D9359;
    text-decoration: none;
    border: 1.5px solid rgba(45,147,89,0.3);
    border-radius: 8px;
    padding: 8px 16px;
    transition: all 0.2s;
}

.about__report-btn:hover {
    background: #2D9359;
    color: #fff;
    border-color: #2D9359;
}

/* ============================================
   КОНТАКТ
   ============================================ */
.about__contact {
    margin-top: 16px;
}

.about__contact-inner {
    background: var(--color-bg);
    border-radius: 20px;
    padding: 56px 40px;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.about__contact-inner::before {
    content: '';
    position: absolute;
    right: -60px;
    top: -60px;
    width: 260px;
    height: 260px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(45,147,89,0.1) 0%, transparent 70%);
}

.about__contact-logo {
    width: 72px;
    height: 72px;
    object-fit: contain;
    margin-bottom: 20px;
    filter: drop-shadow(0 4px 12px rgba(45,147,89,0.15));
}

.about__contact-title {
    font-size: 28px;
    font-weight: 800;
    color: #333;
    margin: 0 0 12px;
    letter-spacing: -0.3px;
}

.about__contact-text {
    font-size: 16px;
    color: rgba(51,51,51,0.65);
    line-height: 1.65;
    max-width: 480px;
    margin: 0 auto 28px;
}

.about__contact-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 15px;
    font-weight: 700;
    color: #fff;
    background: #2D9359;
    border: 2px solid #2D9359;
    border-radius: 50px;
    padding: 14px 36px;
    text-decoration: none;
    transition: all 0.25s ease;
    box-shadow: 0 8px 24px rgba(45,147,89,0.25);
}

.about__contact-btn:hover {
    background: #1F6B3F;
    border-color: #1F6B3F;
    transform: translateY(-2px);
    box-shadow: 0 12px 32px rgba(45,147,89,0.3);
}

/* ============================================
   АДАПТИВ — 768px
   ============================================ */
@media (max-width: 768px) {
    .about__hero { padding: 90px 0 36px; }

    .about__hero-body { flex-direction: column-reverse; gap: 24px; }

    .about__logo { width: 100px; height: 100px; }

    .about__title { font-size: 36px; }
    .about__subtitle { font-size: 15px; }

    .about__section { flex-direction: column; gap: 12px; }
    .about__section-label { width: auto; }

    .about__history-cards { grid-template-columns: 1fr; }
    .about__goals { grid-template-columns: 1fr; }

    .about__report { flex-wrap: wrap; gap: 12px; }
    .about__report-year { font-size: 22px; min-width: auto; }
    .about__report-btn { width: 100%; justify-content: center; }

    .about__contact-inner { padding: 36px 20px; }
    .about__contact-title { font-size: 22px; }
}

/* ============================================
   АДАПТИВ — 480px
   ============================================ */
@media (max-width: 480px) {
    .about__hero { padding: 80px 0 28px; }

    .about__hero-logo { display: none; }

    .about__title { font-size: 28px; letter-spacing: -0.3px; }
    .about__subtitle { font-size: 14px; }

    .about__breadcrumbs { font-size: 12px; margin-bottom: 20px; }

    .about__body { padding-top: 36px; padding-bottom: 40px; }
    .about__section { padding-bottom: 36px; margin-bottom: 36px; }
    .about__section-title { font-size: 22px; }

    .about__goal { padding: 16px; }
    .about__report { padding: 16px; }

    .about__contact-inner { padding: 28px 16px; border-radius: 14px; }
    .about__contact-btn { width: 100%; justify-content: center; }
}
</style>
