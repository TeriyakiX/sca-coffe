<template>
    <MainLayout>
        <VPageHero
            eyebrow="Аккредитация"
            title="Предварительная заявка на аккредитацию"
            subtitle="Заполните заявку — Ассоциация проверит данные, уточнит комплект документов и направит порядок прохождения процедуры."
        />
        <VContentSection alt>
            <div class="apply">
                <form v-if="!sent" class="apply__form" @submit.prevent="submit">
                    <div class="apply__grid">
                        <VFormField v-model="form.type" label="Тип заявки" type="select" :options="types" :error="errors.type" required wide />
                        <VFormField v-model="form.organization" label="Название организации" :error="errors.organization" required wide />
                        <VFormField v-model="form.inn" label="ИНН" :error="errors.inn" />
                        <VFormField v-model="form.city" label="Город" :error="errors.city" required />
                        <VFormField v-model="form.contact_name" label="Контактное лицо" :error="errors.contact_name" required />
                        <VFormField v-model="form.contact_position" label="Должность" :error="errors.contact_position" />
                        <VFormField v-model="form.email" label="Email" type="email" :error="errors.email" required />
                        <VFormField v-model="form.phone" label="Телефон" type="tel" :error="errors.phone" required />
                        <VFormField v-model="form.site_url" label="Сайт" placeholder="https://" :error="errors.site_url" wide />
                        <VFormField
                            v-model="form.programs"
                            label="Программы обучения"
                            type="textarea"
                            placeholder="Перечислите программы, направления и количество тренеров"
                            :error="errors.programs"
                            wide
                        />
                        <VFormField
                            v-model="form.facilities"
                            label="Материально-техническая база"
                            type="textarea"
                            placeholder="Оборудование, учебные площадки, количество рабочих мест"
                            :error="errors.facilities"
                            wide
                        />
                        <VFormField
                            v-model="form.experience"
                            label="Опыт работы в обучении"
                            type="select"
                            :options="experienceOptions"
                            :error="errors.experience"
                        />
                        <VFormField
                            v-model="form.trainers_count"
                            label="Количество преподавателей"
                            type="number"
                            placeholder="Например: 4"
                            :error="errors.trainers_count"
                        />
                        <VFormField
                            v-model="form.comment"
                            label="Дополнительный комментарий"
                            type="textarea"
                            placeholder="Что важно знать Ассоциации при рассмотрении заявки"
                            :error="errors.comment"
                            wide
                        />
                    </div>
                    <label class="apply__consent">
                        <input v-model="consent" type="checkbox" required />
                        <span>
                            Согласен на обработку персональных данных и передачу сведений для рассмотрения заявки
                            в соответствии с
                            <RouterLink to="/page/privacy" target="_blank" class="apply__consent-link">
                                политикой обработки персональных данных
                            </RouterLink>.
                        </span>
                    </label>
                    <label class="apply__consent apply__consent--optional">
                        <input v-model="marketingConsent" type="checkbox" />
                        <span>
                            Согласен получать информационные материалы Ассоциации.
                            <em class="apply__consent-note">Необязательно, можно отозвать в любой момент.</em>
                        </span>
                    </label>
                    <p v-if="formError" class="apply__error">{{ formError }}</p>
                    <button type="submit" class="btn btn--primary apply__submit" :disabled="!consent || sending">
                        {{ sending ? 'Отправляем…' : 'Отправить заявку' }}
                    </button>
                </form>
                <div v-else class="apply__done">
                    <VIcon name="check" size="large" />
                    <h2 class="apply__done-title">Предварительная заявка принята</h2>
                    <p class="apply__done-text">
                        Ваш контакт сохранён. Ассоциация свяжется с вами после утверждения требований
                        и сообщит дальнейшие шаги. Отправка заявки не предоставляет статус аккредитованного центра.
                    </p>
                    <button class="btn btn--outline" @click="reset">Отправить ещё одну</button>
                </div>
                <aside class="apply__aside">
                    <h3 class="apply__aside-title">Что проверяет Ассоциация</h3>
                    <VCheckList :items="scopeItems" />
                </aside>
            </div>
        </VContentSection>
        <VContentSection tag="Порядок" :title="block('accreditation.stages').title">
            <VSteps :items="items('accreditation.stages')" />
        </VContentSection>
    </MainLayout>
</template>
<script setup>
import { computed, reactive, ref } from 'vue'
import { RouterLink } from 'vue-router'
import MainLayout from '@/app/layouts/MainLayout.vue'
import VPageHero from '@/shared/components/ui/VPageHero.vue'
import VContentSection from '@/shared/components/ui/VContentSection.vue'
import VCheckList from '@/shared/components/ui/VCheckList.vue'
import VSteps from '@/shared/components/ui/VSteps.vue'
import VIcon from '@/shared/components/ui/VIcon.vue'
import VFormField from '@/shared/components/form/VFormField.vue'
import { useContentBlocks } from '@/shared/composables/useContentBlocks'
import { sendAccreditationApplication } from '@/shared/api/catalog'
import { extractErrors } from '@/shared/api/http'

const { block, items } = useContentBlocks('accreditation')

const experienceOptions = [
    { value: 'less-1', label: 'Менее года' },
    { value: '1-3', label: 'От 1 до 3 лет' },
    { value: '3-5', label: 'От 3 до 5 лет' },
    { value: '5-10', label: 'От 5 до 10 лет' },
    { value: '10+', label: 'Более 10 лет' },
]

const types = [
    { value: 'training-center', label: 'Аккредитация учебного центра' },
    { value: 'trainer', label: 'Аккредитация тренера' },
    { value: 'program', label: 'Аккредитация программы обучения' },
]

const emptyForm = () => ({
    type: '',
    organization: '',
    inn: '',
    city: '',
    contact_name: '',
    contact_position: '',
    email: '',
    phone: '',
    site_url: '',
    programs: '',
    facilities: '',
    experience: '',
    trainers_count: '',
    comment: '',
})

const form = reactive(emptyForm())
const errors = ref({})
const formError = ref('')
const consent = ref(false)
const marketingConsent = ref(false)
const sending = ref(false)
const sent = ref(false)

const scopeItems = computed(() => items('accreditation.scope').map((i) => i.title))

const submit = async () => {
    sending.value = true
    errors.value = {}
    formError.value = ''

    try {
        await sendAccreditationApplication({
            ...form,
            trainers_count: form.trainers_count === '' ? null : Number(form.trainers_count),
            personal_data_consent: consent.value,
            marketing_consent: marketingConsent.value,
        })

        sent.value = true
        window.scrollTo({ top: 0, behavior: 'smooth' })
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
.apply {
    display: grid;
    grid-template-columns: 1.6fr 1fr;
    gap: 32px;
    align-items: start;
}

.apply__grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
}

.apply__consent {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-top: 22px;
    font-size: 14px;
    line-height: 1.55;
    color: rgba(26, 26, 26, 0.7);
}

.apply__consent input { margin-top: 3px; flex-shrink: 0; }

.apply__consent-link {
    color: var(--color-primary);
    text-decoration: underline;
}

.apply__consent--optional { margin-top: 12px; }

.apply__consent-note {
    display: block;
    margin-top: 2px;
    font-size: 13px;
    font-style: normal;
    color: var(--color-gray);
}

.apply__submit { margin-top: 22px; }
.apply__error { margin: 16px 0 0; font-size: 14px; color: var(--color-error); }

.apply__done {
    background: var(--color-bg);
    border: 1px solid rgba(105, 60, 38, 0.3);
    border-radius: var(--radius);
    padding: 40px;
    text-align: center;
}

.apply__done :deep(.icon) { color: var(--color-secondary); }
.apply__done-title { font-size: 24px; font-weight: 700; margin: 16px 0 10px; }
.apply__done-text { font-size: 15.5px; line-height: 1.6; color: var(--color-gray); margin: 0 0 22px; }

.apply__aside {
    background: var(--color-bg);
    border: 1px solid rgba(0, 0, 0, 0.06);
    border-radius: var(--radius);
    padding: 26px;
    position: sticky;
    top: 100px;
}

.apply__aside-title { font-size: 17px; font-weight: 700; margin: 0 0 16px; }

@media (max-width: 900px) {
    .apply { grid-template-columns: 1fr; gap: 24px; }
    .apply__aside { position: static; order: -1; }
}

@media (max-width: 680px) {
    .apply__grid { grid-template-columns: 1fr; gap: 14px; }
    .apply__aside { padding: 20px; }
    .apply__submit { width: 100%; }
    .apply__done { padding: 28px 20px; }
    .apply__done-title { font-size: 21px; }
}
</style>
