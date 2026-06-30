<template>
    <MainLayout>
        <div class="edu">

            <!-- HERO -->
            <div class="edu__hero">
                <div class="container edu__hero-inner">
                    <nav class="edu__breadcrumbs">
                        <a href="/" class="edu__bc-link">Главная</a>
                        <span class="edu__bc-sep">•</span>
                        <span class="edu__bc-current">Образование</span>
                    </nav>
                    <div class="edu__hero-body">
                        <div class="edu__hero-text">
                            <div class="edu__eyebrow">
                                <span class="edu__eyebrow-line"></span>
                                {{ data.hero.tag }}
                            </div>
                            <h1 class="edu__title">{{ data.hero.title }}</h1>
                            <p class="edu__subtitle">{{ data.hero.subtitle }}</p>
                            <a href="#programs" class="edu__hero-btn" @click.prevent="scrollToPrograms">
                                {{ data.hero.buttonText }}
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14M12 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                        <div class="edu__hero-img-wrap">
                            <img src="/images/education-hero.jpg" alt="Образование" class="edu__hero-img" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="container edu__body">

                <!-- Статистика -->
                <section class="edu__stats">
                    <div v-for="stat in data.stats" :key="stat.label" class="edu__stat">
                        <span class="edu__stat-num">{{ stat.number }}</span>
                        <span class="edu__stat-label">{{ stat.label }}</span>
                    </div>
                </section>

                <!-- Featured — Master -->
                <section class="edu__featured">
                    <div class="edu__featured-inner">
                        <span class="edu__featured-badge">{{ data.featured.badge }}</span>
                        <h2 class="edu__featured-title">{{ data.featured.title }}</h2>
                        <p class="edu__featured-text">{{ data.featured.description }}</p>
                        <p class="edu__featured-highlight">{{ data.featured.highlight }}</p>
                        <button class="edu__featured-btn" @click="goToMaster">
                            {{ data.featured.buttonText }}
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14M12 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                </section>

                <!-- Программы -->
                <section id="programs" class="edu__programs">
                    <h2 class="edu__programs-title">Другие программы</h2>
                    <p class="edu__programs-sub">Развивайте навыки с нашими образовательными программами</p>
                    <div class="edu__programs-grid">
                        <a
                            v-for="program in data.programs"
                            :key="program.title"
                            :href="program.link"
                            class="edu__program-card"
                        >
                            <h3 class="edu__program-title">{{ program.title }}</h3>
                            <p class="edu__program-text">{{ program.description }}</p>
                            <span class="edu__program-link">
                                Узнать больше
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14M12 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </a>
                    </div>
                </section>

            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { router } from '@inertiajs/vue3'
import MainLayout from '@/app/layouts/MainLayout.vue'
import { educationData } from '../constants/educationData'

const data = educationData

const scrollToPrograms = () => {
    document.getElementById('programs')?.scrollIntoView({ behavior: 'smooth' })
}

const goToMaster = () => router.get('/master')
</script>

<style scoped>
.edu {
    background: var(--color-bg);
    padding-bottom: 0;
}

/* ============================================
   HERO
   ============================================ */
.edu__hero {
    background: linear-gradient(135deg, #2D9359 0%, #1F6B3F 50%, #693C26 100%);
    padding: 100px 0 48px;
    position: relative;
    overflow: hidden;
}

.edu__hero::after {
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

.edu__hero::before {
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

.edu__hero-inner { position: relative; z-index: 1; }

.edu__breadcrumbs {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    margin-bottom: 32px;
}

.edu__bc-link {
    color: rgba(255,255,255,0.75);
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s;
}
.edu__bc-link:hover { color: #fff; }
.edu__bc-sep { color: rgba(255,255,255,0.4); font-size: 11px; }
.edu__bc-current { color: rgba(255,255,255,0.85); }

.edu__hero-body {
    display: flex;
    align-items: center;
    gap: 48px;
    justify-content: space-between;
}

.edu__hero-text { flex: 1; }

.edu__eyebrow {
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

.edu__eyebrow-line {
    display: block;
    width: 28px;
    height: 1px;
    background: rgba(255,255,255,0.4);
}

.edu__title {
    font-size: 48px;
    font-weight: 800;
    color: #fff;
    margin: 0 0 16px;
    letter-spacing: -1px;
    line-height: 1.08;
}

.edu__subtitle {
    font-size: 17px;
    line-height: 1.65;
    color: rgba(255,255,255,0.75);
    max-width: 480px;
    margin: 0 0 32px;
}

.edu__hero-btn {
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
.edu__hero-btn:hover {
    background: #FFEDCD;
    border-color: #FFEDCD;
    transform: translateY(-2px);
}
.edu__hero-btn svg { transition: transform 0.2s; }
.edu__hero-btn:hover svg { transform: translateX(4px); }

/* Фото в hero */
.edu__hero-img-wrap {
    flex-shrink: 0;
    width: 340px;
    height: 240px;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 24px 60px rgba(0,0,0,0.25);
    border: 4px solid rgba(255,255,255,0.15);
}

.edu__hero-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* ============================================
   BODY
   ============================================ */
.edu__body {
    padding-top: 56px;
    padding-bottom: 80px;
    display: flex;
    flex-direction: column;
    gap: 0;
}

/* ============================================
   СТАТИСТИКА
   ============================================ */
.edu__stats {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 12px;
    margin-bottom: 56px;
}

.edu__stat {
    background: #fff;
    border-radius: 12px;
    padding: 20px 16px;
    text-align: center;
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
    display: flex;
    flex-direction: column;
    gap: 6px;
    transition: transform 0.2s, box-shadow 0.2s;
}

.edu__stat:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(45,147,89,0.1);
}

.edu__stat-num {
    font-size: 28px;
    font-weight: 800;
    color: #2D9359;
    letter-spacing: -1px;
    line-height: 1;
}

.edu__stat-label {
    font-size: 11px;
    font-weight: 600;
    color: rgba(51,51,51,0.5);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    line-height: 1.4;
}

/* ============================================
   FEATURED
   ============================================ */
.edu__featured {
    margin-bottom: 56px;
}

.edu__featured-inner {
    background: linear-gradient(135deg, #2D9359 0%, #1F6B3F 50%, #693C26 100%);
    border-radius: 20px;
    padding: 56px 48px;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.edu__featured-inner::before {
    content: '';
    position: absolute;
    right: -60px;
    top: -60px;
    width: 280px;
    height: 280px;
    border-radius: 50%;
    background: rgba(255,255,255,0.04);
    pointer-events: none;
}

.edu__featured-badge {
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

.edu__featured-title {
    font-size: 32px;
    font-weight: 800;
    color: #fff;
    margin: 0 0 14px;
    letter-spacing: -0.5px;
}

.edu__featured-text {
    font-size: 16px;
    color: rgba(255,255,255,0.8);
    line-height: 1.65;
    max-width: 640px;
    margin: 0 auto 10px;
}

.edu__featured-highlight {
    font-size: 17px;
    font-weight: 700;
    color: #FFEDCD;
    margin: 0 0 28px;
}

.edu__featured-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 15px;
    font-weight: 700;
    color: #2D9359;
    background: #fff;
    border: 2px solid #fff;
    border-radius: 50px;
    padding: 13px 30px;
    cursor: pointer;
    font-family: var(--font-family);
    transition: all 0.25s ease;
    box-shadow: 0 8px 24px rgba(0,0,0,0.15);
}
.edu__featured-btn:hover {
    background: #FFEDCD;
    border-color: #FFEDCD;
    transform: translateY(-2px);
}
.edu__featured-btn svg { transition: transform 0.2s; }
.edu__featured-btn:hover svg { transform: translateX(4px); }

/* ============================================
   ПРОГРАММЫ
   ============================================ */
.edu__programs-title {
    font-size: 28px;
    font-weight: 800;
    color: #333;
    margin: 0 0 8px;
    letter-spacing: -0.3px;
}

.edu__programs-sub {
    font-size: 16px;
    color: rgba(51,51,51,0.55);
    margin: 0 0 28px;
}

.edu__programs-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
}

.edu__program-card {
    background: #fff;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
    border: 1px solid rgba(105,60,38,0.07);
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: column;
    transition: transform 0.2s, box-shadow 0.2s;
}

.edu__program-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 28px rgba(45,147,89,0.1);
}

.edu__program-title {
    font-size: 16px;
    font-weight: 700;
    color: #333;
    margin: 0 0 8px;
    line-height: 1.35;
}

.edu__program-text {
    font-size: 13px;
    color: rgba(51,51,51,0.6);
    line-height: 1.6;
    margin: 0 0 16px;
    flex: 1;
}

.edu__program-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    font-weight: 700;
    color: #2D9359;
    margin-top: auto;
}

.edu__program-link svg { transition: transform 0.2s; }
.edu__program-card:hover .edu__program-link svg { transform: translateX(3px); }

/* ============================================
   АДАПТИВ — 1024px
   ============================================ */
@media (max-width: 1024px) {
    .edu__stats { grid-template-columns: repeat(3, 1fr); }
    .edu__hero-img-wrap { width: 280px; height: 200px; }
    .edu__title { font-size: 40px; }
}

/* ============================================
   АДАПТИВ — 768px
   ============================================ */
@media (max-width: 768px) {
    .edu__hero { padding: 90px 0 36px; }
    .edu__hero-body { flex-direction: column; gap: 28px; }
    .edu__hero-img-wrap { width: 100%; height: 200px; }
    .edu__title { font-size: 32px; }
    .edu__subtitle { font-size: 15px; }

    .edu__body { padding-top: 36px; padding-bottom: 48px; }

    .edu__stats { grid-template-columns: repeat(3, 1fr); gap: 10px; margin-bottom: 36px; }
    .edu__stat-num { font-size: 22px; }

    .edu__featured-inner { padding: 36px 24px; }
    .edu__featured-title { font-size: 24px; }
    .edu__featured-text { font-size: 14px; }

    .edu__programs-grid { grid-template-columns: 1fr 1fr; }
}

/* ============================================
   АДАПТИВ — 480px
   ============================================ */
@media (max-width: 480px) {
    .edu__hero { padding: 80px 0 28px; }
    .edu__title { font-size: 26px; letter-spacing: -0.3px; }
    .edu__subtitle { font-size: 14px; margin-bottom: 24px; }
    .edu__hero-btn { width: 100%; justify-content: center; }
    .edu__hero-img-wrap { height: 180px; border-radius: 12px; }

    .edu__stats { grid-template-columns: repeat(2, 1fr); gap: 8px; margin-bottom: 28px; }
    .edu__stat { padding: 14px 10px; }
    .edu__stat-num { font-size: 20px; }
    .edu__stat-label { font-size: 10px; }

    .edu__featured-inner { padding: 28px 16px; border-radius: 14px; }
    .edu__featured-title { font-size: 20px; }
    .edu__featured-highlight { font-size: 14px; }
    .edu__featured-btn { width: 100%; justify-content: center; }

    .edu__programs-grid { grid-template-columns: 1fr; }
    .edu__programs-title { font-size: 22px; }
}
</style>
