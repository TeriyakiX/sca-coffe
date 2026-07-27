<template>
    <AdminLayout :title="title">
        <template #actions>
            <button v-if="creatable" class="btn btn--sm btn--primary admin-resource__add" @click="openCreate">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                    <path d="M12 5v14M5 12h14" />
                </svg>
                Добавить
            </button>
        </template>
        <p v-if="listError" class="admin-resource__error">{{ listError }}</p>
        <AdminTable :columns="columns" :rows="rows">
            <template v-for="col in columns" :key="col.key" #[`cell-${col.key}`]="{ row }">
                <span
                    :class="{
                        'admin-resource__muted': col.muted,
                        'admin-resource__nowrap': col.format === 'date' || col.nowrap,
                    }"
                >
                    {{ display(row, col) }}
                </span>
            </template>
            <template #actions="{ row }">
                <button class="btn btn--sm btn--outline" @click="openEdit(row)">Изменить</button>
                <button v-if="deletable" class="btn btn--sm btn--outline admin-resource__danger" @click="remove(row)">
                    Удалить
                </button>
            </template>
        </AdminTable>
        <AdminModal :open="modalOpen" :title="modalTitle" @close="closeModal">
            <div class="admin-resource__form">
                <VFormField
                    v-for="field in editableFields"
                    :key="field.key"
                    v-model="form[field.key]"
                    :label="field.label"
                    :type="field.type || 'text'"
                    :options="field.options || []"
                    :placeholder="field.placeholder || ''"
                    :hint="field.hint || ''"
                    :error="errors[field.key]"
                    :required="Boolean(field.required)"
                    :wide="field.wide !== false"
                />
                <div v-for="field in listFields" :key="field.key" class="admin-resource__list">
                    <span class="admin-resource__list-label">{{ field.label }}</span>
                    <textarea
                        v-model="jsonDrafts[field.key]"
                        class="admin-resource__json"
                        rows="12"
                        spellcheck="false"
                    ></textarea>
                    <span v-if="errors[field.key]" class="admin-resource__field-error">{{ errors[field.key] }}</span>
                    <span v-else class="admin-resource__hint">Список элементов в формате JSON</span>
                </div>
            </div>
            <p v-if="formError" class="admin-resource__error">{{ formError }}</p>
            <template #footer>
                <button class="btn btn--sm btn--outline" @click="closeModal">Отмена</button>
                <button class="btn btn--sm btn--primary" :disabled="saving" @click="save">
                    {{ saving ? 'Сохраняем…' : 'Сохранить' }}
                </button>
            </template>
        </AdminModal>
    </AdminLayout>
</template>
<script setup>
import { computed, reactive, ref, watch } from 'vue'
import AdminLayout from './AdminLayout.vue'
import AdminTable from './AdminTable.vue'
import AdminModal from './AdminModal.vue'
import VFormField from '@/shared/components/form/VFormField.vue'
import { extractErrors } from '@/shared/api/http'
import { formatDate } from '@/shared/utils/date'

const props = defineProps({
    title: { type: String, required: true },
    api: { type: Object, required: true },
    columns: { type: Array, required: true },
    fields: { type: Array, required: true },
    creatable: { type: Boolean, default: true },
    deletable: { type: Boolean, default: true },
})

const rows = ref([])
const listError = ref('')
const modalOpen = ref(false)
const saving = ref(false)
const formError = ref('')
const errors = ref({})
const editing = ref(null)

const form = reactive({})
const jsonDrafts = reactive({})

const editableFields = computed(() => props.fields.filter((f) => f.type !== 'json'))
const listFields = computed(() => props.fields.filter((f) => f.type === 'json'))

const modalTitle = computed(() => (editing.value ? `${props.title}: редактирование` : `${props.title}: создание`))

const display = (row, col) => {
    const value = row[col.key]

    if (col.format === 'date') {
        return formatDate(value)
    }

    if (col.map) {
        return col.map[value] ?? value ?? '—'
    }

    if (Array.isArray(value)) {
        return `${value.length} элем.`
    }

    return value ?? '—'
}

const load = async () => {
    listError.value = ''

    try {
        const payload = await props.api.list({ per_page: 100 })

        rows.value = Array.isArray(payload) ? payload : payload?.data ?? []
    } catch (e) {
        listError.value = extractErrors(e).message
        rows.value = []
    }
}

const resetForm = (source = {}) => {
    props.fields.forEach((field) => {
        if (field.type === 'json') {
            jsonDrafts[field.key] = JSON.stringify(source[field.key] ?? [], null, 2)

            return
        }

        form[field.key] = source[field.key] ?? ''
    })

    errors.value = {}
    formError.value = ''
}

const openCreate = () => {
    editing.value = null
    resetForm()
    modalOpen.value = true
}

const openEdit = (row) => {
    editing.value = row
    resetForm(row)
    modalOpen.value = true
}

const closeModal = () => {
    modalOpen.value = false
}

const buildPayload = () => {
    const payload = {}

    props.fields.forEach((field) => {
        if (field.type === 'json') {
            payload[field.key] = JSON.parse(jsonDrafts[field.key] || '[]')

            return
        }

        const value = form[field.key]

        if (value !== '' && value !== null) {
            payload[field.key] = field.cast === 'number' ? Number(value) : value
        }
    })

    return payload
}

const save = async () => {
    saving.value = true
    errors.value = {}
    formError.value = ''

    let payload

    try {
        payload = buildPayload()
    } catch (e) {
        formError.value = 'Проверьте формат JSON в списках'
        saving.value = false

        return
    }

    try {
        if (editing.value) {
            await props.api.update(editing.value.id, payload)
        } else {
            await props.api.create(payload)
        }

        modalOpen.value = false
        await load()
    } catch (e) {
        const parsed = extractErrors(e)

        formError.value = parsed.message
        errors.value = Object.fromEntries(
            Object.entries(parsed.fields).map(([field, messages]) => [field, messages[0]]),
        )
    } finally {
        saving.value = false
    }
}

const remove = async (row) => {
    if (!window.confirm('Удалить запись?')) {
        return
    }

    try {
        await props.api.remove(row.id)
        await load()
    } catch (e) {
        listError.value = extractErrors(e).message
    }
}

watch(
    () => props.api,
    () => {
        rows.value = []
        modalOpen.value = false
        load()
    },
    { immediate: true },
)
</script>
<style scoped>
.admin-resource__form { display: grid; gap: 18px; }

.admin-resource__error {
    margin: 16px 0 0;
    font-size: 14px;
    color: var(--color-error);
}

.admin-resource__danger:hover {
    border-color: var(--color-error);
    color: var(--color-error);
}

/* В карточном режиме ховера может не быть — «Удалить» отличается сразу */
@media (max-width: 1100px) {
    .admin-resource__danger {
        border-color: rgba(220, 53, 69, 0.28);
        color: var(--color-error);
        background: transparent;
    }
}

.admin-resource__list { display: flex; flex-direction: column; gap: 7px; }

.admin-resource__list-label { font-size: 13.5px; font-weight: 600; }

.admin-resource__json {
    width: 100%;
    padding: 12px 14px;
    font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
    font-size: 13px;
    line-height: 1.5;
    color: var(--color-text);
    background: var(--color-bg);
    border: 1px solid rgba(0, 0, 0, 0.14);
    border-radius: var(--radius-sm);
    resize: vertical;
}

.admin-resource__json:focus {
    outline: none;
    border-color: var(--color-primary);
}

.admin-resource__hint { font-size: 12.5px; color: var(--color-gray); }
.admin-resource__field-error { font-size: 12.5px; color: var(--color-error); }
.admin-resource__muted { color: var(--color-gray); }

/* Дата — короткое значение, «1 июля 2026 г.» ломаться по словам не должна */
.admin-resource__nowrap { white-space: nowrap; }
</style>
