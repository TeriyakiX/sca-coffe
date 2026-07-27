<template>
    <div v-if="type === 'select'" class="field" :class="{ 'field--wide': wide }">
        <span class="field__label">
            {{ label }}<span v-if="required" class="field__req">*</span>
        </span>

        <VSelect
            :model-value="modelValue"
            :options="normalizedOptions"
            :invalid="Boolean(error)"
            @update:model-value="$emit('update:modelValue', $event)"
        />

        <span v-if="error" class="field__error">{{ error }}</span>
        <span v-else-if="hint" class="field__hint">{{ hint }}</span>
    </div>

    <label v-else class="field" :class="{ 'field--wide': wide }">
        <span class="field__label">
            {{ label }}<span v-if="required" class="field__req">*</span>
        </span>
        <textarea
            v-if="type === 'textarea'"
            class="field__control field__control--area"
            :class="{ 'field__control--invalid': error }"
            rows="4"
            :value="modelValue"
            :required="required"
            :placeholder="placeholder"
            @input="$emit('update:modelValue', $event.target.value)"
        ></textarea>
        <input
            v-else
            class="field__control"
            :class="{ 'field__control--invalid': error }"
            :type="type"
            :value="modelValue"
            :required="required"
            :placeholder="placeholder"
            @input="$emit('update:modelValue', $event.target.value)"
        />
        <span v-if="error" class="field__error">{{ error }}</span>
        <span v-else-if="hint" class="field__hint">{{ hint }}</span>
    </label>
</template>
<script setup>
import { computed } from 'vue'
import VSelect from './VSelect.vue'

const props = defineProps({
    modelValue: { type: [String, Number], default: '' },
    label: { type: String, required: true },
    type: { type: String, default: 'text' },
    options: { type: Array, default: () => [] },
    placeholder: { type: String, default: '' },
    hint: { type: String, default: '' },
    error: { type: String, default: '' },
    required: { type: Boolean, default: false },
    wide: { type: Boolean, default: false },
})

defineEmits(['update:modelValue'])

const normalizedOptions = computed(() =>
    props.options.map((opt) => (typeof opt === 'string' ? { value: opt, label: opt } : opt)),
)
</script>
<style scoped>
.field {
    display: flex;
    flex-direction: column;
    gap: 7px;
}

.field--wide { grid-column: 1 / -1; }

.field__label {
    font-size: 13.5px;
    font-weight: 600;
    color: var(--color-text);
}

.field__req { color: var(--color-error); margin-left: 3px; }

.field__control {
    width: 100%;
    padding: 12px 14px;
    font-size: 16px;
    font-family: var(--font-family);
    color: var(--color-text);
    background: var(--color-white);
    border: 1px solid rgba(0, 0, 0, 0.14);
    border-radius: var(--radius-sm);
    transition: border-color 0.18s ease, box-shadow 0.18s ease;
}

.field__control:focus {
    outline: none;
    border-color: var(--color-primary);
    box-shadow: 0 0 0 3px rgba(45, 147, 89, 0.14);
}

.field__control--invalid {
    border-color: var(--color-error);
}

.field__control--area { resize: vertical; min-height: 110px; }

.field__hint { font-size: 12.5px; color: var(--color-gray); }
.field__error { font-size: 12.5px; color: var(--color-error); }

@media (max-width: 680px) {
    .field__control { padding: 13px 14px; }
    .field__control--area { min-height: 120px; }
}
</style>
