<template>
    <section class="education">
        <div class="container">
            <div class="education__grid">
                <div class="education__main">
                    <span class="education__tag">ОБРАЗОВАНИЕ</span>
                    <h2 class="education__title">
                        Развивайте свою карьеру<br>
                        в сфере кофе и чая
                    </h2>
                    <p class="education__text">
                        Ассоциация специалистов и производителей кофейной и чайной индустрии предлагает
                        признанные во всем мире образовательные программы для карьерного роста.
                    </p>
                    <VButton @click="goToEducation">Начать обучение</VButton>
                </div>
                <div class="education__media">
                    <video autoplay muted loop playsinline class="education__video">
                        <source src="/videos/education.mp4" type="video/mp4" />
                    </video>
                </div>
            </div>

            <div class="education__stats">
                <div v-for="stat in data.stats" :key="stat.label" class="education__stat">
                    <span class="education__stat-number">{{ stat.number }}</span>
                    <span class="education__stat-label">{{ stat.label }}</span>
                </div>
            </div>

            <div class="education__featured">
                <div class="education__featured-content">
                    <span class="education__featured-badge">НОВОЕ</span>
                    <h3 class="education__featured-title">Master of Specialty Coffee</h3>
                    <p class="education__featured-text">
                        Удостоверение для профессионалов, посвятивших свою карьеру
                        работе во всех сферах кофейной индустрии.
                    </p>
                    <span class="education__featured-highlight">Высшая награда в мире кофе.</span>
                    <a href="#" class="education__featured-link">Узнать больше →</a>
                </div>
            </div>

            <div class="education__programs">
                <h3 class="education__programs-title">Программы для развития навыков</h3>
                <div class="education__programs-grid">
                    <div v-for="program in data.programs" :key="program.title" class="education__program-card">
                        <h4>{{ program.title }}</h4>
                        <p>{{ program.description }}</p>
                        <a :href="program.link" class="education__link">Узнать больше →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import VButton from '@/shared/components/ui/VButton.vue'
import { educationData } from '../constants/educationData'

const data = educationData

const goToEducation = () => {
    window.location.href = '/education'
}
</script>

<style scoped>
.education {
    padding: 80px 0;
    background: var(--color-bg);
    overflow: hidden;
}

.education__grid {
    display: grid;
    grid-template-columns: 1.1fr 1fr;
    gap: 56px;
    align-items: center;
    margin-bottom: 64px;
}

.education__tag {
    display: inline-block;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 2px;
    color: var(--color-primary);
    text-transform: uppercase;
    margin-bottom: 14px;
}

.education__title {
    font-size: 40px;
    font-weight: 700;
    margin: 0 0 18px;
    line-height: 1.12;
    letter-spacing: -0.5px;
}

.education__text {
    font-size: 16px;
    color: var(--color-gray);
    line-height: 1.7;
    max-width: 480px;
    margin: 0 0 28px;
}

.education__media {
    border-radius: var(--radius);
    overflow: hidden;
    background: var(--color-gray-light);
    aspect-ratio: 16/11;
    box-shadow: var(--shadow-lg);
}

.education__video {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

/* ===== СТАТИСТИКА ===== */
.education__stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 64px;
}

.education__stat {
    text-align: center;
    background: white;
    padding: 28px 20px;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    border: 1px solid rgba(0, 0, 0, 0.04);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.education__stat:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-lg);
}

.education__stat-number {
    display: block;
    font-size: 34px;
    font-weight: 700;
    color: var(--color-primary);
    line-height: 1.1;
}

.education__stat-label {
    display: block;
    font-size: 12px;
    color: var(--color-gray);
    font-weight: 600;
    letter-spacing: 0.3px;
    margin-top: 8px;
    line-height: 1.35;
}

/* ===== БЛОК "НОВОЕ" ===== */
.education__featured {
    position: relative;
    background: linear-gradient(135deg, #2D9359 0%, #1F6B3F 50%, #693C26 100%);
    border-radius: var(--radius);
    padding: 56px;
    margin-bottom: 64px;
    color: white;
    overflow: hidden;
}

.education__featured::after {
    content: '';
    position: absolute;
    top: -40%;
    right: -10%;
    width: 360px;
    height: 360px;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.12) 0%, transparent 70%);
    pointer-events: none;
}

.education__featured-content {
    position: relative;
    z-index: 1;
    max-width: 640px;
}

.education__featured-badge {
    display: inline-block;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    padding: 5px 16px;
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 50px;
    margin-bottom: 18px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(4px);
}

.education__featured-title {
    font-size: 30px;
    font-weight: 700;
    margin: 0 0 14px;
    line-height: 1.15;
}

.education__featured-text {
    font-size: 15px;
    opacity: 0.92;
    line-height: 1.65;
    margin: 0 0 14px;
}

.education__featured-highlight {
    display: block;
    font-size: 16px;
    font-weight: 700;
    margin: 0 0 22px;
    color: #fff;
    opacity: 0.95;
}

.education__featured-link {
    display: inline-flex;
    align-items: center;
    color: white;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    padding: 11px 22px;
    border: 1px solid rgba(255, 255, 255, 0.35);
    border-radius: 50px;
    background: rgba(255, 255, 255, 0.08);
    transition: background 0.2s ease, transform 0.2s ease;
}

.education__featured-link:hover {
    background: rgba(255, 255, 255, 0.18);
    transform: translateX(2px);
}

/* ===== ПРОГРАММЫ ===== */
.education__programs-title {
    font-size: 30px;
    font-weight: 700;
    text-align: center;
    margin: 0 0 36px;
    letter-spacing: -0.3px;
}

.education__programs-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
}

.education__program-card {
    display: flex;
    flex-direction: column;
    background: white;
    padding: 30px;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    border: 1px solid rgba(0, 0, 0, 0.04);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.education__program-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
}

.education__program-card h4 {
    font-size: 18px;
    font-weight: 700;
    margin: 0 0 10px;
}

.education__program-card p {
    font-size: 14px;
    color: var(--color-gray);
    line-height: 1.6;
    margin: 0 0 18px;
    flex-grow: 1;
}

.education__link {
    color: var(--color-primary);
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    transition: color 0.2s ease;
}

.education__link:hover {
    color: var(--color-primary-dark);
}

/* ============================================
   RESPONSIVE
   ============================================ */

@media (max-width: 992px) {
    .education { padding: 56px 0; }

    .education__grid {
        grid-template-columns: 1fr;
        gap: 28px;
        margin-bottom: 40px;
    }

    .education__text { max-width: 100%; }

    .education__title { font-size: 34px; }

    .education__stats {
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
        margin-bottom: 40px;
    }

    .education__featured {
        padding: 40px;
        margin-bottom: 40px;
    }

    .education__programs-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .education { padding: 40px 0; }

    .education__title { font-size: 26px; }

    .education__title br { display: none; }

    .education__text {
        font-size: 15px;
        margin-bottom: 20px;
    }

    .education__media { aspect-ratio: 16/9; }

    /* Статистика 2x2 на планшете */
    .education__stats {
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        margin-bottom: 32px;
    }

    .education__stat { padding: 20px 16px; }

    .education__stat-number { font-size: 28px; }

    .education__featured {
        padding: 28px 24px;
        margin-bottom: 32px;
    }

    .education__featured::after {
        width: 200px;
        height: 200px;
    }

    .education__featured-title { font-size: 22px; }

    .education__featured-text { font-size: 14px; }

    .education__programs-title {
        font-size: 22px;
        margin-bottom: 20px;
    }

    /* Программы в 1 колонку */
    .education__programs-grid {
        grid-template-columns: 1fr;
        gap: 14px;
    }

    .education__program-card { padding: 22px; }
}

@media (max-width: 480px) {
    .education { padding: 32px 0; }

    .education__tag {
        font-size: 11px;
        margin-bottom: 10px;
    }

    .education__title { font-size: 22px; }

    .education__text {
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 18px;
    }

    /* Статистика 2x2 компактно */
    .education__stats {
        grid-template-columns: repeat(2, 1fr);
        gap: 8px;
        margin-bottom: 24px;
    }

    .education__stat { padding: 16px 10px; }

    .education__stat-number { font-size: 24px; }

    .education__stat-label {
        font-size: 11px;
        margin-top: 5px;
    }

    .education__featured {
        padding: 22px 18px;
        margin-bottom: 24px;
    }

    .education__featured-badge {
        font-size: 10px;
        padding: 4px 12px;
        margin-bottom: 12px;
    }

    .education__featured-title { font-size: 18px; }

    .education__featured-text {
        font-size: 13px;
        margin-bottom: 10px;
    }

    .education__featured-highlight {
        font-size: 13px;
        margin-bottom: 16px;
    }

    .education__featured-link {
        font-size: 13px;
        padding: 9px 16px;
    }

    .education__programs-title {
        font-size: 20px;
        margin-bottom: 16px;
    }

    .education__program-card { padding: 18px; }

    .education__program-card h4 { font-size: 15px; }

    .education__program-card p {
        font-size: 13px;
        margin-bottom: 12px;
    }
}
</style>
