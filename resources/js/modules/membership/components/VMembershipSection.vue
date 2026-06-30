<template>
    <section id="membership" class="membership">
        <div class="membership__video-wrapper">
            <video
                ref="videoRef"
                class="membership__video"
                autoplay
                muted
                loop
                playsinline
                preload="auto"
            >
                <source src="/videos/membership-bg.mp4" type="video/mp4" />
            </video>
            <div class="membership__overlay"></div>
        </div>

        <div class="container">
            <div class="membership__content">
                <div class="membership__header">
                    <span class="membership__tag">ЧЛЕНСТВО</span>
                    <h2 class="membership__title">Станьте членом ассоциации</h2>
                    <p class="membership__subtitle">
                        Получите доступ к отраслевым ресурсам, наладьте связи с профессионалами
                        кофейной и чайной индустрии, развивайте свою карьеру или бизнес.
                    </p>
                    <div class="membership__actions">
                        <VButton size="large" @click="goToJoin" class="membership__btn">Стать членом</VButton>
                        <VButton variant="outline-light" size="large" @click="goToAbout" class="membership__btn">Узнать больше</VButton>
                    </div>
                </div>

                <div class="membership__features">
                    <div v-for="feature in features" :key="feature.id" class="membership__feature">
                        <div class="membership__feature-icon">
                            <VIcon :name="feature.icon" size="large" />
                        </div>
                        <h3 class="membership__feature-title">{{ feature.title }}</h3>
                        <p class="membership__feature-text">{{ feature.text }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import VButton from '@/shared/components/ui/VButton.vue'
import VIcon from '@/shared/components/ui/VIcon.vue'
import { router } from '@inertiajs/vue3'

const videoRef = ref(null)

onMounted(() => {
    if (videoRef.value) {
        videoRef.value.play().catch(() => {})
    }
})

const features = [
    { id: 1, icon: 'globe', title: 'Мировое сообщество', text: 'Присоединяйтесь к глобальной сети профессионалов кофейной и чайной индустрии.' },
    { id: 2, icon: 'book', title: 'Исследования и ресурсы', text: 'Доступ к отраслевым отчетам, стандартам и практическим инструментам.' },
    { id: 3, icon: 'trophy', title: 'Развитие и признание', text: 'Повысьте свой авторитет с помощью образовательных программ и сертификации.' }
]

const goToJoin = () => router.get('/membership/join')
const goToAbout = () => router.get('/about')
</script>

<style scoped>
.membership {
    position: relative;
    padding: 80px 0;
    color: white;
    overflow: hidden;
    display: flex;
    align-items: center;
    background: linear-gradient(135deg, #2d9359 0%, #1f6b3f 45%, #693c26 100%);
}

.membership__video-wrapper {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
}

.membership__video {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 100%;
    height: 100%;
    min-width: 100%;
    min-height: 100%;
    transform: translate(-50%, -50%);
    object-fit: cover;
}

.membership__overlay {
    position: absolute;
    inset: 0;
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

.membership__content {
    position: relative;
    z-index: 2;
    max-width: 1000px;
    margin: 0 auto;
    text-align: center;
    padding: 0 20px;
    width: 100%;
}

.membership__tag {
    display: inline-block;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    padding: 4px 16px;
    border: 1px solid rgba(255, 255, 255, 0.25);
    border-radius: 50px;
    margin-bottom: 16px;
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(4px);
}

.membership__title {
    font-size: 36px;
    font-weight: 700;
    margin: 0 0 12px;
    line-height: 1.1;
    text-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
}

.membership__subtitle {
    font-size: 16px;
    opacity: 0.9;
    max-width: 600px;
    margin: 0 auto 28px;
    line-height: 1.5;
    text-shadow: 0 2px 20px rgba(0, 0, 0, 0.2);
}

.membership__actions {
    display: flex;
    gap: 12px;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 40px;
}

.membership__btn {
    min-width: 160px;
}

.membership__features {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    padding-top: 32px;
    border-top: 1px solid rgba(255, 255, 255, 0.12);
}

.membership__feature {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.membership__feature-icon {
    display: flex;
    justify-content: center;
    margin-bottom: 10px;
    color: white;
}

.membership__feature-icon svg {
    stroke: white;
    width: 32px;
    height: 32px;
}

.membership__feature-title {
    font-size: 16px;
    font-weight: 700;
    margin: 0 0 6px;
}

.membership__feature-text {
    font-size: 13px;
    opacity: 0.85;
    line-height: 1.5;
    margin: 0 auto;
    max-width: 280px;
}

/* ============================================
   АДАПТИВ
   ============================================ */

@media (max-width: 992px) {
    .membership { padding: 64px 0; }
    .membership__title { font-size: 30px; }
    .membership__features { gap: 20px; }
}

@media (max-width: 768px) {
    .membership { padding: 56px 0; }

    .membership__title { font-size: 26px; }

    .membership__subtitle {
        font-size: 15px;
        margin-bottom: 24px;
    }

    .membership__actions {
        gap: 10px;
        margin-bottom: 32px;
    }

    .membership__btn {
        min-width: unset;
        width: 100%;
        max-width: 260px;
        padding: 12px 20px !important;
        font-size: 14px !important;
    }

    /* Ключевое исправление — убираем padding с контента,
       даём контейнеру сам управлять отступами */
    .membership__content {
        padding: 0 16px;
    }

    .membership__features {
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 8px;
        padding-top: 24px;
    }

    .membership__feature-icon {
        display: none;
    }

    .membership__feature {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 10px;
        padding: 12px 8px;
        min-width: 0;
    }

    .membership__feature-title {
        font-size: 12px;
        margin-bottom: 5px;
        word-break: break-word;
    }

    .membership__feature-text {
        font-size: 11px;
        max-width: 100%;
        line-height: 1.4;
        opacity: 0.8;
        word-break: break-word;
    }
}

@media (max-width: 480px) {
    .membership { padding: 44px 0; }

    .membership__content {
        padding: 0 12px;
    }

    .membership__tag {
        font-size: 10px;
        padding: 3px 12px;
        margin-bottom: 12px;
    }

    .membership__title { font-size: 22px; }

    .membership__subtitle {
        font-size: 14px;
        margin-bottom: 20px;
    }

    .membership__actions {
        flex-direction: column;
        align-items: center;
        gap: 10px;
        margin-bottom: 28px;
    }

    .membership__btn {
        max-width: 280px;
        padding: 13px 18px !important;
        font-size: 14px !important;
    }

    .membership__features {
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 6px;
        padding-top: 20px;
    }

    .membership__feature {
        padding: 10px 6px;
    }

    .membership__feature-title {
        font-size: 11px;
        margin-bottom: 4px;
    }

    .membership__feature-text {
        font-size: 10px;
        line-height: 1.4;
    }
}
</style>
