<template>
    <header class="header" :class="{ 'header--scrolled': isScrolled }">
        <div class="container header__inner">
            <div class="header__brand">
                <RouterLink to="/" class="brand">
                    <VLogo :size="52" class="brand__logo" />
                    <div class="brand__info">
                        <span class="brand__subtitle">
                            Ассоциация специалистов<br>
                            кофейной и чайной индустрии России
                        </span>
                    </div>
                </RouterLink>
            </div>
            <nav class="header__nav">
                <RouterLink
                    v-for="item in menuItems"
                    :key="item.to"
                    :to="item.to"
                    class="nav-link"
                    active-class="is-active"
                >
                    {{ item.label }}
                </RouterLink>
                <div class="nav-dropdown" @mouseenter="openDropdown" @mouseleave="closeDropdown">
                    <button class="nav-link nav-link--dropdown" :class="{ 'is-open': isDropdownOpen }" type="button">
                        Ещё
                        <svg class="nav-link__caret" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <transition name="dropdown-menu">
                        <div v-if="isDropdownOpen" class="nav-dropdown__menu">
                            <RouterLink
                                v-for="item in secondaryItems"
                                :key="item.to"
                                :to="item.to"
                                class="nav-dropdown__item"
                            >
                                {{ item.label }}
                            </RouterLink>
                            <div class="nav-dropdown__divider"></div>
                            <RouterLink to="/info" class="nav-dropdown__item nav-dropdown__item--all">
                                Сведения об организации →
                            </RouterLink>
                        </div>
                    </transition>
                </div>
            </nav>
            <div class="header__actions">
                <RouterLink to="/membership/join" class="btn btn--sm btn--primary">Вступить в ассоциацию</RouterLink>
            </div>
            <button class="header__burger" :class="{ 'is-active': isMenuOpen }" @click="toggleMenu" aria-label="Меню">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
        <transition name="fade">
            <div v-if="isMenuOpen" class="header__backdrop" @click="closeMenu"></div>
        </transition>
        <transition name="dropdown">
            <div v-if="isMenuOpen" class="header__mobile">
                <nav class="header__mobile-nav">
                    <RouterLink
                        v-for="(item, i) in allMenuItems"
                        :key="item.to"
                        :to="item.to"
                        class="mobile-link"
                        :style="{ '--i': i }"
                        @click="closeMenu"
                    >
                        <span>{{ item.label }}</span>
                        <svg class="mobile-link__arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </RouterLink>
                    <div class="mobile-accordion" :style="{ '--i': allMenuItems.length }">
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
                                <RouterLink to="/info" class="mobile-accordion__item mobile-accordion__item--all" @click="closeMenu">
                                    Все разделы →
                                </RouterLink>
                                <div class="mobile-accordion__divider"></div>
                                <RouterLink
                                    v-for="item in infoPages"
                                    :key="item.slug"
                                    :to="`/page/${item.slug}`"
                                    class="mobile-accordion__item"
                                    @click="closeMenu"
                                >
                                    {{ item.title }}
                                </RouterLink>
                            </div>
                        </transition>
                    </div>
                    <div class="header__mobile-actions">
                        <RouterLink to="/membership/join" class="btn btn--primary" @click="closeMenu">
                            Вступить в ассоциацию
                        </RouterLink>
                        <RouterLink to="/accreditation/apply" class="btn btn--outline" @click="closeMenu">
                            Пройти аккредитацию
                        </RouterLink>
                    </div>
                </nav>
            </div>
        </transition>
    </header>
</template>
<script setup>
import { ref, onMounted, onUnmounted, watch } from 'vue'
import { RouterLink, useRoute } from 'vue-router'
import VLogo from '@/shared/components/ui/VLogo.vue'
import { fetchPages } from '@/shared/api/content'

const route = useRoute()

const isMenuOpen = ref(false)
const isScrolled = ref(false)
const isDropdownOpen = ref(false)
const isMobileInfoOpen = ref(false)

let dropdownTimer = null

const infoPages = ref([])

// Раздел 1 документа: «Реестры» вынесены из «Ещё» в основную навигацию —
// раздел подчёркивает системность Ассоциации, даже пока реестры формируются.
const menuItems = [
    { to: '/association',   label: 'Ассоциация' },
    { to: '/standards',     label: 'Профстандарты' },
    { to: '/membership',    label: 'Членство' },
    { to: '/accreditation', label: 'Аккредитация' },
    { to: '/registries',    label: 'Реестры' },
    { to: '/news',          label: 'Новости' },
]

const secondaryItems = [
    { to: '/education', label: 'Обучение и квалификации' },
    { to: '/partners',  label: 'Партнёры' },
    { to: '/contacts',  label: 'Контакты' },
]

const allMenuItems = [...menuItems, ...secondaryItems]

const openDropdown = () => {
    clearTimeout(dropdownTimer)
    isDropdownOpen.value = true
}

const closeDropdown = () => {
    dropdownTimer = setTimeout(() => {
        isDropdownOpen.value = false
    }, 120)
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

watch(() => route.fullPath, () => {
    closeMenu()
    isDropdownOpen.value = false
})

onMounted(async () => {
    window.addEventListener('scroll', handleScroll)

    try {
        infoPages.value = await fetchPages()
    } catch (e) {
        infoPages.value = []
    }
})
onUnmounted(() => {
    clearTimeout(dropdownTimer)
    window.removeEventListener('scroll', handleScroll)
    document.body.style.overflow = ''
})
</script>
<style scoped>
.header {
    background: rgba(255, 255, 255, 0.94);
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
    gap: 18px;
}

.header__brand { flex-shrink: 0; }

.brand {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
}

.brand__logo { height: 52px; width: 52px; }

.brand__info {
    display: flex;
    flex-direction: column;
    line-height: 1.2;
    padding-left: 12px;
    border-left: 2px solid var(--color-primary);
}

.brand__subtitle {
    font-size: 11.5px;
    font-weight: 600;
    color: var(--color-text);
    letter-spacing: 0.2px;
    line-height: 1.3;
}

.header__nav {
    display: flex;
    gap: 20px;
    align-items: center;
}

.nav-link {
    font-size: 13.5px;
    font-weight: 600;
    color: var(--color-text);
    text-decoration: none;
    padding: 6px 0;
    border: none;
    border-bottom: 2px solid transparent;
    transition: color 0.22s ease, border-color 0.22s ease;
    cursor: pointer;
    background: none;
    font-family: var(--font-family);
    white-space: nowrap;
}

.nav-link:hover,
.nav-link.is-active,
.nav-link--dropdown.is-open {
    color: var(--color-primary);
    border-bottom-color: var(--color-primary);
}

.nav-link--dropdown {
    display: flex;
    align-items: center;
    gap: 5px;
}

.nav-link__caret { transition: transform 0.25s ease; flex-shrink: 0; margin-top: 1px; }
.nav-link--dropdown.is-open .nav-link__caret { transform: rotate(180deg); }

.nav-dropdown { position: relative; }

.nav-dropdown__menu {
    position: absolute;
    top: calc(100% + 14px);
    right: 0;
    min-width: 300px;
    background: #fff;
    border: 1px solid rgba(0, 0, 0, 0.07);
    border-radius: 14px;
    box-shadow: 0 16px 48px rgba(0, 0, 0, 0.14), 0 4px 12px rgba(0, 0, 0, 0.06);
    padding: 6px;
    z-index: 1001;
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

.dropdown-menu-enter-active { transition: transform 0.28s cubic-bezier(0.22, 1, 0.36, 1), opacity 0.28s ease; }
.dropdown-menu-leave-active { transition: transform 0.18s ease, opacity 0.18s ease; }
.dropdown-menu-enter-from,
.dropdown-menu-leave-to { transform: translateY(-8px); opacity: 0; }

.header__actions {
    display: flex;
    gap: 10px;
    flex-shrink: 0;
    align-items: center;
}

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

.header__backdrop {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100vh;
    background: rgba(0, 0, 0, 0.45);
    backdrop-filter: blur(3px);
    -webkit-backdrop-filter: blur(3px);
    z-index: 998;
}

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
    max-height: calc(100vh - 120px);
    overflow-y: auto;
}

.header__mobile-nav {
    display: flex;
    flex-direction: column;
    position: relative;
    z-index: 1;
}

.header__mobile-actions {
    display: flex;
    flex-direction: column;
    gap: 10px;
    padding: 14px 10px 8px;
}

.mobile-link {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    width: 100%;
    padding: 15px 14px;
    border: none;
    border-radius: 12px;
    background: none;
    font-family: var(--font-family);
    font-size: 16px;
    font-weight: 600;
    color: var(--color-text);
    text-align: left;
    text-decoration: none;
    cursor: pointer;
    transition: background 0.2s ease, color 0.2s ease;
    opacity: 0;
    animation: linkIn 0.4s ease forwards;
    animation-delay: calc(0.04s * var(--i) + 0.06s);
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

.mobile-accordion {
    opacity: 0;
    animation: linkIn 0.4s ease forwards;
    animation-delay: calc(0.04s * var(--i) + 0.06s);
}

.mobile-accordion__caret { transition: transform 0.28s ease !important; }
.mobile-accordion__caret.is-rotated { transform: rotate(180deg) !important; }

.mobile-accordion__body { overflow: hidden; padding: 4px 6px 6px; }

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

.accordion-enter-active,
.accordion-leave-active {
    transition: max-height 0.32s ease, opacity 0.28s ease;
    max-height: 600px;
}
.accordion-enter-from,
.accordion-leave-to { max-height: 0; opacity: 0; }

@keyframes linkIn {
    from { opacity: 0; transform: translateY(-8px); }
    to   { opacity: 1; transform: translateY(0); }
}

.dropdown-enter-active { transition: transform 0.35s cubic-bezier(0.22, 1, 0.36, 1), opacity 0.35s ease; }
.dropdown-leave-active { transition: transform 0.25s ease, opacity 0.25s ease; }
.dropdown-enter-from,
.dropdown-leave-to { transform: translateY(-12px); opacity: 0; }

.fade-enter-active,
.fade-leave-active { transition: opacity 0.3s ease; }
.fade-enter-from,
.fade-leave-to { opacity: 0; }

@media (max-width: 1500px) {
    .header__nav { gap: 15px; }
    .nav-link { font-size: 13px; }
}
@media (max-width: 1280px) {
    .brand__info { display: none; }
    .header__nav { gap: 13px; }
}

@media (max-width: 1024px) {
    .header__nav { display: none; }
    .header__actions { display: none; }
    .header__burger { display: flex; }
    .header__mobile { display: block; }
    .brand__info { display: flex; }
    .brand__logo { height: 46px; width: 46px; }
}

@media (max-width: 680px) {
    .header { padding: 10px 0; }
    .header__inner { gap: 12px; }
    .brand__info { display: none; }
    .brand__logo { height: 46px; width: 46px; }
    .header__mobile {
        left: 10px;
        right: 10px;
        padding: 6px;
        top: calc(100% + 10px);
        max-height: calc(100dvh - 96px);
    }
    .mobile-link { font-size: 15.5px; padding: 15px 14px; }
    .header__burger { padding: 8px; margin: -8px; }
}

@media (max-width: 420px) {
    .brand__logo { height: 42px; width: 42px; }
}
</style>
