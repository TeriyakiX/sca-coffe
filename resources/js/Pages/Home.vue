<template>
    <MainLayout>
        <HeroSection />
        <div id="education" class="anchor-section"><VEducationSection /></div>
        <div id="business" class="anchor-section"><VBusinessSection /></div>
        <div id="events" class="anchor-section"><VEventsSection /></div>
        <div id="resources" class="anchor-section"><VResourcesSection /></div>
        <div id="membership" class="anchor-section"><VMembershipSection /></div>
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/app/layouts/MainLayout.vue'
import HeroSection from '@/modules/hero/components/HeroSection.vue'
import { VEducationSection } from '@/modules/education'
import { VBusinessSection } from '@/modules/business'
import { VEventsSection } from '@/modules/events'
import { VResourcesSection } from '@/modules/resources'
import { VMembershipSection } from '@/modules/membership'
</script>

<style scoped>
.anchor-section {
    scroll-margin-top: 80px;
}
</style>
