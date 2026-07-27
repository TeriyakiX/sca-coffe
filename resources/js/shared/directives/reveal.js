const REVEAL_CLASS = 'is-revealed'

const prefersReducedMotion = () =>
    window.matchMedia('(prefers-reduced-motion: reduce)').matches

let observer = null

const getObserver = () => {
    if (observer) {
        return observer
    }

    observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return
                }

                entry.target.classList.add(REVEAL_CLASS)
                observer.unobserve(entry.target)
            })
        },
        { rootMargin: '0px 0px -12% 0px', threshold: 0.08 },
    )

    return observer
}

export const reveal = {
    mounted(el, binding) {
        if (prefersReducedMotion() || !('IntersectionObserver' in window)) {
            el.classList.add(REVEAL_CLASS)

            return
        }

        el.classList.add('reveal')

        if (binding.value?.delay) {
            el.style.setProperty('--reveal-delay', `${binding.value.delay}ms`)
        }

        if (binding.modifiers.stagger) {
            Array.from(el.children).forEach((child, index) => {
                child.classList.add('reveal-child')
                child.style.setProperty('--reveal-index', String(index))
            })
        }

        getObserver().observe(el)
    },

    unmounted(el) {
        observer?.unobserve(el)
    },
}
