import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/modules/admin/store/useAuthStore'

const Home = () => import('@/Pages/Home.vue')
const Contacts = () => import('@/Pages/Contacts.vue')
const InfoIndex = () => import('@/Pages/Info/InfoIndex.vue')
const Page = () => import('@/Pages/Page.vue')

const AssociationIndex = () => import('@/modules/association/pages/Index.vue')
const StandardsIndex = () => import('@/modules/standards/pages/Index.vue')
const StandardsWorkingGroup = () => import('@/modules/standards/pages/WorkingGroup.vue')
const MembershipIndex = () => import('@/modules/membership/pages/Index.vue')
const MembershipJoin = () => import('@/modules/membership/pages/Join.vue')
const AccreditationIndex = () => import('@/modules/accreditation/pages/Index.vue')
const AccreditationApply = () => import('@/modules/accreditation/pages/Apply.vue')
const EducationIndex = () => import('@/modules/education/pages/Index.vue')
const RegistriesIndex = () => import('@/modules/registries/pages/Index.vue')
const NewsIndex = () => import('@/modules/news/pages/Index.vue')
const NewsShow = () => import('@/modules/news/pages/Show.vue')
const EventShow = () => import('@/modules/events/pages/Show.vue')
const PartnersIndex = () => import('@/modules/partners/pages/Index.vue')

const AdminLogin = () => import('@/modules/admin/pages/Login.vue')
const AdminDashboard = () => import('@/modules/admin/pages/Dashboard.vue')
const AdminResourcePage = () => import('@/modules/admin/pages/ResourcePage.vue')

const adminRoute = (path, name, resource, title) => ({
    path,
    name,
    component: AdminResourcePage,
    meta: { admin: true, resource, title },
})

const routes = [
    { path: '/', name: 'home', component: Home },

    { path: '/association', name: 'association', component: AssociationIndex, meta: { title: 'Об Ассоциации' } },
    { path: '/standards', name: 'standards', component: StandardsIndex, meta: { title: 'Профессиональные стандарты' } },
    { path: '/standards/working-group', name: 'standards.working-group', component: StandardsWorkingGroup, meta: { title: 'Заявка в рабочую группу' } },
    { path: '/membership', name: 'membership', component: MembershipIndex, meta: { title: 'Членство в Ассоциации' } },
    { path: '/membership/join', name: 'membership.join', component: MembershipJoin, meta: { title: 'Анкета вступления' } },
    { path: '/accreditation', name: 'accreditation', component: AccreditationIndex, meta: { title: 'Аккредитация учебных центров' } },
    { path: '/accreditation/apply', name: 'accreditation.apply', component: AccreditationApply, meta: { title: 'Заявка на аккредитацию' } },
    { path: '/education', name: 'education', component: EducationIndex, meta: { title: 'Обучение и квалификации' } },
    { path: '/registries', name: 'registries', component: RegistriesIndex, meta: { title: 'Реестры' } },
    { path: '/news', name: 'news', component: NewsIndex, meta: { title: 'Новости и события' } },
    { path: '/news/:slug', name: 'news.show', component: NewsShow },
    { path: '/events/:slug', name: 'events.show', component: EventShow },
    { path: '/partners', name: 'partners', component: PartnersIndex, meta: { title: 'Партнёры Ассоциации' } },
    { path: '/contacts', name: 'contacts', component: Contacts, meta: { title: 'Контакты' } },

    { path: '/info', name: 'info', component: InfoIndex, meta: { title: 'Сведения об организации' } },
    { path: '/page/:slug', name: 'page', component: Page },

    { path: '/admin/login', name: 'admin.login', component: AdminLogin, meta: { title: 'Вход в админ-панель' } },
    { path: '/admin', name: 'admin', component: AdminDashboard, meta: { admin: true, title: 'Админ-панель' } },
    adminRoute('/admin/blocks', 'admin.blocks', 'blocksResource', 'Блоки страниц'),
    adminRoute('/admin/pages', 'admin.pages', 'pagesResource', 'Страницы'),
    adminRoute('/admin/news', 'admin.news', 'newsResource', 'Новости'),
    adminRoute('/admin/events', 'admin.events', 'eventsResource', 'Мероприятия'),
    adminRoute('/admin/partners', 'admin.partners', 'partnersResource', 'Партнёры'),
    adminRoute('/admin/membership', 'admin.membership', 'membershipResource', 'Заявки на вступление'),
    adminRoute('/admin/accreditation', 'admin.accreditation', 'accreditationResource', 'Заявки на аккредитацию'),
    adminRoute('/admin/contacts', 'admin.contacts', 'contactsResource', 'Обращения'),

    { path: '/about', redirect: '/association' },
    { path: '/business', redirect: '/partners' },

    // Раздел 25 документа: старые страницы-дубли уводим на профильные разделы
    { path: '/page/education', redirect: '/education' },
    { path: '/page/standards', redirect: '/standards' },

    { path: '/:pathMatch(.*)*', redirect: '/' },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) return savedPosition
        if (to.hash) return { el: to.hash, top: 90, behavior: 'smooth' }
        return { top: 0 }
    },
})

router.beforeEach(async (to) => {
    if (!to.meta?.admin) {
        return true
    }

    const auth = useAuthStore()
    const user = await auth.check()

    if (!user?.is_admin) {
        return { name: 'admin.login' }
    }

    return true
})

const BASE_TITLE = 'Ассоциация специалистов кофейной и чайной индустрии России'

let firstNavigation = true

router.afterEach((to) => {
    const isFirst = firstNavigation

    firstNavigation = false

    if (to.meta?.title) {
        document.title = `${to.meta.title} — ${BASE_TITLE}`

        return
    }

    // У новостей и страниц заголовок приходит с сервера и точнее общего —
    // на первой загрузке не затираем его, дальше страница выставит сама
    if (isFirst) {
        return
    }

    document.title = BASE_TITLE
})

export default router
