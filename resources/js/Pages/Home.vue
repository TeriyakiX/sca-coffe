<template>
    <MainLayout>
        <HeroSection :block="block('home.hero')" />
        <VWhySection :block="block('home.why')" />
        <VDirectionsSection :block="block('home.directions')" />
        <VStandardsSection
            :hero="block('standards.hero')"
            :developed="block('standards.developed')"
            :directions="block('standards.directions')"
        />
        <VMembershipSection
            :hero="block('membership.hero')"
            :audience="block('membership.audience')"
            :benefits="block('membership.benefits')"
        />
        <VAccreditationSection
            :hero="block('accreditation.hero')"
            :scope="block('accreditation.scope')"
        />
        <VQualificationFlow :block="block('home.qualification-flow')" />
        <VNewsSection />
        <VPartnersSection :block="block('partners.benefits')" />
        <VFinalCta :block="block('home.final-cta')" />
    </MainLayout>
</template>
<script setup>
import MainLayout from '@/app/layouts/MainLayout.vue'
import HeroSection from '@/modules/Hero/components/HeroSection.vue'
import { VWhySection, VDirectionsSection, VQualificationFlow, VFinalCta } from '@/modules/home'
import { VStandardsSection } from '@/modules/standards'
import { VMembershipSection } from '@/modules/membership'
import { VAccreditationSection } from '@/modules/accreditation'
import { VNewsSection } from '@/modules/news'
import { VPartnersSection } from '@/modules/partners'
import { useContentBlocks } from '@/shared/composables/useContentBlocks'

const { block } = useContentBlocks()
</script>
