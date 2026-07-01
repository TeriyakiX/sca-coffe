<template>
    <section class="hero">

        <!-- Фоновые декоративные круги -->
        <div class="hero__bg-circle hero__bg-circle--1" aria-hidden="true"></div>
        <div class="hero__bg-circle hero__bg-circle--2" aria-hidden="true"></div>
        <div class="hero__bg-circle hero__bg-circle--3" aria-hidden="true"></div>

        <div class="container hero__inner">

            <!-- Логотип с анимацией -->
            <div class="hero__logo-wrap">
                <img
                    src="/images/logo.png"
                    alt="Логотип ассоциации"
                    class="hero__logo"
                />
            </div>

            <!-- Текст -->
            <div class="hero__content">
                <div class="hero__eyebrow">
                    <span class="hero__eyebrow-line"></span>
                    Профессиональное сообщество
                    <span class="hero__eyebrow-line"></span>
                </div>

                <h1 class="hero__title">
                    Ассоциация специалистов<br>
                    и производителей<br>
                    <span class="hero__title-accent">кофейной и чайной</span><br>
                    индустрии
                </h1>

                <p class="hero__subtitle">
                    Объединяем профессионалов и создаём стандарты качества мирового уровня
                </p>

                <div class="hero__actions">
                    <a href="#membership" class="hero__btn hero__btn--primary" @click.prevent="scrollToMembership">
                        Присоединиться
                    </a>
                    <a href="/about" class="hero__btn hero__btn--outline">
                        Узнать больше
                    </a>
                </div>
            </div>

            <!-- Статистика -->
            <div class="hero__stats">
                <div class="hero__stat">
                    <span class="hero__stat-num">500+</span>
                    <span class="hero__stat-label">членов ассоциации</span>
                </div>
                <div class="hero__stat-sep"></div>
                <div class="hero__stat">
                    <span class="hero__stat-num">12</span>
                    <span class="hero__stat-label">лет на рынке</span>
                </div>
                <div class="hero__stat-sep"></div>
                <div class="hero__stat">
                    <span class="hero__stat-num">80+</span>
                    <span class="hero__stat-label">курсов и программ</span>
                </div>
            </div>

        </div>

        <!-- Скролл-индикатор -->
        <div class="hero__scroll" aria-hidden="true">
            <div class="hero__scroll-dot"></div>
        </div>

    </section>
</template>

<script setup>
const scrollToMembership = () => {
    const el = document.getElementById('membership')
    if (el) {
        const top = el.getBoundingClientRect().top + window.pageYOffset - 80
        window.scrollTo({ top, behavior: 'smooth' })
    } else {
        window.location.href = '/#membership'
    }
}
</script>

<style scoped>
/* ============================================
   HERO
   ============================================ */
.hero {
    min-height: 100vh;
    min-height: 100svh;
    background: #FFEDCD;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
    padding: 100px 0 80px;
}

/* ============================================
   ДЕКОРАТИВНЫЕ КРУГИ (фон)
   ============================================ */
.hero__bg-circle {
    position: absolute;
    border-radius: 50%;
    pointer-events: none;
}

.hero__bg-circle--1 {
    width: 600px;
    height: 600px;
    top: -200px;
    right: -150px;
    background: radial-gradient(circle, rgba(45,147,89,0.08) 0%, transparent 70%);
    animation: breathe 8s ease-in-out infinite;
}

.hero__bg-circle--2 {
    width: 400px;
    height: 400px;
    bottom: -100px;
    left: -100px;
    background: radial-gradient(circle, rgba(105,60,38,0.07) 0%, transparent 70%);
    animation: breathe 10s ease-in-out infinite 2s;
}

.hero__bg-circle--3 {
    width: 300px;
    height: 300px;
    top: 40%;
    left: 60%;
    background: radial-gradient(circle, rgba(45,147,89,0.05) 0%, transparent 70%);
    animation: breathe 12s ease-in-out infinite 4s;
}

@keyframes breathe {
    0%, 100% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.15); opacity: 0.7; }
}

/* ============================================
   INNER
   ============================================ */
.hero__inner {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    position: relative;
    z-index: 1;
    gap: 0;
}

/* ============================================
   ЛОГОТИП
   ============================================ */
.hero__logo-wrap {
    margin-bottom: 32px;
    animation: logoIn 1s cubic-bezier(0.22, 1, 0.36, 1) both;
}

.hero__logo {
    width: 160px;
    height: 160px;
    object-fit: contain;
    filter: drop-shadow(0 12px 40px rgba(45, 147, 89, 0.2));
}

@keyframes logoIn {
    from {
        opacity: 0;
        transform: translateY(-30px) scale(0.85);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

/* ============================================
   КОНТЕНТ
   ============================================ */
.hero__content {
    animation: contentIn 0.9s cubic-bezier(0.22, 1, 0.36, 1) 0.3s both;
}

@keyframes contentIn {
    from { opacity: 0; transform: translateY(24px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ===== EYEBROW ===== */
.hero__eyebrow {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 14px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 3px;
    color: #693C26;
    margin-bottom: 24px;
    opacity: 0.75;
}

.hero__eyebrow-line {
    display: block;
    width: 32px;
    height: 1px;
    background: #693C26;
    opacity: 0.4;
}

/* ===== ЗАГОЛОВОК ===== */
.hero__title {
    font-size: 56px;
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -1.5px;
    color: #333333;
    margin: 0 0 20px;
}

.hero__title-accent {
    color: #2D9359;
}

/* ===== SUBTITLE ===== */
.hero__subtitle {
    font-size: 18px;
    font-weight: 400;
    line-height: 1.6;
    color: rgba(51, 51, 51, 0.6);
    max-width: 520px;
    margin: 0 auto 40px;
}

/* ===== КНОПКИ ===== */
.hero__actions {
    display: flex;
    gap: 16px;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 0;
}

.hero__btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 15px;
    font-weight: 700;
    border-radius: 50px;
    text-decoration: none;
    padding: 15px 36px;
    transition: all 0.25s ease;
    cursor: pointer;
    font-family: var(--font-family);
    white-space: nowrap;
    letter-spacing: 0.2px;
}

.hero__btn--primary {
    background: #2D9359;
    color: #fff;
    border: 2px solid #2D9359;
    box-shadow: 0 8px 32px rgba(45, 147, 89, 0.28);
}

.hero__btn--primary:hover {
    background: #1F6B3F;
    border-color: #1F6B3F;
    transform: translateY(-3px);
    box-shadow: 0 14px 40px rgba(45, 147, 89, 0.35);
}

.hero__btn--outline {
    background: transparent;
    color: #333333;
    border: 2px solid rgba(51, 51, 51, 0.2);
}

.hero__btn--outline:hover {
    border-color: #2D9359;
    color: #2D9359;
    transform: translateY(-3px);
}

/* ============================================
   СТАТИСТИКА
   ============================================ */
.hero__stats {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 40px;
    margin-top: 56px;
    padding-top: 40px;
    border-top: 1px solid rgba(105, 60, 38, 0.12);
    width: 100%;
    animation: contentIn 0.9s cubic-bezier(0.22, 1, 0.36, 1) 0.55s both;
}

.hero__stat {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
}

.hero__stat-num {
    font-size: 36px;
    font-weight: 800;
    color: #2D9359;
    line-height: 1;
    letter-spacing: -1px;
}

.hero__stat-label {
    font-size: 12px;
    font-weight: 500;
    color: rgba(51, 51, 51, 0.5);
    text-transform: uppercase;
    letter-spacing: 0.8px;
}

.hero__stat-sep {
    width: 1px;
    height: 40px;
    background: rgba(105, 60, 38, 0.15);
    flex-shrink: 0;
}

/* ============================================
   СКРОЛЛ-ИНДИКАТОР
   ============================================ */
.hero__scroll {
    position: absolute;
    bottom: 28px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 2;
    animation: scrollBounce 2.5s ease-in-out infinite 1.5s;
}

.hero__scroll-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #2D9359;
    opacity: 0.5;
}

@keyframes scrollBounce {
    0%, 100% { transform: translateX(-50%) translateY(0); opacity: 0.5; }
    50% { transform: translateX(-50%) translateY(10px); opacity: 1; }
}

/* ============================================
   АДАПТИВ — 768px
   ============================================ */
@media (max-width: 768px) {
    .hero {
        padding: 90px 0 70px;
    }

    .hero__logo {
        width: 130px;
        height: 130px;
    }

    .hero__logo-wrap {
        margin-bottom: 24px;
    }

    .hero__title {
        font-size: 38px;
        letter-spacing: -0.8px;
    }

    .hero__subtitle {
        font-size: 16px;
    }

    .hero__stats {
        gap: 24px;
        margin-top: 40px;
    }

    .hero__stat-num {
        font-size: 28px;
    }
}

/* ============================================
   АДАПТИВ — 480px
   ============================================ */
@media (max-width: 480px) {
    .hero {
        padding: 76px 0 40px;
        align-items: center;
        min-height: 100svh;
    }

    .hero__inner {
        padding: 0 20px;
        width: 100%;
    }

    .hero__logo {
        width: 100px;
        height: 100px;
    }

    .hero__logo-wrap {
        margin-bottom: 16px;
    }

    .hero__eyebrow {
        font-size: 9px;
        letter-spacing: 1.5px;
        gap: 8px;
        margin-bottom: 16px;
        flex-wrap: wrap;
        text-align: center;
    }

    .hero__eyebrow-line {
        width: 20px;
    }

    .hero__title {
        font-size: 26px;
        letter-spacing: -0.3px;
        margin-bottom: 12px;
        overflow-wrap: break-word;
    }

    .hero__subtitle {
        font-size: 14px;
        margin-bottom: 24px;
        padding: 0 4px;
    }

    .hero__actions {
        flex-direction: column;
        align-items: stretch;
        gap: 10px;
        width: 100%;
    }

    .hero__btn {
        width: 100%;
        justify-content: center;
        font-size: 15px;
        padding: 13px 20px;
    }

    .hero__stats {
        gap: 0;
        margin-top: 28px;
        padding-top: 24px;
        flex-wrap: nowrap;
        justify-content: space-around;
    }

    .hero__stat {
        flex: 1;
    }

    .hero__stat-num {
        font-size: 22px;
    }

    .hero__stat-label {
        font-size: 9px;
        letter-spacing: 0.4px;
    }

    .hero__stat-sep {
        height: 32px;
        flex-shrink: 0;
    }
}

@media (prefers-reduced-motion: reduce) {
    .hero__logo-wrap,
    .hero__content,
    .hero__stats { animation: none; }
    .hero__bg-circle,
    .hero__scroll { animation: none; }
}
</style>
