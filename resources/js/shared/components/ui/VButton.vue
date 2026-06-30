<!-- resources/js/shared/components/ui/VButton.vue -->
<template>
    <button
        :class="[
      'btn',
      `btn-${variant}`,
      `btn-${size}`,
      { 'btn-block': block }
    ]"
        :disabled="disabled"
        @click="$emit('click', $event)"
    >
        <span v-if="loading" class="btn-spinner"></span>
        <slot>{{ label }}</slot>
    </button>
</template>

<script setup>
const props = defineProps({
    label: { type: String, default: '' },
    variant: {
        type: String,
        default: 'primary',
        validator: (v) => ['primary', 'secondary', 'outline', 'outline-light', 'outline-secondary', 'danger'].includes(v)
    },
    size: {
        type: String,
        default: 'medium',
        validator: (v) => ['small', 'medium', 'large'].includes(v)
    },
    loading: { type: Boolean, default: false },
    disabled: { type: Boolean, default: false },
    block: { type: Boolean, default: false }
})

defineEmits(['click'])
</script>

<style scoped>
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    border: none;
    border-radius: var(--radius-sm);
    font-family: var(--font-family);
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
}

.btn-primary {
    background: var(--color-primary);
    color: white;
}
.btn-primary:hover:not(:disabled) {
    background: var(--color-primary-dark);
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

.btn-secondary {
    background: var(--color-secondary);
    color: white;
}
.btn-secondary:hover:not(:disabled) {
    background: var(--color-secondary-dark);
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

.btn-outline {
    background: transparent;
    color: var(--color-primary);
    border: 2px solid var(--color-primary);
}
.btn-outline:hover:not(:disabled) {
    background: var(--color-primary);
    color: white;
}

.btn-outline-light {
    background: transparent;
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.6);
}
.btn-outline-light:hover:not(:disabled) {
    background: rgba(255, 255, 255, 0.15);
    border-color: white;
    transform: translateY(-2px);
}

.btn-outline-secondary {
    background: transparent;
    color: var(--color-secondary);
    border: 2px solid var(--color-secondary);
}
.btn-outline-secondary:hover:not(:disabled) {
    background: var(--color-secondary);
    color: white;
}

.btn-danger {
    background: var(--color-error);
    color: white;
}
.btn-danger:hover:not(:disabled) {
    opacity: 0.8;
    transform: translateY(-2px);
}

.btn-small { padding: 6px 14px; font-size: 12px; }
.btn-medium { padding: 10px 20px; font-size: 14px; }
.btn-large { padding: 14px 28px; font-size: 16px; }

.btn-block {
    width: 100%;
    justify-content: center;
}

.btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.btn-spinner {
    display: inline-block;
    width: 16px;
    height: 16px;
    border: 2px solid rgba(255,255,255,0.3);
    border-radius: 50%;
    border-top-color: #fff;
    animation: spin 0.6s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}
</style>
