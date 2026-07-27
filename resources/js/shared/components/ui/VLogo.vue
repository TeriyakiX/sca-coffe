<template>
    <img
        class="logo"
        src="/images/logo.svg"
        alt="Ассоциация специалистов кофейной и чайной индустрии России"
        :width="size"
        :height="size"
        loading="eager"
        decoding="async"
    />
</template>
<script setup>
defineProps({
    size: { type: [String, Number], default: 44 },
})
</script>
<style scoped>
.logo {
    display: block;
    object-fit: contain;
    flex-shrink: 0;
}
</style>
