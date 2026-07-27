<template>
    <div ref="root" class="select" :class="{ 'select--open': isOpen, 'select--invalid': invalid }">
        <button
            type="button"
            class="select__control"
            :aria-expanded="isOpen"
            aria-haspopup="listbox"
            @click="toggle"
            @keydown="onKeydown"
        >
            <span class="select__value" :class="{ 'select__value--empty': !selectedLabel }">
                {{ selectedLabel || placeholder }}
            </span>
            <svg class="select__caret" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
        </button>

        <transition name="select-drop">
            <ul v-if="isOpen" class="select__list" role="listbox">
                <li
                    v-for="(option, index) in normalized"
                    :key="option.value"
                    class="select__option"
                    :class="{ 'is-selected': option.value === modelValue, 'is-active': index === activeIndex }"
                    role="option"
                    :aria-selected="option.value === modelValue"
                    @click="choose(option.value)"
                    @mouseenter="activeIndex = index"
                >
                    <span>{{ option.label }}</span>
                    <svg v-if="option.value === modelValue" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </li>
            </ul>
        </transition>
    </div>
</template>

<script setup>
import { computed, onBeforeUnmount, onMounted, ref, watch } from 'vue'

const props = defineProps({
    modelValue: { type: [String, Number], default: '' },
    options: { type: Array, default: () => [] },
    placeholder: { type: String, default: 'Выберите вариант' },
    invalid: { type: Boolean, default: false },
})

const emit = defineEmits(['update:modelValue'])

const root = ref(null)
const isOpen = ref(false)
const activeIndex = ref(-1)

const normalized = computed(() =>
    props.options.map((option) => (typeof option === 'string' ? { value: option, label: option } : option)),
)

const selectedLabel = computed(
    () => normalized.value.find((option) => option.value === props.modelValue)?.label ?? '',
)

const open = () => {
    isOpen.value = true
    activeIndex.value = normalized.value.findIndex((option) => option.value === props.modelValue)
}

const close = () => {
    isOpen.value = false
}

const toggle = () => (isOpen.value ? close() : open())

const choose = (value) => {
    emit('update:modelValue', value)
    close()
}

const onKeydown = (event) => {
    if (['ArrowDown', 'ArrowUp', 'Enter', ' '].includes(event.key)) {
        event.preventDefault()
    }

    if (!isOpen.value) {
        if (['ArrowDown', 'Enter', ' '].includes(event.key)) open()

        return
    }

    if (event.key === 'Escape') {
        close()

        return
    }

    if (event.key === 'ArrowDown') {
        activeIndex.value = Math.min(activeIndex.value + 1, normalized.value.length - 1)
    }

    if (event.key === 'ArrowUp') {
        activeIndex.value = Math.max(activeIndex.value - 1, 0)
    }

    if (event.key === 'Enter' && normalized.value[activeIndex.value]) {
        choose(normalized.value[activeIndex.value].value)
    }
}

const onOutside = (event) => {
    if (isOpen.value && root.value && !root.value.contains(event.target)) {
        close()
    }
}

watch(() => props.modelValue, close)

onMounted(() => document.addEventListener('click', onOutside))
onBeforeUnmount(() => document.removeEventListener('click', onOutside))
</script>

<style scoped>
.select {
    position: relative;
    width: 100%;
}

.select__control {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    width: 100%;
    min-height: 50px;
    padding: 12px 14px;
    background: var(--color-white);
    border: 1px solid rgba(0, 0, 0, 0.14);
    border-radius: var(--radius-sm);
    font-family: var(--font-family);
    font-size: 16px;
    color: var(--color-text);
    text-align: left;
    cursor: pointer;
    transition: border-color 0.18s ease, box-shadow 0.18s ease;
}

.select__control:hover { border-color: rgba(0, 0, 0, 0.28); }

.select--open .select__control {
    border-color: var(--color-primary);
    box-shadow: 0 0 0 3px rgba(45, 147, 89, 0.14);
}

.select--invalid .select__control { border-color: var(--color-error); }

.select__value {
    flex: 1;
    min-width: 0;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.select__value--empty { color: var(--color-gray); }

.select__caret {
    flex-shrink: 0;
    color: var(--color-gray);
    transition: transform 0.22s ease;
}

.select--open .select__caret { transform: rotate(180deg); color: var(--color-primary); }

.select__list {
    position: absolute;
    top: calc(100% + 6px);
    left: 0;
    right: 0;
    z-index: 40;
    max-height: 264px;
    overflow-y: auto;
    margin: 0;
    padding: 6px;
    list-style: none;
    background: var(--color-white);
    border: 1px solid rgba(0, 0, 0, 0.08);
    border-radius: var(--radius);
    box-shadow: 0 18px 44px rgba(0, 0, 0, 0.16);
}

.select__option {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    padding: 12px 14px;
    border-radius: var(--radius-sm);
    font-size: 15px;
    line-height: 1.4;
    color: var(--color-text);
    cursor: pointer;
    transition: background 0.15s ease, color 0.15s ease;
}

.select__option.is-active { background: rgba(45, 147, 89, 0.08); }

.select__option.is-selected {
    color: var(--color-primary);
    font-weight: 600;
}

.select-drop-enter-active { transition: opacity 0.18s ease, transform 0.18s ease; }
.select-drop-leave-active { transition: opacity 0.14s ease, transform 0.14s ease; }
.select-drop-enter-from,
.select-drop-leave-to { opacity: 0; transform: translateY(-6px); }

@media (max-width: 680px) {
    .select__control { padding: 13px 14px; }
    .select__option { padding: 13px 14px; }
}
</style>
