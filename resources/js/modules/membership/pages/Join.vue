<template>
    <MainLayout>
        <VPageHero
            eyebrow="Членство"
            title="Анкета вступления в Ассоциацию"
            subtitle="Заполните анкету — Ассоциация свяжется с вами, уточнит категорию членства и направит условия участия."
        />
        <VContentSection alt>
            <div class="join">
                <form v-if="!sent" class="join__form" @submit.prevent="submit">
                    <div class="join__grid">
                        <VFormField v-model="form.category" label="Категория членства" type="select" :options="categories" :error="errors.category" required wide />
                        <VFormField v-model="form.name" label="ФИО / Название организации" :error="errors.name" required wide />
                        <VFormField v-model="form.specialization" label="Специализация" type="select" :options="specializations" :error="errors.specialization" required />
                        <VFormField v-model="form.city" label="Город" :error="errors.city" required />
                        <VFormField v-model="form.email" label="Email" type="email" :error="errors.email" required />
                        <VFormField v-model="form.phone" label="Телефон" type="tel" :error="errors.phone" required />
                        <VFormField v-model="form.company" label="Компания / место работы" :error="errors.company" wide />
                        <VFormField
                            v-model="form.about"
                            label="Коротко о себе или организации"
                            type="textarea"
                            placeholder="Опыт, направление работы, интерес к рабочим группам"
                            :error="errors.about"
                            wide
                        />
                    </div>
                    <label class="join__consent join__consent--optional">
                        <input v-model="expertInterest" type="checkbox" />
                        <span>
                            Хочу участвовать в работе экспертной группы по разработке профессиональных стандартов.
                            <em class="join__consent-note">
                                Ассоциация свяжется отдельно и предложит заполнить
                                <RouterLink to="/standards/working-group" class="join__consent-link">заявку эксперта</RouterLink>.
                            </em>
                        </span>
                    </label>
                    <label class="join__consent">
                        <input v-model="consent" type="checkbox" required />
                        <span>
                            Согласен на обработку персональных данных в соответствии с
                            <RouterLink to="/page/privacy" target="_blank" class="join__consent-link">
                                политикой обработки персональных данных
                            </RouterLink>.
                        </span>
                    </label>
                    <label class="join__consent join__consent--optional">
                        <input v-model="marketingConsent" type="checkbox" />
                        <span>
                            Согласен получать информационные материалы Ассоциации.
                            <em class="join__consent-note">Необязательно, можно отозвать в любой момент.</em>
                        </span>
                    </label>
                    <p v-if="formError" class="join__error">{{ formError }}</p>
                    <button type="submit" class="btn btn--primary join__submit" :disabled="!consent || sending">
                        {{ sending ? 'Отправляем…' : 'Отправить анкету' }}
                    </button>
                </form>
                <div v-else class="join__done">
                    <VIcon name="check" size="large" />
                    <h2 class="join__done-title">Анкета отправлена</h2>
                    <p class="join__done-text">
                        Ассоциация свяжется с вами по указанным контактам и направит условия участия.
                    </p>
                    <button class="btn btn--outline" @click="reset">Заполнить ещё одну</button>
                </div>
                <aside class="join__aside">
                    <h3 class="join__aside-title">Что даёт членство</h3>
                    <VCheckList :items="asideBenefits" />
                    <RouterLink to="/membership" class="join__aside-link">Все преимущества и категории →</RouterLink>
                </aside>
            </div>
        </VContentSection>
        <VContentSection tag="Порядок" :title="block('membership.join-steps').title">
            <VSteps :items="items('membership.join-steps')" />
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
import { sendMembershipApplication } from '@/shared/api/catalog'
import { extractErrors } from '@/shared/api/http'

const { block, items } = useContentBlocks('membership')

const categories = [
    { value: 'individual', label: 'Индивидуальное членство' },
    { value: 'corporate', label: 'Корпоративное членство' },
    { value: 'training-center', label: 'Учебный центр' },
    { value: 'partner', label: 'Партнёр Ассоциации' },
]

const specializations = [
    { value: 'barista', label: 'Бариста' },
    { value: 'trainer', label: 'Тренер' },
    { value: 'roaster', label: 'Обжарщик' },
    { value: 'technologist', label: 'Технолог' },
    { value: 'tea-specialist', label: 'Специалист по чаю' },
    { value: 'coffee-shop-owner', label: 'Владелец / управляющий кофейней' },
    { value: 'training-center', label: 'Учебный центр' },
    { value: 'supplier', label: 'Производитель / поставщик' },
    { value: 'other', label: 'Другое' },
]

const emptyForm = () => ({
    category: '',
    specialization: '',
    name: '',
    email: '',
    phone: '',
    city: '',
    company: '',
    about: '',
})

const form = reactive(emptyForm())
const errors = ref({})
const formError = ref('')
const consent = ref(false)
const marketingConsent = ref(false)
const expertInterest = ref(false)
const sending = ref(false)
const sent = ref(false)

const asideBenefits = computed(() => items('membership.benefits').slice(0, 6).map((b) => b.title))

const submit = async () => {
    sending.value = true
    errors.value = {}
    formError.value = ''

    try {
        await sendMembershipApplication({
            ...form,
            expert_interest: expertInterest.value,
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
    expertInterest.value = false
    sent.value = false
}
</script>
<style scoped>
.join {
    display: grid;
    grid-template-columns: 1.6fr 1fr;
    gap: 32px;
    align-items: start;
}

.join__grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
}

.join__consent {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-top: 22px;
    font-size: 14px;
    line-height: 1.55;
    color: rgba(26, 26, 26, 0.7);
}

.join__consent input { margin-top: 3px; flex-shrink: 0; }

.join__consent--optional { margin-top: 12px; }

.join__consent-link {
    color: var(--color-primary);
    text-decoration: underline;
}

.join__consent-note {
    display: block;
    margin-top: 2px;
    font-size: 13px;
    font-style: normal;
    color: var(--color-gray);
}

.join__submit { margin-top: 22px; }

.join__error {
    margin: 16px 0 0;
    font-size: 14px;
    color: var(--color-error);
}

.join__done {
    background: var(--color-bg);
    border: 1px solid rgba(45, 147, 89, 0.3);
    border-radius: var(--radius);
    padding: 40px;
    text-align: center;
}

.join__done :deep(.icon) { color: var(--color-primary); }
.join__done-title { font-size: 24px; font-weight: 700; margin: 16px 0 10px; }
.join__done-text { font-size: 15.5px; line-height: 1.6; color: var(--color-gray); margin: 0 0 22px; }

.join__aside {
    background: var(--color-bg);
    border: 1px solid rgba(0, 0, 0, 0.06);
    border-radius: var(--radius);
    padding: 26px;
    position: sticky;
    top: 100px;
}

.join__aside-title { font-size: 17px; font-weight: 700; margin: 0 0 16px; }

.join__aside-link {
    display: inline-block;
    margin-top: 18px;
    font-size: 13.5px;
    font-weight: 700;
    color: var(--color-primary);
    text-decoration: none;
}

@media (max-width: 900px) {
    .join { grid-template-columns: 1fr; gap: 24px; }
    .join__aside { position: static; order: -1; }
}

@media (max-width: 680px) {
    .join__grid { grid-template-columns: 1fr; gap: 14px; }
    .join__aside { padding: 20px; }
    .join__submit { width: 100%; }
    .join__done { padding: 28px 20px; }
    .join__done-title { font-size: 21px; }
}
</style>
