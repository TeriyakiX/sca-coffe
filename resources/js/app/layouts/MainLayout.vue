<!-- resources/js/app/layouts/MainLayout.vue -->
<template>
    <div class="app">
        <TheHeader />
        <main class="main-content">
            <slot />
        </main>
        <TheFooter />
    </div>
</template>

<script setup>
import TheHeader from './components/TheHeader.vue'
import TheFooter from './components/TheFooter.vue'
</script>

<style scoped>
.app {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

.main-content {
    flex: 1;
}
</style>
