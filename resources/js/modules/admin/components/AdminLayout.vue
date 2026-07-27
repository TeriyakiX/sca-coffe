<template>
    <div class="admin">
        <aside class="admin__sidebar">
            <div class="admin__sidebar-top">
                <RouterLink to="/admin" class="admin__brand">
                    <VLogo :size="34" />
                    <span>Админ-панель</span>
                </RouterLink>
                <RouterLink to="/" class="admin__site-link" target="_blank">Сайт</RouterLink>
            </div>

            <nav ref="navEl" class="admin__nav">
                <template v-for="group in menu" :key="group.title">
                    <span class="admin__nav-title">{{ group.title }}</span>
                    <RouterLink
                        v-for="link in group.links"
                        :key="link.to"
                        :to="link.to"
                        class="admin__nav-link"
                        active-class="is-active"
                    >
                        {{ link.label }}
                    </RouterLink>
                </template>
            </nav>

            <div class="admin__user">
                <span class="admin__user-name">{{ auth.user?.name }}</span>
                <button class="admin__logout" @click="signOut">Выйти</button>
            </div>
        </aside>

        <main class="admin__main">
            <header class="admin__header">
                <h1 class="admin__title">{{ title }}</h1>
                <div v-if="$slots.actions" class="admin__header-actions">
                    <slot name="actions" />
                </div>
            </header>

            <div class="admin__content">
                <slot />
            </div>
        </main>
    </div>
</template>

<script setup>
import { nextTick, onMounted, ref, watch } from 'vue'
import { RouterLink, useRoute, useRouter } from 'vue-router'
import VLogo from '@/shared/components/ui/VLogo.vue'
import { useAuthStore } from '../store/useAuthStore'

defineProps({
    title: { type: String, default: '' },
})

const auth = useAuthStore()
const router = useRouter()
const route = useRoute()
const navEl = ref(null)

// На мобильных меню — горизонтальная лента, и при переходе она отматывается
// в начало. Подкручиваем её к активному пункту, чтобы было видно, где мы.
const scrollToActiveLink = () => {
    const nav = navEl.value
    const active = nav?.querySelector('.is-active')

    if (!nav || !active || nav.scrollWidth <= nav.clientWidth) {
        return
    }

    const navBox = nav.getBoundingClientRect()
    const activeBox = active.getBoundingClientRect()
    const offset = activeBox.left - navBox.left - (navBox.width - activeBox.width) / 2

    nav.scrollTo({ left: nav.scrollLeft + offset, behavior: 'auto' })
}

const revealActiveLink = async () => {
    await nextTick()
    scrollToActiveLink()

    // Ширина пунктов меняется после подгрузки шрифтов, поэтому позицию
    // нужно пересчитать, иначе активный пункт остаётся подрезанным.
    await document.fonts?.ready
    scrollToActiveLink()
}

onMounted(revealActiveLink)
watch(() => route.path, revealActiveLink)

const menu = [
    {
        title: 'Контент',
        links: [
            { to: '/admin/blocks', label: 'Блоки страниц' },
            { to: '/admin/pages', label: 'Страницы (сведения)' },
            { to: '/admin/news', label: 'Новости' },
            { to: '/admin/events', label: 'Мероприятия' },
            { to: '/admin/partners', label: 'Партнёры' },
        ],
    },
    {
        title: 'Заявки',
        links: [
            { to: '/admin/membership', label: 'Вступление' },
            { to: '/admin/accreditation', label: 'Аккредитация' },
            { to: '/admin/contacts', label: 'Обращения' },
        ],
    },
]

const signOut = async () => {
    await auth.signOut()
    router.push('/admin/login')
}
</script>

<style scoped>
.admin {
    display: grid;
    grid-template-columns: 268px minmax(0, 1fr);
    min-height: 100vh;
    background: var(--color-bg);
    max-width: 100%;
}

.admin__sidebar {
    display: flex;
    flex-direction: column;
    background: var(--color-white);
    border-right: 1px solid rgba(0, 0, 0, 0.08);
    padding: 20px 16px;
    position: sticky;
    top: 0;
    height: 100vh;
    overflow-y: auto;
}

.admin__sidebar-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    padding-bottom: 18px;
    margin-bottom: 10px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.07);
}

.admin__brand {
    display: flex;
    align-items: center;
    gap: 10px;
    color: var(--color-text);
    text-decoration: none;
    font-weight: 700;
    font-size: 15px;
}

.admin__site-link {
    font-size: 12.5px;
    font-weight: 600;
    color: var(--color-primary);
    text-decoration: none;
    white-space: nowrap;
}

.admin__nav {
    display: flex;
    flex-direction: column;
    gap: 2px;
    flex: 1;
}

.admin__nav-title {
    font-size: 10.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.4px;
    color: var(--color-gray);
    margin: 16px 12px 8px;
}

.admin__nav-link {
    display: block;
    padding: 10px 12px;
    border-radius: 10px;
    font-size: 14.5px;
    font-weight: 500;
    color: var(--color-text);
    text-decoration: none;
    transition: background 0.18s ease, color 0.18s ease;
}

.admin__nav-link:hover {
    background: rgba(45, 147, 89, 0.08);
    color: var(--color-primary);
}

.admin__nav-link.is-active {
    background: var(--color-primary);
    color: #fff;
    font-weight: 600;
}

.admin__user {
    border-top: 1px solid rgba(0, 0, 0, 0.07);
    padding-top: 16px;
    margin-top: 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
}

.admin__user-name {
    font-size: 13.5px;
    color: var(--color-gray);
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.admin__logout {
    background: none;
    border: 1px solid rgba(0, 0, 0, 0.15);
    color: var(--color-text);
    border-radius: 50px;
    padding: 8px 16px;
    font-family: var(--font-family);
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    white-space: nowrap;
    transition: all 0.2s ease;
}

.admin__logout:hover { border-color: var(--color-error); color: var(--color-error); }

.admin__main { padding: 28px 32px 60px; min-width: 0; }

.admin__header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    flex-wrap: wrap;
    margin-bottom: 24px;
}

.admin__title { font-size: 26px; font-weight: 700; margin: 0; }

.admin__header-actions { display: flex; gap: 10px; flex-wrap: wrap; }

@media (max-width: 1180px) {
    .admin { grid-template-columns: 220px minmax(0, 1fr); }
    .admin__sidebar { padding: 18px 12px; }
    .admin__nav-link { font-size: 14px; padding: 9px 11px; }
    .admin__main { padding: 24px 20px 48px; }
    .admin__title { font-size: 23px; }
}

@media (max-width: 900px) {
    .admin {
        grid-template-columns: minmax(0, 1fr);
        grid-template-rows: auto minmax(0, 1fr);
    }

    .admin__sidebar {
        position: sticky;
        top: 0;
        z-index: 10;
        height: auto;
        align-self: start;
        min-width: 0;
        max-width: 100%;
        padding: 12px 16px 10px;
        overflow: hidden;
        border-right: none;
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
    }

    .admin__sidebar-top {
        padding-bottom: 12px;
        margin-bottom: 10px;
    }

    .admin__nav {
        flex: 0 0 auto;
        flex-direction: row;
        flex-wrap: nowrap;
        align-items: center;
        width: 100%;
        min-width: 0;
        max-width: 100%;
        overflow-x: auto;
        overscroll-behavior-x: contain;
        gap: 6px;
        padding-bottom: 4px;
        scrollbar-width: none;
    }

    .admin__nav::-webkit-scrollbar { display: none; }

    .admin__nav-title { display: none; }

    .admin__nav-link {
        display: inline-flex;
        align-items: center;
        flex: 0 0 auto;
        white-space: nowrap;
        min-height: 40px;
        font-size: 14px;
        padding: 0 16px;
        border-radius: 50px;
        background: var(--color-bg);
        border: 1px solid rgba(0, 0, 0, 0.06);
    }

    .admin__nav-link.is-active { border-color: var(--color-primary); }

    .admin__user {
        border-top: none;
        padding-top: 0;
        margin-top: 10px;
    }

    .admin__user-name { font-size: 13px; }

    .admin__logout {
        min-height: 40px;
        padding: 0 18px;
        font-size: 13.5px;
    }

    .admin__main { padding: 20px 16px 40px; }

    .admin__header {
        flex-wrap: wrap;
        align-items: center;
        margin-bottom: 16px;
        gap: 12px;
    }

    .admin__title {
        font-size: 20px;
        line-height: 1.25;
        min-width: 0;
        flex: 1 1 auto;
    }

    .admin__header-actions { flex-shrink: 0; }

    /* Единый размер кнопок внутри админки на мобильных */
    .admin :deep(.btn--sm) {
        min-height: 42px;
        padding: 0 18px;
        font-size: 14px;
        font-weight: 600;
        border-radius: 50px;
    }

    .admin :deep(.btn--sm:hover) {
        transform: none;
        box-shadow: none;
    }
}

@media (max-width: 560px) {
    .admin__header { gap: 10px; }

    .admin__title { font-size: 19px; }

    /* «Добавить» остаётся компактной рядом с заголовком, а не во всю ширину */
    .admin__header-actions :deep(.btn--sm) { padding: 0 16px; }
}
</style>
