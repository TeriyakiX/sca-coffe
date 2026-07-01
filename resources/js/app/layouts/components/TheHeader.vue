<template>
    <header class="header" :class="{ 'header--scrolled': isScrolled }">
        <div class="container header__inner">
            <!-- Логотип -->
            <div class="header__brand">
                <a href="/" class="brand">
                    <img
                        src="/images/logo.png"
                        alt="Ассоциация специалистов и производителей кофейной и чайной индустрии"
                        class="brand__logo"
                        v-if="logoLoaded"
                        @error="logoLoaded = false"
                    />
                    <span v-else class="brand__logo-text">☕</span>
                    <div class="brand__info">
                        <span class="brand__subtitle">
                            Ассоциация специалистов и производителей<br>
                            кофейной и чайной индустрии
                        </span>
                    </div>
                </a>
            </div>

            <!-- Навигация -->
            <nav class="header__nav">
                <a href="#education" class="nav-link" @click.prevent="scrollTo('education')">Образование</a>
                <a href="#business" class="nav-link" @click.prevent="scrollTo('business')">Бизнес</a>
                <a href="#events" class="nav-link" @click.prevent="scrollTo('events')">События</a>
                <a href="#resources" class="nav-link" @click.prevent="scrollTo('resources')">Ресурсы</a>
                <a href="#membership" class="nav-link" @click.prevent="scrollTo('membership')">Членство</a>
                <a href="/about" class="nav-link">О нас</a>

                <!-- Дропдаун: Сведения об образовательной организации -->
                <div class="nav-dropdown" @mouseenter="openDropdown" @mouseleave="closeDropdown">
                    <a href="/info" class="nav-link nav-link--dropdown" :class="{ 'is-open': isDropdownOpen }">
                        Сведения об организации
                        <svg class="nav-link__caret" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </a>

                    <transition name="dropdown-menu">
                        <div v-if="isDropdownOpen" class="nav-dropdown__menu">
                            <!-- ссылка на индекс-страницу -->
                            <a href="/info" class="nav-dropdown__item nav-dropdown__item--all">
                                Все разделы →
                            </a>
                            <div class="nav-dropdown__divider"></div>
                            <a
                                v-for="item in infoPages"
                                :key="item.slug"
                                :href="`/page/${item.slug}`"
                                class="nav-dropdown__item"
                            >
                                {{ item.label }}
                            </a>
                        </div>
                    </transition>
                </div>
            </nav>

            <!-- Кнопки -->
            <div class="header__actions">
                <a href="/login" class="nav-link">Войти</a>
                <VButton size="small" variant="primary">Регистрация</VButton>
            </div>

            <!-- Бургер -->
            <button class="header__burger" :class="{ 'is-active': isMenuOpen }" @click="toggleMenu" aria-label="Меню">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

        <!-- Затемнение фона -->
        <transition name="fade">
            <div v-if="isMenuOpen" class="header__backdrop" @click="closeMenu"></div>
        </transition>

        <!-- Мобильное меню (дропдаун) -->
        <transition name="dropdown">
            <div v-if="isMenuOpen" class="header__mobile">
                <nav class="header__mobile-nav">
                    <a
                        v-for="(item, i) in menuItems"
                        :key="item.id"
                        :href="item.href || `#${item.id}`"
                        class="mobile-link"
                        :style="{ '--i': i }"
                        @click="(event) => item.href ? closeMenu() : (event.preventDefault(), scrollTo(item.id))"
                    >
                        <span>{{ item.label }}</span>
                        <svg class="mobile-link__arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </a>

                    <!-- Аккордеон: Сведения об организации -->
                    <div class="mobile-accordion" :style="{ '--i': menuItems.length }">
                        <button
                            class="mobile-link mobile-accordion__toggle"
                            :class="{ 'is-open': isMobileInfoOpen }"
                            @click="isMobileInfoOpen = !isMobileInfoOpen"
                        >
                            <span>Сведения об организации</span>
                            <svg
                                class="mobile-link__arrow mobile-accordion__caret"
                                :class="{ 'is-rotated': isMobileInfoOpen }"
                                width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            >
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>

                        <transition name="accordion">
                            <div v-if="isMobileInfoOpen" class="mobile-accordion__body">
                                <a
                                    href="/info"
                                    class="mobile-accordion__item mobile-accordion__item--all"
                                    @click="closeMenu"
                                >
                                    Все разделы →
                                </a>
                                <div class="mobile-accordion__divider"></div>
                                <a
                                    v-for="item in infoPages"
                                    :key="item.slug"
                                    :href="`/page/${item.slug}`"
                                    class="mobile-accordion__item"
                                    @click="closeMenu"
                                >
                                    {{ item.label }}
                                </a>
                            </div>
                        </transition>
                    </div>
                </nav>
            </div>
        </transition>
    </header>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import VButton from '@/shared/components/ui/VButton.vue'

const logoLoaded = ref(true)
const isMenuOpen = ref(false)
const isScrolled = ref(false)
const isDropdownOpen = ref(false)
const isMobileInfoOpen = ref(false)

let dropdownTimer = null

const infoPages = [
    { slug: 'about',              label: 'Основные сведения' },
    { slug: 'structure',          label: 'Структура и органы управления' },
    { slug: 'documents',          label: 'Документы' },
    { slug: 'education',          label: 'Образование' },
    { slug: 'standards',          label: 'Образовательные стандарты' },
    { slug: 'management',         label: 'Руководство. Педагогический состав' },
    { slug: 'material-technical', label: 'Материально-техническое обеспечение' },
    { slug: 'career-center',      label: 'Центр карьеры и оценки' },
    { slug: 'scholarships',       label: 'Стипендии и материальная поддержка' },
    { slug: 'paid-services',      label: 'Платные образовательные услуги' },
    { slug: 'finance',            label: 'Финансово-хозяйственная деятельность' },
    { slug: 'vacancies',          label: 'Вакантные места для приема' },
    { slug: 'nutrition',          label: 'Организация питания' },
]

const menuItems = [
    { id: 'education',  label: 'Образование' },
    { id: 'business',   label: 'Бизнес' },
    { id: 'events',     label: 'События' },
    { id: 'resources',  label: 'Ресурсы' },
    { id: 'membership', label: 'Членство' },
    { id: 'about',      label: 'О нас',  href: '/about' },
]

const openDropdown = () => {
    clearTimeout(dropdownTimer)
    isDropdownOpen.value = true
}

const closeDropdown = () => {
    dropdownTimer = setTimeout(() => {
        isDropdownOpen.value = false
    }, 120)
}

const scrollTo = (id) => {
    const el = document.getElementById(id)
    if (el) {
        const top = el.getBoundingClientRect().top + window.pageYOffset - 80
        window.scrollTo({ top, behavior: 'smooth' })
        closeMenu()
    } else {
        window.location.href = `/#${id}`
    }
}

const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value
    document.body.style.overflow = isMenuOpen.value ? 'hidden' : ''
}

const closeMenu = () => {
    isMenuOpen.value = false
    isMobileInfoOpen.value = false
    document.body.style.overflow = ''
}

const handleScroll = () => {
    isScrolled.value = window.scrollY > 20
}

onMounted(() => window.addEventListener('scroll', handleScroll))
onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll)
    document.body.style.overflow = ''
})
</script>

<style scoped>
.header {
    background: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-bottom: 1px solid rgba(0, 0, 0, 0.06);
    padding: 12px 0;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    transition: box-shadow 0.3s ease, background 0.3s ease;
}

.header--scrolled {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.header__inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}

/* ===== BRAND ===== */
.header__brand { flex-shrink: 0; }

.brand {
    display: flex;
    align-items: center;
    gap: 14px;
    text-decoration: none;
}

.brand__logo { height: 44px; width: auto; object-fit: contain; }
.brand__logo-text { font-size: 32px; }

.brand__info {
    display: flex;
    flex-direction: column;
    line-height: 1.2;
    padding-left: 14px;
    border-left: 2px solid var(--color-primary);
}

.brand__subtitle {
    font-size: 12px;
    font-weight: 500;
    color: var(--color-text);
    letter-spacing: 0.2px;
    line-height: 1.3;
}

/* ===== NAV ===== */
.header__nav {
    display: flex;
    gap: 28px;
    align-items: center;
}

.nav-link {
    font-size: 14px;
    font-weight: 500;
    color: var(--color-text);
    text-decoration: none;
    padding: 6px 0;
    border-bottom: 2px solid transparent;
    transition: all 0.25s ease;
    cursor: pointer;
    background: none;
    border-left: none;
    border-right: none;
    border-top: none;
    font-family: var(--font-family);
    white-space: nowrap;
}

.nav-link:hover,
.nav-link--dropdown:hover,
.nav-link--dropdown.is-open {
    color: var(--color-primary);
    border-bottom-color: var(--color-primary);
}

.nav-link--dropdown {
    display: flex;
    align-items: center;
    gap: 5px;
    white-space: nowrap;
}

.nav-link__caret {
    transition: transform 0.25s ease;
    flex-shrink: 0;
    margin-top: 1px;
}

.nav-link--dropdown.is-open .nav-link__caret {
    transform: rotate(180deg);
}

/* ===== DROPDOWN MENU ===== */
.nav-dropdown {
    position: relative;
}

.nav-dropdown__menu {
    position: absolute;
    top: calc(100% + 14px);
    left: 50%;
    transform: translateX(-50%);
    min-width: 300px;
    background: #fff;
    border: 1px solid rgba(0, 0, 0, 0.07);
    border-radius: 14px;
    box-shadow: 0 16px 48px rgba(0, 0, 0, 0.14), 0 4px 12px rgba(0, 0, 0, 0.06);
    padding: 6px;
    z-index: 1001;
    /* выравниваем правый край по правому краю страницы если вылезает */
}

.nav-dropdown__item {
    display: block;
    padding: 10px 14px;
    font-size: 13.5px;
    font-weight: 500;
    color: var(--color-text);
    text-decoration: none;
    border-radius: 8px;
    transition: background 0.18s ease, color 0.18s ease;
    line-height: 1.4;
}

.nav-dropdown__item:hover {
    background: rgba(45, 147, 89, 0.08);
    color: var(--color-primary);
}

.nav-dropdown__item--all {
    font-size: 12px;
    font-weight: 700;
    color: var(--color-primary);
    text-transform: uppercase;
    letter-spacing: 0.4px;
    padding: 8px 14px;
}

.nav-dropdown__divider {
    height: 1px;
    background: rgba(0, 0, 0, 0.07);
    margin: 4px 8px;
}

/* стрелочка-хвостик */
.nav-dropdown__menu::before {
    content: '';
    position: absolute;
    top: -7px;
    left: 50%;
    transform: translateX(-50%) rotate(45deg);
    width: 14px;
    height: 14px;
    background: #fff;
    border-left: 1px solid rgba(0, 0, 0, 0.07);
    border-top: 1px solid rgba(0, 0, 0, 0.07);
    border-radius: 3px 0 0 0;
}

/* transition */
.dropdown-menu-enter-active {
    transition: transform 0.28s cubic-bezier(0.22, 1, 0.36, 1), opacity 0.28s ease;
}
.dropdown-menu-leave-active {
    transition: transform 0.18s ease, opacity 0.18s ease;
}
.dropdown-menu-enter-from,
.dropdown-menu-leave-to {
    transform: translateX(-50%) translateY(-8px);
    opacity: 0;
}

/* ===== ACTIONS ===== */
.header__actions {
    display: flex;
    gap: 12px;
    flex-shrink: 0;
    align-items: center;
}

.header__actions .nav-link {
    border-bottom: none;
}

.header__actions .nav-link:hover {
    border-bottom: none;
    color: var(--color-primary);
}

/* ===== BURGER ===== */
.header__burger {
    display: none;
    flex-direction: column;
    gap: 5px;
    background: none;
    border: none;
    cursor: pointer;
    padding: 4px;
    z-index: 1002;
}

.header__burger span {
    display: block;
    width: 24px;
    height: 2px;
    background: var(--color-text);
    border-radius: 2px;
    transition: transform 0.3s ease, opacity 0.3s ease;
}

.header__burger.is-active span:nth-child(1) { transform: rotate(45deg) translate(5px, 5px); }
.header__burger.is-active span:nth-child(2) { opacity: 0; }
.header__burger.is-active span:nth-child(3) { transform: rotate(-45deg) translate(5px, -5px); }

/* ===== BACKDROP ===== */
.header__backdrop {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100vh;
    background: rgba(0, 0, 0, 0.45);
    backdrop-filter: blur(3px);
    -webkit-backdrop-filter: blur(3px);
    z-index: 998;
}

/* ===== MOBILE MENU ===== */
.header__mobile {
    position: absolute;
    top: calc(100% + 14px);
    left: 12px;
    right: 12px;
    background: #fff;
    border: 1px solid rgba(0, 0, 0, 0.04);
    border-radius: 18px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.22), 0 4px 12px rgba(0, 0, 0, 0.08);
    padding: 8px;
    z-index: 999;
    display: none;
}

.header__mobile::before {
    content: '';
    position: absolute;
    top: -8px; right: 22px;
    width: 16px; height: 16px;
    background: #fff;
    border-left: 1px solid rgba(0, 0, 0, 0.04);
    border-top: 1px solid rgba(0, 0, 0, 0.04);
    transform: rotate(45deg);
    border-radius: 3px 0 0 0;
}

.header__mobile-nav {
    display: flex;
    flex-direction: column;
    position: relative;
    z-index: 1;
}

.mobile-link {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 16px;
    font-weight: 600;
    color: var(--color-text);
    text-decoration: none;
    padding: 15px 14px;
    border-radius: 12px;
    cursor: pointer;
    transition: background 0.2s ease, color 0.2s ease;
    background: none;
    border: none;
    font-family: var(--font-family);
    width: 100%;
    text-align: left;
    opacity: 0;
    animation: linkIn 0.4s ease forwards;
    animation-delay: calc(0.05s * var(--i) + 0.08s);
}

.mobile-link:not(:last-child),
.mobile-accordion:not(:last-child) .mobile-accordion__toggle {
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    border-radius: 0;
}

.mobile-link:hover,
.mobile-link:active,
.mobile-link.is-open {
    background: rgba(45, 147, 89, 0.08);
    color: var(--color-primary);
    border-radius: 12px;
}

.mobile-link__arrow {
    color: var(--color-gray, #999);
    flex-shrink: 0;
    transition: transform 0.2s ease, color 0.2s ease;
}

.mobile-link:hover .mobile-link__arrow,
.mobile-link:active .mobile-link__arrow {
    color: var(--color-primary);
    transform: translateX(3px);
}

/* ===== ACCORDION ===== */
.mobile-accordion {
    opacity: 0;
    animation: linkIn 0.4s ease forwards;
    animation-delay: calc(0.05s * var(--i) + 0.08s);
}

.mobile-accordion__caret {
    transition: transform 0.28s ease !important;
}

.mobile-accordion__caret.is-rotated {
    transform: rotate(180deg) !important;
}

.mobile-accordion__body {
    overflow: hidden;
    padding: 4px 6px 6px;
}

.mobile-accordion__item {
    display: block;
    padding: 10px 12px;
    font-size: 14px;
    font-weight: 500;
    color: var(--color-text);
    text-decoration: none;
    border-radius: 8px;
    transition: background 0.18s ease, color 0.18s ease;
    line-height: 1.4;
}

.mobile-accordion__item:hover {
    background: rgba(45, 147, 89, 0.08);
    color: var(--color-primary);
}

.mobile-accordion__item--all {
    font-size: 12px;
    font-weight: 700;
    color: var(--color-primary);
    text-transform: uppercase;
    letter-spacing: 0.4px;
    padding: 8px 12px;
}

.mobile-accordion__divider {
    height: 1px;
    background: rgba(0, 0, 0, 0.07);
    margin: 2px 4px 4px;
}

/* accordion transition */
.accordion-enter-active,
.accordion-leave-active {
    transition: max-height 0.32s ease, opacity 0.28s ease;
    max-height: 600px;
}
.accordion-enter-from,
.accordion-leave-to {
    max-height: 0;
    opacity: 0;
}

@keyframes linkIn {
    from { opacity: 0; transform: translateY(-8px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ===== TRANSITIONS ===== */
.dropdown-enter-active { transition: transform 0.35s cubic-bezier(0.22, 1, 0.36, 1), opacity 0.35s ease; }
.dropdown-leave-active { transition: transform 0.25s ease, opacity 0.25s ease; }
.dropdown-enter-from,
.dropdown-leave-to { transform: translateY(-12px); opacity: 0; }

.fade-enter-active,
.fade-leave-active { transition: opacity 0.3s ease; }
.fade-enter-from,
.fade-leave-to { opacity: 0; }

/* ===== RESPONSIVE ===== */
@media (max-width: 1024px) {
    .header__nav { gap: 18px; }
    .brand__subtitle { font-size: 11px; }
}

@media (max-width: 900px) {
    .header__nav { display: none; }
    .header__actions { display: none; }
    .header__burger { display: flex; }
    .header__mobile { display: block; }
    .brand__logo { height: 36px; }
    .brand__info { padding-left: 10px; }
    .brand__subtitle { font-size: 10px; }
}

@media (max-width: 480px) {
    .brand__info { display: none; }
    .brand__logo { height: 32px; }
    .header__mobile { left: 10px; right: 10px; padding: 6px; }
    .header__mobile::before { right: 20px; }
    .mobile-link { font-size: 15px; padding: 14px 12px; }
}
</style>
