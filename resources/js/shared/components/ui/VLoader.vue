<template>
    <div class="loader">
        <div class="loader__spinner"></div>
    </div>
</template>

<style scoped>
.loader {
    display: inline-block;
}

.loader__spinner {
    width: 30px;
    height: 30px;
    border: 3px solid var(--color-gray-light);
    border-radius: 50%;
    border-top-color: var(--color-primary);
    animation: spin 0.6s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}
</style>
