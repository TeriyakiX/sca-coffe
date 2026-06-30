<template>
    <div ref="containerRef" class="lazy-video">
        <video
            ref="videoRef"
            class="lazy-video__element"
            :poster="poster"
            muted
            loop
            playsinline
            preload="metadata"
        >
            <source :src="src" type="video/mp4" />
        </video>
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const props = defineProps({
    src: {
        type: String,
        required: true
    },
    poster: {
        type: String,
        default: ''
    }
})

const containerRef = ref(null)
const videoRef = ref(null)
let observer = null
let isLoaded = false

const handleIntersection = (entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting && !isLoaded) {
            const video = videoRef.value
            if (video) {
                video.load()
                video.play().catch(() => {})
                isLoaded = true
            }
        } else if (!entry.isIntersecting && isLoaded) {
            const video = videoRef.value
            if (video && !video.paused) {
                video.pause()
            }
        }
    })
}

onMounted(() => {
    if ('IntersectionObserver' in window) {
        observer = new IntersectionObserver(handleIntersection, {
            rootMargin: '50px',
            threshold: 0.1
        })
        if (containerRef.value) {
            observer.observe(containerRef.value)
        }
    } else {
        // fallback
        if (videoRef.value) {
            videoRef.value.load()
            videoRef.value.play().catch(() => {})
            isLoaded = true
        }
    }
})

onUnmounted(() => {
    if (observer) {
        observer.disconnect()
    }
    if (videoRef.value) {
        videoRef.value.pause()
        videoRef.value.src = ''
        videoRef.value.load()
    }
})
</script>

<style scoped>
.lazy-video {
    width: 100%;
    height: 100%;
    overflow: hidden;
    background: var(--color-gray-light);
}

.lazy-video__element {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>
