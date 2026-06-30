<template>
    <footer class="footer">
        <div class="container">
            <div class="footer__grid">

                <!-- Колонка 1: Сведения об образовательной организации -->
                <div class="footer__col">
                    <button class="footer__col-title" @click="toggle(0)" :class="{ 'is-open': open[0] }">
                        <span>Сведения об образовательной организации</span>
                        <svg class="footer__col-caret" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <transition name="footer-accordion">
                        <ul class="footer__col-links" v-show="open[0] || !isMobile">
                            <li><a href="/page/about"      class="footer__link">Основные сведения</a></li>
                            <li><a href="/page/structure"  class="footer__link">Структура и органы управления</a></li>
                            <li><a href="/page/documents"  class="footer__link">Документы</a></li>
                            <li><a href="/page/education"  class="footer__link">Образование</a></li>
                            <li><a href="/page/standards"  class="footer__link">Образовательные стандарты</a></li>
                        </ul>
                    </transition>
                </div>

                <!-- Колонка 2: Руководство -->
                <div class="footer__col">
                    <button class="footer__col-title" @click="toggle(1)" :class="{ 'is-open': open[1] }">
                        <span>Руководство</span>
                        <svg class="footer__col-caret" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <transition name="footer-accordion">
                        <ul class="footer__col-links" v-show="open[1] || !isMobile">
                            <li><a href="/page/management"         class="footer__link">Руководство. Педагогический состав</a></li>
                            <li><a href="/page/material-technical" class="footer__link">Материально-техническое обеспечение</a></li>
                            <li><a href="/page/career-center"      class="footer__link">Центр карьеры и оценки</a></li>
                        </ul>
                    </transition>
                </div>

                <!-- Колонка 3: Услуги и поддержка -->
                <div class="footer__col">
                    <button class="footer__col-title" @click="toggle(2)" :class="{ 'is-open': open[2] }">
                        <span>Услуги и поддержка</span>
                        <svg class="footer__col-caret" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <transition name="footer-accordion">
                        <ul class="footer__col-links" v-show="open[2] || !isMobile">
                            <li><a href="/page/scholarships"  class="footer__link">Стипендии и поддержка</a></li>
                            <li><a href="/page/paid-services" class="footer__link">Платные образовательные услуги</a></li>
                            <li><a href="/page/finance"       class="footer__link">Финансово-хозяйственная деятельность</a></li>
                        </ul>
                    </transition>
                </div>

                <!-- Колонка 4: Контакты -->
                <div class="footer__col">
                    <button class="footer__col-title" @click="toggle(3)" :class="{ 'is-open': open[3] }">
                        <span>Контакты</span>
                        <svg class="footer__col-caret" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <transition name="footer-accordion">
                        <ul class="footer__col-links" v-show="open[3] || !isMobile">
                            <li><a href="/page/vacancies"  class="footer__link">Вакантные места</a></li>
                            <li><a href="/page/nutrition"  class="footer__link">Организация питания</a></li>
                        </ul>
                    </transition>
                </div>

            </div>

            <div class="footer__bottom">
                <p class="footer__copyright">
                    © 2024 Ассоциация специалистов и производителей кофейной и чайной индустрии.
                </p>
            </div>
        </div>
    </footer>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

// Состояния аккордеона: 4 колонки, все закрыты по умолчанию
const open = ref([false, false, false, false])
const isMobile = ref(false)

const toggle = (i) => {
    if (!isMobile.value) return
    open.value[i] = !open.value[i]
}

const checkMobile = () => {
    isMobile.value = window.innerWidth <= 768
}

onMounted(() => {
    checkMobile()
    window.addEventListener('resize', checkMobile)
})

onUnmounted(() => {
    window.removeEventListener('resize', checkMobile)
})
</script>

<style scoped>
.footer {
    background: #1a1a1a;
    color: #fff;
    padding: 48px 0 24px;
    margin-top: 60px;
    overflow: hidden;
}

.footer__grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 40px;
    padding-bottom: 32px;
}

/* ============================================
   ЗАГОЛОВОК КОЛОНКИ
   ============================================ */
.footer__col-title {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 8px;
    width: 100%;
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin: 0 0 16px;
    color: #fff;
    background: none;
    border: none;
    padding: 0;
    cursor: default;
    text-align: left;
    font-family: inherit;
    line-height: 1.3;
}

.footer__col-caret {
    flex-shrink: 0;
    margin-top: 2px;
    opacity: 0;
    transition: transform 0.28s ease;
}

.footer__col-title.is-open .footer__col-caret {
    transform: rotate(180deg);
}

/* ============================================
   ССЫЛКИ
   ============================================ */
.footer__col-links {
    list-style: none;
    padding: 0;
    margin: 0;
    overflow: hidden;
}

.footer__col-links li {
    margin-bottom: 8px;
}

.footer__link {
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
    font-size: 13px;
    transition: color 0.2s;
    line-height: 1.4;
    display: block;
}

.footer__link:hover {
    color: #fff;
}

/* ============================================
   АККОРДЕОН АНИМАЦИЯ
   ============================================ */
.footer-accordion-enter-active,
.footer-accordion-leave-active {
    transition: max-height 0.32s ease, opacity 0.28s ease;
    max-height: 400px;
}

.footer-accordion-enter-from,
.footer-accordion-leave-to {
    max-height: 0 !important;
    opacity: 0;
}

/* ============================================
   НИЗ ФУТЕРА
   ============================================ */
.footer__bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
    padding-top: 24px;
}

.footer__copyright {
    font-size: 13px;
    color: rgba(255, 255, 255, 0.5);
    margin: 0;
}

/* ============================================
   АДАПТИВ — 1024px
   ============================================ */
@media (max-width: 1024px) {
    .footer { padding: 40px 0 20px; }
    .footer__grid { gap: 30px; }
}

/* ============================================
   АДАПТИВ — 768px (аккордеон включается)
   ============================================ */
@media (max-width: 768px) {
    .footer {
        padding: 36px 0 20px;
        margin-top: 40px;
    }

    .footer__grid {
        grid-template-columns: 1fr;
        gap: 0;
        padding-bottom: 8px;
    }

    .footer__col {
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    /* на мобилке заголовок колонки становится кликабельным */
    .footer__col-title {
        cursor: pointer;
        padding: 16px 0;
        margin-bottom: 0;
        font-size: 13px;
        align-items: center;
    }

    .footer__col-caret {
        opacity: 1; /* показываем каретку */
    }

    .footer__col-links {
        padding-bottom: 8px;
    }

    .footer__col-links li {
        margin-bottom: 10px;
    }

    .footer__link {
        font-size: 13px;
    }

    .footer__bottom {
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 10px;
        padding-top: 20px;
    }

    .footer__copyright {
        font-size: 12px;
        text-align: center;
    }
}

@media (max-width: 480px) {
    .footer {
        padding: 32px 0 16px;
        margin-top: 30px;
    }

    .footer__col-title {
        font-size: 12px;
        padding: 14px 0;
    }

    .footer__link {
        font-size: 12px;
    }

    .footer__bottom {
        padding-top: 16px;
    }

    .footer__copyright {
        font-size: 11px;
    }
}
</style>
