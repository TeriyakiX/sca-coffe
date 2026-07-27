<template>
    <footer class="footer">
        <div class="container">
            <div class="footer__cols">
                <div v-for="(group, i) in columns" :key="group.title" class="footer__col">
                    <button
                        class="footer__col-title"
                        :class="{ 'is-open': open[i] }"
                        type="button"
                        @click="toggle(i)"
                    >
                        <span>{{ group.title }}</span>
                        <svg class="footer__caret" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>

                    <ul v-show="open[i] || !isMobile" class="footer__links">
                        <li v-for="link in group.links" :key="link.to">
                            <RouterLink :to="link.to" class="footer__link">{{ link.label }}</RouterLink>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer__bottom">
                <p class="footer__copyright">
                    © {{ year }} Ассоциация специалистов кофейной и чайной индустрии России
                </p>
                <a href="mailto:academybarista@ya.ru" class="footer__mail">academybarista@ya.ru</a>
            </div>
        </div>
    </footer>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { RouterLink } from 'vue-router'

const year = new Date().getFullYear()
const isMobile = ref(false)

const columns = [
    {
        title: 'Ассоциация',
        links: [
            { to: '/association', label: 'Об Ассоциации' },
            { to: '/standards', label: 'Профстандарты' },
            { to: '/registries', label: 'Реестры' },
            { to: '/news', label: 'Новости и события' },
        ],
    },
    {
        title: 'Участникам',
        links: [
            { to: '/membership', label: 'Членство' },
            { to: '/membership/join', label: 'Анкета вступления' },
            { to: '/partners', label: 'Партнёры' },
            { to: '/contacts', label: 'Контакты' },
        ],
    },
    {
        title: 'Обучение',
        links: [
            { to: '/education', label: 'Обучение и квалификации' },
            { to: '/accreditation', label: 'Аккредитация' },
            { to: '/accreditation/apply', label: 'Заявка на аккредитацию' },
        ],
    },
    {
        title: 'Сведения об организации',
        links: [
            { to: '/info', label: 'Все разделы' },
            { to: '/page/about', label: 'Основные сведения' },
            { to: '/page/documents', label: 'Документы' },
            { to: '/page/education', label: 'Образование' },
        ],
    },
]

const open = ref(columns.map(() => false))

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
    padding: 52px 0 24px;
    overflow-x: hidden;
}

.footer__cols {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 32px;
    padding-bottom: 32px;
}

.footer__col-title {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    width: 100%;
    padding: 0;
    margin-bottom: 16px;
    background: none;
    border: none;
    font-family: var(--font-family);
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.4px;
    color: rgba(255, 255, 255, 0.45);
    text-align: left;
    cursor: default;
}

.footer__caret { display: none; }

.footer__links {
    list-style: none;
    display: grid;
    gap: 11px;
    margin: 0;
    padding: 0;
}

.footer__link {
    font-size: 14.5px;
    color: rgba(255, 255, 255, 0.82);
    text-decoration: none;
    transition: color 0.2s ease;
}

.footer__link:hover { color: var(--color-primary-light); }

.footer__bottom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    flex-wrap: wrap;
    padding-top: 22px;
    border-top: 1px solid rgba(255, 255, 255, 0.12);
}

.footer__copyright {
    font-size: 13px;
    color: rgba(255, 255, 255, 0.45);
    margin: 0;
}

.footer__mail {
    font-size: 13.5px;
    font-weight: 600;
    color: var(--color-primary-light);
    text-decoration: none;
}

.footer__mail:hover { color: #fff; }

@media (max-width: 1024px) {
    .footer__cols { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 28px; }
}

@media (max-width: 768px) {
    .footer { padding: 34px 0 20px; }

    .footer__cols { grid-template-columns: 1fr; gap: 0; padding-bottom: 18px; }

    .footer__col + .footer__col { border-top: 1px solid rgba(255, 255, 255, 0.1); }

    .footer__col-title {
        padding: 15px 0;
        margin-bottom: 0;
        cursor: pointer;
        color: rgba(255, 255, 255, 0.85);
        font-size: 12.5px;
    }

    .footer__caret {
        display: block;
        flex-shrink: 0;
        transition: transform 0.25s ease;
    }

    .footer__col-title.is-open .footer__caret { transform: rotate(180deg); }

    .footer__links { padding: 0 0 16px; gap: 13px; }

    .footer__bottom {
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 10px;
        padding-top: 18px;
        margin-top: 14px;
    }

    .footer__copyright { font-size: 12.5px; }
}
</style>
