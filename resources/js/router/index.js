import { createRouter, createWebHistory } from 'vue-router'

// Pages
const Home = () => import('@/Pages/Home.vue')
const About = () => import('@/Pages/About/Index.vue')
const InfoIndex = () => import('@/Pages/Info/InfoIndex.vue')
const Page = () => import('@/Pages/Page.vue')

// Auth
const Login = () => import('@/Pages/Auth/Login.vue')
const Register = () => import('@/Pages/Auth/Register.vue')
const ForgotPassword = () => import('@/Pages/Auth/ForgotPassword.vue')
const ResetPassword = () => import('@/Pages/Auth/ResetPassword.vue')
const VerifyEmail = () => import('@/Pages/Auth/VerifyEmail.vue')

// Modules
const BusinessIndex = () => import('@/modules/business/pages/Index.vue')
const EducationIndex = () => import('@/modules/education/pages/Index.vue')
const MembershipJoin = () => import('@/modules/membership/pages/Join.vue')

const routes = [
    { path: '/', name: 'home', component: Home },
    { path: '/about', name: 'about', component: About },
    { path: '/info', name: 'info', component: InfoIndex },
    { path: '/page/:slug', name: 'page', component: Page },

    // Auth
    { path: '/login', name: 'login', component: Login },
    { path: '/register', name: 'register', component: Register },
    { path: '/forgot-password', name: 'forgot-password', component: ForgotPassword },
    { path: '/reset-password/:token', name: 'reset-password', component: ResetPassword },
    { path: '/verify-email', name: 'verify-email', component: VerifyEmail },

    // Modules
    { path: '/business', name: 'business', component: BusinessIndex },
    { path: '/education', name: 'education', component: EducationIndex },
    { path: '/membership/join', name: 'membership.join', component: MembershipJoin },

    // 404
    { path: '/:pathMatch(.*)*', redirect: '/' }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior() {
        return { top: 0 }
    }
})

export default router
