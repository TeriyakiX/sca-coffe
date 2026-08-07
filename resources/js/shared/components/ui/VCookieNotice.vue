<template>
    <transition name="cookie">
        <div v-if="visible" class="cookie" role="dialog" aria-live="polite" aria-label="Использование cookies">
            <div class="cookie__body">
                <p class="cookie__text">
                    Мы используем cookies, чтобы сайт работал корректно и чтобы понимать, какие разделы полезны посетителям.
                    Продолжая пользоваться сайтом, вы соглашаетесь с
                    <RouterLink to="/page/cookies" class="cookie__link">политикой использования cookies</RouterLink>
                    и
                    <RouterLink to="/page/privacy" class="cookie__link">политикой конфиденциальности</RouterLink>.
                </p>
                <div class="cookie__actions">
                    <button type="button" class="btn btn--sm btn--primary" @click="accept">Принять</button>
                    <button type="button" class="btn btn--sm btn--outline" @click="decline">Только необходимые</button>
                </div>
            </div>
        </div>
    </transition>
</template>
<script setup>
import { onMounted, ref } from 'vue'
import { RouterLink } from 'vue-router'

const STORAGE_KEY = 'acti-cookie-consent'

const visible = ref(false)

// Решение храним локально: баннер показывается один раз на браузер,
// как описано в политике использования cookies
const save = (value) => {
    try {
        localStorage.setItem(STORAGE_KEY, JSON.stringify({ value, at: new Date().toISOString() }))
    } catch (e) {
        // приватный режим может запрещать запись — тогда просто скрываем баннер
    }

    visible.value = false
}

const accept = () => save('accepted')
const decline = () => save('necessary-only')

onMounted(() => {
    try {
        visible.value = !localStorage.getItem(STORAGE_KEY)
    } catch (e) {
        visible.value = true
    }
})
</script>
<style scoped>
.cookie {
    position: fixed;
    left: 16px;
    right: 16px;
    bottom: 16px;
    z-index: 1100;
    display: flex;
    justify-content: center;
    pointer-events: none;
}

.cookie__body {
    pointer-events: auto;
    display: flex;
    align-items: center;
    gap: 24px;
    width: 100%;
    max-width: 1100px;
    padding: 20px 24px;
    background: var(--color-white);
    border: 1px solid rgba(0, 0, 0, 0.08);
    border-radius: var(--radius);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.16);
}

.cookie__text {
    flex: 1 1 auto;
    margin: 0;
    font-size: 14.5px;
    line-height: 1.6;
    color: var(--color-text);
}

.cookie__link {
    color: var(--color-primary);
    text-decoration: underline;
}

.cookie__actions {
    flex: 0 0 auto;
    display: flex;
    gap: 10px;
}

.cookie-enter-active,
.cookie-leave-active { transition: opacity 0.25s ease, transform 0.25s ease; }

.cookie-enter-from,
.cookie-leave-to { opacity: 0; transform: translateY(16px); }

@media (max-width: 900px) {
    .cookie__body { flex-direction: column; align-items: stretch; gap: 16px; padding: 18px 20px; }
    .cookie__actions { flex-direction: column; }
    .cookie__actions .btn { width: 100%; }
}

@media (max-width: 560px) {
    .cookie { left: 10px; right: 10px; bottom: 10px; }
    .cookie__text { font-size: 14px; }
}
</style>
