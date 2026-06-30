// resources/js/modules/events/constants/eventStatus.js
export const EVENT_STATUS = {
    UPCOMING: 'upcoming',
    ONGOING: 'ongoing',
    PAST: 'past'
}

export const EVENT_STATUS_LABELS = {
    [EVENT_STATUS.UPCOMING]: 'Предстоящее',
    [EVENT_STATUS.ONGOING]: 'В процессе',
    [EVENT_STATUS.PAST]: 'Завершено'
}

export const EVENT_STATUS_COLORS = {
    [EVENT_STATUS.UPCOMING]: 'success',
    [EVENT_STATUS.ONGOING]: 'warning',
    [EVENT_STATUS.PAST]: 'danger'
}
