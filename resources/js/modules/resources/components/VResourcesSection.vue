<template>
    <section class="resources">
        <div class="container">
            <!-- Заголовок -->
            <div class="resources__header">
                <span class="resources__tag">Ресурсы</span>
                <h2 class="resources__title">Мнения представителей мирового сообщества</h2>
                <p class="resources__subtitle">
                    Ассоциация специалистов и производителей кофейной и чайной индустрии занимается исследованиями,<br>
                    разработкой стандартов и инструментов для индустрии.
                </p>
                <a
                :href="data.hero.buttonLink"
                target="_blank"
                rel="noopener noreferrer"
                class="resources__button"
                >
                Начать обучение
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                </a>
            </div>

            <!-- Аккордеон -->
            <div class="resources__accordion">
                <h3 class="resources__accordion-title">Популярные идеи и ресурсы</h3>

                <div class="resources__accordion-list">
                    <div
                        v-for="resource in data.resources"
                        :key="resource.id"
                        class="resources__accordion-item"
                        :class="{ 'is-open': openItem === resource.id }"
                    >
                        <button
                            class="resources__accordion-header"
                            @click="toggleItem(resource.id)"
                        >
                            <span class="resources__accordion-title-text">{{ resource.title }}</span>
                            <span class="resources__accordion-icon">
                                <svg
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <line x1="5" y1="12" x2="19" y2="12"/>
                                    <line
                                        x1="12" y1="5" x2="12" y2="19"
                                        :style="{ opacity: openItem === resource.id ? '0' : '1' }"
                                    />
                                </svg>
                            </span>
                        </button>
                        <div class="resources__accordion-body" v-show="openItem === resource.id">
                            <p class="resources__accordion-description">{{ resource.description }}</p>
                            <p class="resources__accordion-date">{{ resource.date }}</p>
                            <a href="#" class="resources__accordion-link">Читать →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue'
import { resourcesData } from '../constants/resourcesData'

const data = resourcesData
const openItem = ref(null)

const toggleItem = (id) => {
    openItem.value = openItem.value === id ? null : id
}
</script>

<style scoped>
.resources {
    padding: 80px 0;
    background: var(--color-bg);
}

/* ===== HEADER ===== */
.resources__header {
    text-align: center;
    max-width: 800px;
    margin: 0 auto 56px;
}

.resources__tag {
    display: inline-block;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--color-primary);
    padding: 6px 16px;
    background: rgba(45, 147, 89, 0.08);
    border-radius: 50px;
    margin-bottom: 16px;
}

.resources__title {
    font-size: 36px;
    font-weight: 700;
    margin: 0 0 16px;
    color: var(--color-text);
    line-height: 1.15;
    letter-spacing: -0.3px;
}

.resources__subtitle {
    font-size: 16px;
    color: var(--color-gray);
    line-height: 1.7;
    margin: 0 0 28px;
}

.resources__button {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 32px;
    background: var(--color-primary);
    color: white;
    border-radius: 50px;
    font-weight: 700;
    font-size: 15px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.resources__button:hover {
    background: var(--color-primary-dark);
    transform: translateY(-2px);
    gap: 14px;
    box-shadow: var(--shadow-lg);
}

/* ===== ACCORDION ===== */
.resources__accordion-title {
    font-size: 28px;
    font-weight: 700;
    text-align: center;
    margin: 0 0 32px;
    letter-spacing: -0.3px;
}

.resources__accordion-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
    max-width: 900px;
    margin: 0 auto;
}

.resources__accordion-item {
    background: white;
    border-radius: var(--radius);
    overflow: hidden;
    border: 1px solid var(--color-gray-light);
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.resources__accordion-item:hover {
    border-color: var(--color-primary);
}

.resources__accordion-item.is-open {
    border-color: var(--color-primary);
    box-shadow: var(--shadow);
}

.resources__accordion-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    padding: 18px 24px;
    border: none;
    cursor: pointer;
    font-family: var(--font-family);
    font-size: 15px;
    font-weight: 600;
    color: var(--color-text);
    text-align: left;
    transition: color 0.2s ease, background 0.2s ease;
    background: white;
}

.resources__accordion-header:hover {
    color: var(--color-primary);
    background: var(--color-bg);
}

.resources__accordion-item.is-open .resources__accordion-header {
    color: var(--color-primary);
}

.resources__accordion-title-text {
    flex: 1;
    padding-right: 16px;
}

.resources__accordion-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: var(--color-bg);
    color: var(--color-primary);
    transition: all 0.3s ease;
    flex-shrink: 0;
}

.resources__accordion-item.is-open .resources__accordion-icon {
    background: var(--color-primary);
    color: white;
}

.resources__accordion-body {
    padding: 0 24px 20px 24px;
    animation: slideDown 0.25s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-8px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.resources__accordion-description {
    font-size: 14px;
    color: var(--color-gray);
    line-height: 1.6;
    margin: 0 0 6px;
}

.resources__accordion-date {
    font-size: 13px;
    font-weight: 600;
    color: var(--color-primary);
    margin: 0 0 10px;
}

.resources__accordion-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: var(--color-primary);
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    transition: gap 0.2s;
}

.resources__accordion-link:hover {
    gap: 12px;
}

/* ============================================
   RESPONSIVE
   ============================================ */

@media (max-width: 992px) {
    .resources {
        padding: 56px 0;
    }
    .resources__header {
        margin-bottom: 40px;
    }
    .resources__title {
        font-size: 30px;
    }
}

@media (max-width: 768px) {
    .resources {
        padding: 44px 0;
    }
    .resources__header {
        margin-bottom: 32px;
    }
    .resources__title {
        font-size: 26px;
    }
    .resources__subtitle {
        font-size: 15px;
        margin-bottom: 24px;
    }
    /* перенос строки убираем — текст подстраивается под ширину */
    .resources__subtitle br {
        display: none;
    }
    .resources__button {
        padding: 12px 26px;
        font-size: 14px;
    }
    .resources__accordion-title {
        font-size: 22px;
        margin-bottom: 24px;
    }
    .resources__accordion-header {
        padding: 15px 18px;
        font-size: 14px;
    }
    .resources__accordion-body {
        padding: 0 18px 16px;
    }
}

@media (max-width: 480px) {
    .resources {
        padding: 36px 0;
    }
    .resources__header {
        margin-bottom: 28px;
    }
    .resources__tag {
        font-size: 12px;
        padding: 5px 14px;
        margin-bottom: 14px;
    }
    .resources__title {
        font-size: 22px;
        line-height: 1.2;
    }
    .resources__subtitle {
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 22px;
    }
    .resources__button {
        padding: 12px 24px;
        font-size: 14px;
        width: 100%;
        max-width: 280px;
        justify-content: center;
    }
    .resources__accordion-title {
        font-size: 20px;
        margin-bottom: 20px;
    }
    .resources__accordion-list {
        gap: 8px;
    }
    .resources__accordion-header {
        padding: 14px 16px;
        font-size: 14px;
    }
    .resources__accordion-title-text {
        padding-right: 12px;
        line-height: 1.4;
    }
    .resources__accordion-icon {
        width: 26px;
        height: 26px;
    }
    .resources__accordion-body {
        padding: 0 16px 16px;
    }
    .resources__accordion-description {
        font-size: 13px;
    }
}
</style>
