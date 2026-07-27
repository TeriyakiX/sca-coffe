<template>
    <div class="login">
        <form class="login__box" @submit.prevent="submit">
            <VLogo :size="48" class="login__logo" />
            <h1 class="login__title">Вход в админ-панель</h1>
            <p class="login__subtitle">Ассоциация специалистов кофейной и чайной индустрии России</p>
            <div class="login__fields">
                <VFormField v-model="form.email" label="Email" type="email" :error="errors.email" required wide />
                <VFormField v-model="form.password" label="Пароль" type="password" :error="errors.password" required wide />
            </div>
            <p v-if="formError" class="login__error">{{ formError }}</p>
            <button type="submit" class="btn btn--primary login__submit" :disabled="sending">
                {{ sending ? 'Входим…' : 'Войти' }}
            </button>
        </form>
    </div>
</template>
<script setup>
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import VLogo from '@/shared/components/ui/VLogo.vue'
import VFormField from '@/shared/components/form/VFormField.vue'
import { useAuthStore } from '../store/useAuthStore'
import { extractErrors } from '@/shared/api/http'

const router = useRouter()
const auth = useAuthStore()

const form = reactive({ email: '', password: '' })
const errors = ref({})
const formError = ref('')
const sending = ref(false)

const submit = async () => {
    sending.value = true
    errors.value = {}
    formError.value = ''

    try {
        const user = await auth.signIn(form)

        if (!user?.is_admin) {
            formError.value = 'У пользователя нет доступа в админ-панель'
            await auth.signOut()

            return
        }

        router.push('/admin')
    } catch (e) {
        const parsed = extractErrors(e)

        formError.value = parsed.message
        errors.value = Object.fromEntries(
            Object.entries(parsed.fields).map(([field, messages]) => [field, messages[0]]),
        )
    } finally {
        sending.value = false
    }
}
</script>
<style scoped>
.login {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
    background: linear-gradient(180deg, #FFEDCD 0%, var(--color-bg) 100%);
}

.login__box {
    width: 100%;
    max-width: 420px;
    background: var(--color-white);
    border: 1px solid rgba(0, 0, 0, 0.07);
    border-radius: var(--radius);
    padding: 36px;
    box-shadow: var(--shadow-lg);
    text-align: center;
}

.login__logo { margin: 0 auto 18px; }

.login__title { font-size: 22px; font-weight: 700; margin: 0 0 6px; }

.login__subtitle {
    font-size: 13.5px;
    color: var(--color-gray);
    margin: 0 0 26px;
    line-height: 1.5;
}

.login__fields { display: grid; gap: 16px; text-align: left; }

.login__error { margin: 16px 0 0; font-size: 14px; color: var(--color-error); }

.login__submit { width: 100%; margin-top: 22px; }

@media (max-width: 560px) {
    .login { padding: 24px 16px; }
    .login__box { padding: 28px 20px; }
    .login__title { font-size: 20px; }
    .login__submit:hover { transform: none; box-shadow: none; }
}
</style>
