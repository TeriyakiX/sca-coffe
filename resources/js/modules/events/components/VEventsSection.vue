<template>
    <section class="events">
        <div class="container">
            <div class="events__header">
                <span class="events__tag">СОБЫТИЯ</span>
                <h2 class="events__title">Найдите мероприятия по всему миру</h2>
                <p class="events__subtitle">
                    Мероприятия Ассоциации специалистов и производителей кофейной и чайной индустрии включают в себя
                    выставки, чемпионаты и глобальные отраслевые встречи.
                </p>
                <a href="/events" class="events__all-link">Посмотреть мероприятия</a>
            </div>

            <div class="events__featured">
                <div class="events__featured-card">
                    <div class="events__featured-image">
                        <img src="/images/education-hero.jpg" alt="World of Coffee Brussels" />
                    </div>
                    <div class="events__featured-content">
                        <span class="events__featured-badge">ПОПУЛЯРНОЕ</span>
                        <h3 class="events__featured-title">World of Coffee в Брюсселе на этой неделе!</h3>
                        <p class="events__featured-date">25–27 июня</p>
                        <p class="events__featured-text">На этой неделе World of Coffee впервые проходит в Бельгии.</p>
                        <VButton size="small">Узнать больше</VButton>
                    </div>
                </div>
            </div>

            <div class="events__upcoming">
                <h3 class="events__upcoming-title">Предстоящие события по всему миру</h3>
                <div class="events__grid">
                    <div v-for="(event, index) in events" :key="event.id" class="events__card">
                        <div class="events__card-image">
                            <img :src="getEventImage(index)" :alt="event.title" loading="lazy" />
                        </div>
                        <div class="events__card-content">
                            <h4 class="events__card-title">{{ event.title }}</h4>
                            <p class="events__card-date">{{ event.date }}</p>
                            <p class="events__card-location">{{ event.location }}</p>
                            <a href="#" class="events__card-link">Узнать больше →</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="events__stats">
                <div class="events__stat" v-for="stat in stats" :key="stat.label">
                    <span class="events__stat-number">{{ stat.number }}</span>
                    <span class="events__stat-label">{{ stat.label }}</span>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import VButton from '@/shared/components/ui/VButton.vue'

const events = [
    { id: 1, title: 'World of Coffee Панама', date: '23–25 октября 2026', location: 'Панама, Панама' },
    { id: 2, title: 'Чемпионат мира бариста 2026', date: '23–25 октября 2026', location: 'Панама, Панама' },
    { id: 3, title: 'World of Coffee Дубай 2027', date: '26–28 января 2027', location: 'Дубай, ОАЭ' },
    { id: 4, title: 'World of Coffee Новый Орлеан', date: '9–11 апреля 2027', location: 'Новый Орлеан, США' }
]

const getEventImage = (index) => {
    const images = [
        '/images/education-course.jpg',
        '/images/education-learn.jpg',
        '/images/education-hero.jpg',
        '/images/education-course.jpg'
    ]
    return images[index] || '/images/education-hero.jpg'
}

const stats = [
    { number: '50', label: 'Ежегодные посетители' },
    { number: '2000+', label: 'Экспоненты' },
    { number: '50', label: 'Лекции и мастер-классы' },
    { number: '7', label: 'Чемпионаты' },
    { number: '560+', label: 'Сертифицированные судьи' },
    { number: '240+', label: 'Участники' }
]
</script>

<style scoped>
.events {
    padding: 80px 0;
    background: white;
    overflow: hidden;
}

/* ===== HEADER ===== */
.events__header {
    text-align: center;
    max-width: 900px;
    margin: 0 auto 56px;
}

.events__tag {
    display: inline-block;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 2px;
    color: var(--color-primary);
    text-transform: uppercase;
    padding: 4px 16px;
    background: rgba(45, 147, 89, 0.08);
    border-radius: 50px;
    margin-bottom: 12px;
}

.events__title {
    font-size: 36px;
    font-weight: 700;
    margin: 8px 0 12px;
    letter-spacing: -0.3px;
    line-height: 1.15;
}

.events__subtitle {
    font-size: 16px;
    color: var(--color-gray);
    line-height: 1.7;
    margin: 0 0 24px;
}

.events__all-link {
    display: inline-block;
    padding: 12px 32px;
    background: var(--color-primary);
    color: white;
    border-radius: 50px;
    font-weight: 700;
    font-size: 15px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.events__all-link:hover {
    background: var(--color-primary-dark);
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

/* ===== FEATURED ===== */
.events__featured {
    margin-bottom: 56px;
}

.events__featured-card {
    display: grid;
    grid-template-columns: 1fr 1fr;
    background: var(--color-bg);
    border-radius: var(--radius);
    overflow: hidden;
    box-shadow: var(--shadow);
}

.events__featured-image {
    height: 100%;
    min-height: 280px;
    overflow: hidden;
}

.events__featured-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.events__featured-content {
    padding: 40px 48px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.events__featured-badge {
    display: inline-block;
    background: var(--color-primary);
    padding: 4px 16px;
    border-radius: 50px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 12px;
    color: white;
    align-self: flex-start;
}

.events__featured-title {
    font-size: 28px;
    font-weight: 700;
    margin: 0 0 8px;
    line-height: 1.2;
}

.events__featured-date {
    font-size: 16px;
    color: var(--color-gray);
    margin: 0 0 8px;
}

.events__featured-text {
    font-size: 15px;
    color: var(--color-gray);
    margin: 0 0 20px;
}

/* ===== UPCOMING ===== */
.events__upcoming-title {
    font-size: 26px;
    font-weight: 700;
    margin: 0 0 32px;
    text-align: center;
    letter-spacing: -0.3px;
}

.events__grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
    margin-bottom: 56px;
}

.events__card {
    background: white;
    border-radius: var(--radius);
    overflow: hidden;
    box-shadow: var(--shadow);
    border: 1px solid rgba(0, 0, 0, 0.04);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.events__card:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow-lg);
}

.events__card-image {
    height: 200px;
    overflow: hidden;
    background: var(--color-gray-light);
}

.events__card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.events__card:hover .events__card-image img {
    transform: scale(1.06);
}

.events__card-content {
    padding: 18px 20px 20px;
}

.events__card-title {
    font-size: 16px;
    font-weight: 700;
    margin: 0 0 4px;
}

.events__card-date {
    font-size: 13px;
    color: var(--color-primary);
    font-weight: 600;
    margin: 0;
}

.events__card-location {
    font-size: 13px;
    color: var(--color-gray);
    margin: 4px 0 12px;
}

.events__card-link {
    color: var(--color-primary);
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    display: inline-block;
    transition: transform 0.2s ease;
}

.events__card-link:hover {
    transform: translateX(4px);
}

/* ===== STATS ===== */
.events__stats {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 20px;
    padding: 40px 0 0;
    border-top: 2px solid var(--color-gray-light);
}

.events__stat {
    text-align: center;
}

.events__stat-number {
    display: block;
    font-size: 32px;
    font-weight: 700;
    color: var(--color-primary);
    line-height: 1.2;
}

.events__stat-label {
    display: block;
    font-size: 12px;
    color: var(--color-gray);
    font-weight: 600;
    margin-top: 4px;
    line-height: 1.35;
}

/* ============================================
   АДАПТИВ
   ============================================ */

@media (max-width: 992px) {
    .events { padding: 56px 0; }

    .events__title { font-size: 30px; }

    .events__featured-card { grid-template-columns: 1fr; }
    .events__featured-image { min-height: 220px; }
    .events__featured-content { padding: 28px 32px; }
    .events__featured-title { font-size: 24px; }

    .events__stats { grid-template-columns: repeat(3, 1fr); gap: 16px; }
}

@media (max-width: 768px) {
    .events { padding: 44px 0; }

    .events__header { margin-bottom: 36px; }
    .events__title { font-size: 26px; }
    .events__subtitle { font-size: 15px; }

    .events__all-link {
        display: block;
        max-width: 280px;
        margin: 0 auto;
        text-align: center;
        padding: 12px 24px;
        font-size: 14px;
    }

    .events__featured { margin-bottom: 36px; }
    .events__featured-image { min-height: 180px; }
    .events__featured-content { padding: 22px 24px; }
    .events__featured-title { font-size: 20px; }
    .events__featured-text { font-size: 14px; }

    .events__upcoming-title { font-size: 22px; margin-bottom: 20px; }

    .events__grid { gap: 16px; margin-bottom: 36px; }
    .events__card-image { height: 150px; }
    .events__card-content { padding: 14px 16px 16px; }
    .events__card-title { font-size: 14px; }
    .events__card-date, .events__card-location { font-size: 12px; }

    .events__stats {
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
        padding-top: 28px;
    }
    .events__stat-number { font-size: 26px; }
    .events__stat-label { font-size: 11px; }
}

@media (max-width: 480px) {
    .events { padding: 36px 0; }

    .events__tag { font-size: 11px; }
    .events__title { font-size: 22px; }
    .events__subtitle { font-size: 14px; }

    .events__featured-image { min-height: 160px; }
    .events__featured-content { padding: 18px; }
    .events__featured-title { font-size: 18px; }

    .events__upcoming-title { font-size: 20px; }

    .events__grid { gap: 12px; margin-bottom: 28px; }
    .events__card-image { height: 120px; }
    .events__card-content { padding: 10px 12px 14px; }
    .events__card-title { font-size: 13px; }
    .events__card-date, .events__card-location { font-size: 11px; }
    .events__card-link { font-size: 12px; }

    .events__stats {
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        padding-top: 20px;
    }
    .events__stat-number { font-size: 22px; }
    .events__stat-label { font-size: 10px; }
}
</style>
