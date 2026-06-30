<template>
    <section class="business">
        <div class="business__video-wrapper">
            <video
                ref="videoRef"
                class="business__video"
                autoplay
                muted
                loop
                playsinline
                preload="auto"
            >
                <source src="/videos/business-bg.mp4" type="video/mp4" />
            </video>
            <div class="business__overlay"></div>
        </div>

        <div class="container">
            <div class="business__content">
                <div class="business__header">
                    <span class="business__tag">{{ data.hero.tag }}</span>
                    <h2 class="business__title">{{ data.hero.title }}</h2>
                    <p class="business__subtitle">{{ data.hero.subtitle }}</p>
                    <VButton size="large" @click="goToBusiness">{{ data.hero.buttonText }}</VButton>
                </div>

                <div class="business__features">
                    <div v-for="feature in data.features" :key="feature.title" class="business__feature">
                        <h3>{{ feature.title }}</h3>
                        <p>{{ feature.text }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { router } from '@inertiajs/vue3'
import VButton from '@/shared/components/ui/VButton.vue'
import { businessData } from '../constants/businessData'

const data = businessData
const videoRef = ref(null)

onMounted(() => {
    if (videoRef.value) {
        videoRef.value.play().catch(() => {})
    }
})

const goToBusiness = () => {
    router.get('/business')
}
</script>

<style scoped>
.business {
    position: relative;
    padding: 80px 0;
    color: white;
    overflow: hidden;
}

/* ===== ВИДЕО ФОН ===== */
.business__video-wrapper {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
}

.business__video {
    position: absolute;
    top: 50%;
    left: 50%;
    min-width: 100%;
    min-height: 100%;
    width: auto;
    height: auto;
    transform: translate(-50%, -50%);
    object-fit: cover;
}

.business__overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        135deg,
        rgba(45, 147, 89, 0.85) 0%,
        rgba(31, 107, 63, 0.8) 45%,
        rgba(105, 60, 38, 0.8) 100%
    );
    z-index: 1;
}

/* ===== КОНТЕНТ ===== */
.business__content {
    position: relative;
    z-index: 2;
}

.business__header {
    text-align: center;
    max-width: 800px;
    margin: 0 auto 48px;
}

.business__tag {
    display: inline-block;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 1.5px;
    color: white;
    text-transform: uppercase;
    padding: 6px 16px;
    border: 1px solid rgba(255,255,255,0.25);
    border-radius: 50px;
    margin-bottom: 16px;
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(4px);
}

.business__title {
    font-size: 42px;
    font-weight: 700;
    margin: 0 0 16px;
    text-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
}

.business__subtitle {
    font-size: 18px;
    opacity: 0.9;
    line-height: 1.6;
    margin: 0 0 24px;
    text-shadow: 0 2px 20px rgba(0, 0, 0, 0.2);
}

.business__features {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    max-width: 900px;
    margin: 0 auto;
}

.business__feature {
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(8px);
    border-radius: var(--radius);
    padding: 28px;
    border: 1px solid rgba(255, 255, 255, 0.12);
    transition: all 0.3s ease;
}

.business__feature:hover {
    background: rgba(255, 255, 255, 0.15);
    transform: translateY(-4px);
}

.business__feature h3 {
    font-size: 18px;
    font-weight: 700;
    margin: 0 0 8px;
    color: white;
}

.business__feature p {
    font-size: 14px;
    opacity: 0.85;
    line-height: 1.6;
    margin: 0;
    color: white;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 1024px) {
    .business__title {
        font-size: 36px;
    }
}

@media (max-width: 768px) {
    .business {
        padding: 48px 0;
    }

    .business__header {
        margin-bottom: 32px;
    }

    .business__title {
        font-size: 26px;
    }

    .business__subtitle {
        font-size: 15px;
    }

    .business__features {
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    .business__feature {
        padding: 20px 16px;
    }

    .business__feature h3 {
        font-size: 15px;
    }

    .business__feature p {
        font-size: 13px;
    }
}

@media (max-width: 480px) {
    .business {
        padding: 36px 0;
    }

    .business__title {
        font-size: 22px;
    }

    .business__subtitle {
        font-size: 14px;
    }

    .business__features {
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .business__feature {
        padding: 14px 12px;
    }

    .business__feature h3 {
        font-size: 13px;
        margin-bottom: 5px;
    }

    .business__feature p {
        font-size: 12px;
        line-height: 1.5;
    }
}
</style>
