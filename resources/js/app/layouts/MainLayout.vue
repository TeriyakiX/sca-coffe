<template>
    <div class="app">
        <TheHeader />
        <main class="main-content">
            <slot />
        </main>
        <TheFooter />
        <VCookieNotice />
    </div>
</template>
<script setup>
import TheHeader from './components/TheHeader.vue'
import TheFooter from './components/TheFooter.vue'
import VCookieNotice from '@/shared/components/ui/VCookieNotice.vue'
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
