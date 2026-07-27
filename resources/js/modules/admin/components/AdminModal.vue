<template>
    <transition name="admin-modal">
        <div v-if="open" class="admin-modal" @click.self="$emit('close')">
            <div class="admin-modal__box">
                <header class="admin-modal__head">
                    <h2 class="admin-modal__title">{{ title }}</h2>
                    <button class="admin-modal__close" aria-label="Закрыть" @click="$emit('close')">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                            <path d="M18 6 6 18M6 6l12 12" />
                        </svg>
                    </button>
                </header>
                <div class="admin-modal__body">
                    <slot />
                </div>
                <footer v-if="$slots.footer" class="admin-modal__foot">
                    <slot name="footer" />
                </footer>
            </div>
        </div>
    </transition>
</template>
<script setup>
defineProps({
    open: { type: Boolean, default: false },
    title: { type: String, default: '' },
})

defineEmits(['close'])
</script>
<style scoped>
.admin-modal {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.45);
    display: flex;
    align-items: flex-start;
    justify-content: center;
    padding: 40px 20px;
    z-index: 1200;
    overflow-y: auto;
}

.admin-modal__box {
    background: var(--color-white);
    border-radius: var(--radius);
    width: 100%;
    max-width: 720px;
    box-shadow: var(--shadow-xl);
}

.admin-modal__head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 24px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.07);
}

.admin-modal__title { font-size: 19px; font-weight: 700; margin: 0; }

.admin-modal__close {
    background: none;
    border: none;
    color: var(--color-gray);
    cursor: pointer;
    padding: 4px;
    line-height: 0;
}

.admin-modal__body { padding: 24px; }

.admin-modal__foot {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    padding: 18px 24px;
    border-top: 1px solid rgba(0, 0, 0, 0.07);
}

.admin-modal-enter-active,
.admin-modal-leave-active { transition: opacity 0.2s ease; }

.admin-modal-enter-active .admin-modal__box,
.admin-modal-leave-active .admin-modal__box { transition: transform 0.24s cubic-bezier(0.22, 1, 0.36, 1); }

.admin-modal-enter-from,
.admin-modal-leave-to { opacity: 0; }

.admin-modal-enter-from .admin-modal__box,
.admin-modal-leave-to .admin-modal__box { transform: translateY(14px); }

@media (max-width: 680px) {
    .admin-modal { padding: 0; align-items: flex-end; }

    .admin-modal__box {
        max-width: none;
        border-radius: 18px 18px 0 0;
        max-height: 92dvh;
        display: flex;
        flex-direction: column;
    }

    .admin-modal__head { padding: 16px 18px; }
    .admin-modal__title { font-size: 17px; }
    .admin-modal__body { padding: 18px; overflow-y: auto; }

    .admin-modal__foot {
        padding: 14px 18px calc(14px + env(safe-area-inset-bottom));
        flex-direction: column-reverse;
        gap: 8px;
    }

    .admin-modal__foot :deep(.btn) {
        width: 100%;
        min-height: 48px;
        padding: 0 20px;
        font-size: 15px;
        border-radius: 50px;
    }

    .admin-modal__foot :deep(.btn:hover) {
        transform: none;
        box-shadow: none;
    }

    .admin-modal__close {
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: -8px;
        border-radius: 50%;
    }

    .admin-modal-enter-from .admin-modal__box,
    .admin-modal-leave-to .admin-modal__box { transform: translateY(100%); }
}
</style>
