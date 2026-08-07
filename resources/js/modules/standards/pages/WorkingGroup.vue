<template>
    <MainLayout>
        <VPageHero
            eyebrow="Профессиональные стандарты"
            title="Заявка на участие в рабочей группе"
            subtitle="Рабочие группы формируют проекты профессиональных стандартов. Расскажите о своём направлении и опыте — Ассоциация свяжется с вами и направит порядок участия."
        />
        <VContentSection alt>
            <div class="wg">
                <form v-if="!sent" class="wg__form" @submit.prevent="submit">
                    <div class="wg__grid">
                        <VFormField
                            v-model="form.direction"
                            label="Направление рабочей группы"
                            type="select"
                            :options="directions"
                            :error="errors.direction"
                            required
                            wide
                        />
                        <VFormField v-model="form.name" label="ФИО" :error="errors.name" required />
                        <VFormField v-model="form.email" label="Email" type="email" :error="errors.email" required />
                        <VFormField v-model="form.role" label="Должность и место работы" :error="errors.role" required wide />
                        <VFormField
                            v-model="form.experience"
                            label="Опыт в отрасли"
                            type="select"
                            :options="experienceOptions"
                            :error="errors.experience"
                            required
                            wide
                        />
                        <VFormField
                            v-model="form.expertise"
                            label="Профессиональный опыт и экспертиза"
                            type="textarea"
                            placeholder="Чем занимаетесь, какие задачи решаете, что можете привнести в разработку стандарта"
                            :error="errors.expertise"
                            required
                            wide
                        />
                        <VFormField
                            v-model="form.topics"
                            label="Темы, в которых готовы участвовать"
                            type="textarea"
                            placeholder="Например: трудовые функции бариста, требования к программам подготовки, критерии оценки"
                            :error="errors.topics"
                            wide
                        />
                        <VFormField
                            v-model="form.links"
                            label="Ссылки на профессиональные проекты или публикации"
                            type="textarea"
                            placeholder="Необязательно: сайт, портфолио, статьи, выступления"
                            :error="errors.links"
                            wide
                        />
                    </div>
                    <label class="wg__consent">
                        <input v-model="consent" type="checkbox" required />
                        <span>
                            Согласен на обработку персональных данных в соответствии с
                            <RouterLink to="/page/privacy" target="_blank" class="wg__consent-link">
                                политикой обработки персональных данных
                            </RouterLink>.
                        </span>
                    </label>
                    <p v-if="formError" class="wg__error">{{ formError }}</p>
                    <button type="submit" class="btn btn--primary wg__submit" :disabled="!consent || sending">
                        {{ sending ? 'Отправляем…' : 'Отправить заявку' }}
                    </button>
                </form>
                <div v-else class="wg__done">
                    <VIcon name="check" size="large" />
                    <h2 class="wg__done-title">Заявка отправлена</h2>
                    <p class="wg__done-text">
                        Ассоциация рассмотрит заявку и свяжется с вами по указанному адресу.
                        Состав рабочих групп формируется по мере утверждения направлений разработки.
                    </p>
                    <button class="btn btn--outline" @click="reset">Отправить ещё одну</button>
                </div>
                <aside class="wg__aside">
                    <h3 class="wg__aside-title">Что делает рабочая группа</h3>
                    <VCheckList :items="asideItems" />
                    <RouterLink to="/standards" class="wg__aside-link">Направления разработки →</RouterLink>
                </aside>
            </div>
        </VContentSection>
    </MainLayout>
</template>
<script setup>
import { reactive, ref } from 'vue'
import { RouterLink } from 'vue-router'
import MainLayout from '@/app/layouts/MainLayout.vue'
import VPageHero from '@/shared/components/ui/VPageHero.vue'
import VContentSection from '@/shared/components/ui/VContentSection.vue'
import VCheckList from '@/shared/components/ui/VCheckList.vue'
import VIcon from '@/shared/components/ui/VIcon.vue'
import VFormField from '@/shared/components/form/VFormField.vue'
import { sendContactRequest } from '@/shared/api/catalog'
import { extractErrors } from '@/shared/api/http'

const directions = [
    { value: 'coffee', label: 'Кофейное направление' },
    { value: 'tea', label: 'Чайное направление' },
    { value: 'education', label: 'Образовательное направление' },
]

const experienceOptions = [
    { value: '1-3', label: 'От 1 до 3 лет' },
    { value: '3-5', label: 'От 3 до 5 лет' },
    { value: '5-10', label: 'От 5 до 10 лет' },
    { value: '10+', label: 'Более 10 лет' },
]

const asideItems = [
    'Описывает трудовые функции профессии',
    'Формулирует требования к знаниям и навыкам',
    'Определяет уровни квалификации',
    'Готовит основу для программ подготовки',
    'Участвует в общественном обсуждении проекта',
]

const emptyForm = () => ({
    direction: '',
    name: '',
    email: '',
    role: '',
    experience: '',
    expertise: '',
    topics: '',
    links: '',
})

const form = reactive(emptyForm())
const errors = ref({})
const formError = ref('')
const consent = ref(false)
const sending = ref(false)
const sent = ref(false)

const label = (options, value) => options.find((o) => o.value === value)?.label ?? value

// Заявка сохраняется как обращение с темой «рабочая группа»:
// специальные поля собираются в структурированное сообщение.
const buildMessage = () => [
    `Направление: ${label(directions, form.direction)}`,
    `Должность и место работы: ${form.role}`,
    `Опыт в отрасли: ${label(experienceOptions, form.experience)}`,
    '',
    'Профессиональный опыт и экспертиза:',
    form.expertise,
    ...(form.topics ? ['', 'Темы для участия:', form.topics] : []),
    ...(form.links ? ['', 'Проекты и публикации:', form.links] : []),
].join('\n')

const submit = async () => {
    sending.value = true
    errors.value = {}
    formError.value = ''

    try {
        await sendContactRequest({
            topic: 'working-group',
            name: form.name,
            email: form.email,
            message: buildMessage(),
            personal_data_consent: consent.value,
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
    sent.value = false
}
</script>
<style scoped>
.wg {
    display: grid;
    grid-template-columns: 1.6fr 1fr;
    gap: 32px;
    align-items: start;
}

.wg__grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 18px;
}

.wg__consent {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-top: 22px;
    font-size: 14px;
    line-height: 1.55;
    color: rgba(26, 26, 26, 0.7);
}

.wg__consent input { margin-top: 3px; flex-shrink: 0; }

.wg__consent-link {
    color: var(--color-primary);
    text-decoration: underline;
}

.wg__submit { margin-top: 22px; }

.wg__error {
    margin: 16px 0 0;
    font-size: 14px;
    color: var(--color-error);
}

.wg__done {
    background: var(--color-bg);
    border: 1px solid rgba(45, 147, 89, 0.3);
    border-radius: var(--radius);
    padding: 40px;
    text-align: center;
}

.wg__done :deep(.icon) { color: var(--color-primary); }
.wg__done-title { font-size: 24px; font-weight: 700; margin: 16px 0 10px; }
.wg__done-text { font-size: 15.5px; line-height: 1.6; color: var(--color-gray); margin: 0 0 22px; }

.wg__aside {
    background: var(--color-bg);
    border: 1px solid rgba(0, 0, 0, 0.06);
    border-radius: var(--radius);
    padding: 26px;
    position: sticky;
    top: 100px;
}

.wg__aside-title { font-size: 17px; font-weight: 700; margin: 0 0 16px; }

.wg__aside-link {
    display: inline-block;
    margin-top: 18px;
    font-size: 13.5px;
    font-weight: 700;
    color: var(--color-primary);
    text-decoration: none;
}

@media (max-width: 900px) {
    .wg { grid-template-columns: minmax(0, 1fr); gap: 24px; }
    .wg__aside { position: static; order: -1; }
}

@media (max-width: 680px) {
    .wg__grid { grid-template-columns: minmax(0, 1fr); gap: 14px; }
    .wg__aside { padding: 20px; }
    .wg__submit { width: 100%; }
    .wg__done { padding: 28px 20px; }
    .wg__done-title { font-size: 21px; }
}
</style>
