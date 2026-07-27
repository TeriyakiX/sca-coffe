<template>
    <AdminResource :key="route.path" v-bind="resource" />
</template>

<script setup>
import { computed } from 'vue'
import { useRoute } from 'vue-router'
import AdminResource from '../components/AdminResource.vue'
import * as resources from '../constants/resources'

const route = useRoute()

const resource = computed(() => resources[route.meta.resource])
</script>
