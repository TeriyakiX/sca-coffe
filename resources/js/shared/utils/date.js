export const formatDate = (value) => {
    if (!value) {
        return ''
    }

    return new Date(value).toLocaleDateString('ru-RU', {
        day: 'numeric',
        month: 'long',
        year: 'numeric',
    })
}
