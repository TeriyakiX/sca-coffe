/**
 * Ссылки внутри HTML-контента (новости, страницы) — обычные <a>,
 * поэтому браузер перезагружает страницу целиком. Директива перехватывает
 * клики по внутренним ссылкам и отдаёт их роутеру.
 */
const isInternal = (anchor) => {
    if (!anchor || anchor.target === '_blank' || anchor.hasAttribute('download')) {
        return false
    }

    const href = anchor.getAttribute('href') ?? ''

    return href.startsWith('/') && !href.startsWith('//')
}

export const createInternalLinks = (router) => ({
    mounted(el) {
        el.__internalLinksHandler = (event) => {
            if (event.defaultPrevented || event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
                return
            }

            const anchor = event.target.closest('a')

            if (!isInternal(anchor) || !el.contains(anchor)) {
                return
            }

            event.preventDefault()
            router.push(anchor.getAttribute('href'))
        }

        el.addEventListener('click', el.__internalLinksHandler)
    },

    unmounted(el) {
        el.removeEventListener('click', el.__internalLinksHandler)
        delete el.__internalLinksHandler
    },
})
