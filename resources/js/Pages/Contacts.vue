<template>
    <MainLayout>
        <VPageHero eyebrow="Контакты" :title="block('contacts.hero').title" :subtitle="block('contacts.hero').subtitle" />
        <VContentSection alt>
            <div class="contacts">
                <div class="contacts__info">
                    <div class="contacts__item">
                        <span class="contacts__label">Email</span>
                        <a :href="`mailto:${email}`" class="contacts__value">{{ email }}</a>
                    </div>
                    <div class="contacts__item">
                        <span class="contacts__label">По вопросам членства</span>
                        <RouterLink to="/membership/join" class="contacts__value">Анкета вступления</RouterLink>
                    </div>
                    <div class="contacts__item">
                        <span class="contacts__label">По вопросам аккредитации</span>
                        <RouterLink to="/accreditation/apply" class="contacts__value">Предварительная заявка на аккредитацию</RouterLink>
                    </div>
                    <div class="contacts__item">
                        <span class="contacts__label">Рабочие группы</span>
                        <RouterLink to="/standards/working-group" class="contacts__value">Подать заявку эксперта</RouterLink>
                    </div>
                    <div class="contacts__item">
                        <span class="contacts__label">Партнёрство</span>
                        <span class="contacts__value contacts__value--plain">Направьте запрос через форму или на почту Ассоциации</span>
                    </div>
                </div>
                <form v-if="!sent" class="contacts__form" @submit.prevent="submit">
                    <h2 class="contacts__form-title">Написать в Ассоциацию</h2>
                    <div class="contacts__grid">
                        <VFormField v-model="form.topic" label="Тема обращения" type="select" :options="topics" :error="errors.topic" required wide />
                        <VFormField v-model="form.name" label="Имя / организация" :error="errors.name" required />
                        <VFormField v-model="form.email" label="Email" type="email" :error="errors.email" required />
                        <VFormField v-model="form.phone" label="Телефон" type="tel" hint="Необязательно" :error="errors.phone" />
                        <VFormField v-model="form.message" label="Сообщение" type="textarea" :error="errors.message" required wide />
                    </div>
                    <label class="contacts__consent">
                        <input v-model="consent" type="checkbox" required />
                        <span>
                            Согласен на обработку персональных данных в соответствии с
                            <RouterLink to="/page/privacy" target="_blank" class="contacts__consent-link">
                                политикой обработки персональных данных
                            </RouterLink>.
                        </span>
                    </label>
                    <label class="contacts__consent">
                        <input v-model="marketingConsent" type="checkbox" />
                        <span>
                            Согласен получать информационные материалы Ассоциации.
                            <em class="contacts__consent-note">Необязательно, можно отозвать в любой момент.</em>
                        </span>
                    </label>
                    <p v-if="formError" class="contacts__error">{{ formError }}</p>
                    <button type="submit" class="btn btn--primary contacts__submit" :disabled="!consent || sending">
                        {{ sending ? 'Отправляем…' : 'Отправить' }}
                    </button>
                </form>
                <div v-else class="contacts__done">
                    <VIcon name="check" size="large" />
                    <h2 class="contacts__form-title">Сообщение отправлено</h2>
                    <p class="contacts__note">Ассоциация ответит на указанный email.</p>
                    <button class="btn btn--outline" @click="reset">Написать ещё раз</button>
                </div>
            </div>
        </VContentSection>
    </MainLayout>
</template>
<script setup>
import { computed, reactive, ref } from 'vue'
import { RouterLink } from 'vue-router'
import MainLayout from '@/app/layouts/MainLayout.vue'
import VPageHero from '@/shared/components/ui/VPageHero.vue'
import VContentSection from '@/shared/components/ui/VContentSection.vue'
import VIcon from '@/shared/components/ui/VIcon.vue'
import VFormField from '@/shared/components/form/VFormField.vue'
import { useContentBlocks } from '@/shared/composables/useContentBlocks'
import { sendContactRequest } from '@/shared/api/catalog'
import { extractErrors } from '@/shared/api/http'

const { block } = useContentBlocks('contacts')

const topics = [
    { value: 'membership', label: 'Членство в Ассоциации' },
    { value: 'accreditation', label: 'Аккредитация учебного центра' },
    { value: 'working-group', label: 'Участие в рабочей группе' },
    { value: 'partnership', label: 'Партнёрство' },
    { value: 'press', label: 'Пресса и медиа' },
    { value: 'other', label: 'Другое' },
]

const emptyForm = () => ({ topic: '', name: '', email: '', phone: '', message: '' })

const form = reactive(emptyForm())
const errors = ref({})
const formError = ref('')
const consent = ref(false)
const marketingConsent = ref(false)
const sending = ref(false)
const sent = ref(false)

const email = computed(() => block('contacts.hero').body || 'academybarista@ya.ru')

const submit = async () => {
    sending.value = true
    errors.value = {}
    formError.value = ''

    try {
        await sendContactRequest({
            ...form,
            personal_data_consent: consent.value,
            marketing_consent: marketingConsent.value,
        })

        sent.value = true
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

const reset = () => {
    Object.assign(form, emptyForm())
    consent.value = false
    marketingConsent.value = false
    sent.value = false
}
</script>
<style scoped>
.contacts {
    display: grid;
    grid-template-columns: 1fr 1.4fr;
    gap: 32px;
    align-items: start;
}

.contacts__info { display: grid; gap: 14px; }

.contacts__item {
    background: var(--color-bg);
    border: 1px solid rgba(0, 0, 0, 0.06);
    border-radius: var(--radius-sm);
    padding: 18px 20px;
}

.contacts__label {
    display: block;
    font-size: 11.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    color: var(--color-gray);
    margin-bottom: 6px;
}

.contacts__value {
    font-size: 16px;
    font-weight: 700;
    color: var(--color-primary);
    text-decoration: none;
}

.contacts__value--plain { color: var(--color-text); font-weight: 500; font-size: 14.5px; }

.contacts__form,
.contacts__done {
    background: var(--color-bg);
    border: 1px solid rgba(0, 0, 0, 0.06);
    border-radius: var(--radius);
    padding: 30px;
}

.contacts__done { text-align: center; }
.contacts__done :deep(.icon) { color: var(--color-primary); }

.contacts__form-title { font-size: 20px; font-weight: 700; margin: 0 0 20px; }

.contacts__grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 18px; }

.contacts__consent {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-top: 20px;
    font-size: 14px;
    color: rgba(26, 26, 26, 0.7);
}

.contacts__consent input { margin-top: 3px; }

.contacts__consent-link {
    color: var(--color-primary);
    text-decoration: underline;
}

.contacts__consent-note {
    display: block;
    margin-top: 2px;
    font-size: 13px;
    font-style: normal;
    color: var(--color-gray);
}
.contacts__submit { margin-top: 20px; }
.contacts__note { margin: 14px 0 22px; font-size: 13.5px; color: var(--color-gray); }
.contacts__error { margin: 14px 0 0; font-size: 14px; color: var(--color-error); }

@media (max-width: 900px) {
    .contacts { grid-template-columns: 1fr; gap: 24px; }
}

@media (max-width: 680px) {
    .contacts__grid { grid-template-columns: 1fr; gap: 14px; }
    .contacts__form,
    .contacts__done { padding: 22px 20px; }
    .contacts__form-title { font-size: 18px; margin-bottom: 16px; }
    .contacts__item { padding: 16px 18px; }
    .contacts__submit { width: 100%; }
}
</style>
