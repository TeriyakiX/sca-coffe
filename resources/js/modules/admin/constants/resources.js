import {
    adminAccreditation,
    adminBlocks,
    adminContact,
    adminEvents,
    adminMembership,
    adminNews,
    adminPages,
    adminPartners,
} from '@/shared/api/admin'

const publicationStatuses = [
    { value: 'draft', label: 'Черновик' },
    { value: 'published', label: 'Опубликовано' },
    { value: 'archived', label: 'В архиве' },
]

const applicationStatuses = [
    { value: 'new', label: 'Новая' },
    { value: 'in_review', label: 'В работе' },
    { value: 'approved', label: 'Одобрена' },
    { value: 'rejected', label: 'Отклонена' },
]

const toMap = (options) =>
    options.reduce((acc, option) => {
        acc[option.value] = option.label

        return acc
    }, {})

const publicationMap = toMap(publicationStatuses)
const applicationMap = toMap(applicationStatuses)

const newsCategories = [
    { value: 'association', label: 'Новости Ассоциации' },
    { value: 'standards', label: 'Профессиональные стандарты' },
    { value: 'education', label: 'Образование и аккредитация' },
    { value: 'coffee-ru', label: 'Кофейная индустрия России' },
    { value: 'tea-ru', label: 'Чайная индустрия России' },
    { value: 'international', label: 'Международные новости' },
    { value: 'events', label: 'Мероприятия и чемпионаты' },
    { value: 'interviews', label: 'Интервью и экспертные материалы' },
    { value: 'regulation', label: 'Регулирование и документы' },
]

const eventTypes = [
    { value: 'conference', label: 'Конференция' },
    { value: 'seminar', label: 'Семинар' },
    { value: 'working-group', label: 'Рабочая группа' },
    { value: 'championship', label: 'Чемпионат' },
    { value: 'webinar', label: 'Вебинар' },
]

const partnerCategories = [
    { value: 'equipment', label: 'Производители оборудования' },
    { value: 'roastery', label: 'Обжарочные компании' },
    { value: 'supplier', label: 'Поставщики кофе и чая' },
    { value: 'service', label: 'Сервисные компании' },
    { value: 'education', label: 'Учебные центры' },
    { value: 'media', label: 'Медиа и отраслевые площадки' },
]

const contentSections = [
    { value: 'home', label: 'Главная' },
    { value: 'association', label: 'Ассоциация' },
    { value: 'standards', label: 'Профстандарты' },
    { value: 'membership', label: 'Членство' },
    { value: 'accreditation', label: 'Аккредитация' },
    { value: 'education', label: 'Обучение и квалификации' },
    { value: 'registries', label: 'Реестры' },
    { value: 'partners', label: 'Партнёры' },
    { value: 'contacts', label: 'Контакты' },
]

export const newsResource = {
    title: 'Новости',
    api: adminNews,
    columns: [
        { key: 'title', label: 'Заголовок' },
        { key: 'category_label', label: 'Категория' },
        { key: 'status', label: 'Статус', map: publicationMap },
        { key: 'published_at', label: 'Публикация', format: 'date' },
    ],
    fields: [
        { key: 'title', label: 'Заголовок', required: true },
        { key: 'slug', label: 'Адрес латиницей', required: true },
        { key: 'category', label: 'Категория', type: 'select', options: newsCategories, required: true },
        { key: 'status', label: 'Статус', type: 'select', options: publicationStatuses },
        { key: 'excerpt', label: 'Краткое описание', type: 'textarea', required: true },
        { key: 'content', label: 'Полный текст', type: 'textarea' },
        { key: 'cover_url', label: 'Ссылка на обложку' },
        {
            key: 'published_at',
            label: 'Дата публикации',
            type: 'datetime-local',
            hint: 'Если указать будущую дату, материал появится на сайте в это время',
        },
    ],
}

export const eventsResource = {
    title: 'Мероприятия',
    api: adminEvents,
    columns: [
        { key: 'title', label: 'Название' },
        { key: 'type_label', label: 'Тип' },
        { key: 'place', label: 'Место' },
        { key: 'starts_at', label: 'Начало', format: 'date' },
        { key: 'status', label: 'Статус', map: publicationMap },
    ],
    fields: [
        { key: 'title', label: 'Название', required: true },
        { key: 'slug', label: 'Адрес латиницей', required: true },
        { key: 'type', label: 'Тип', type: 'select', options: eventTypes, required: true },
        { key: 'status', label: 'Статус', type: 'select', options: publicationStatuses },
        { key: 'starts_at', label: 'Начало', type: 'datetime-local', required: true },
        { key: 'ends_at', label: 'Окончание', type: 'datetime-local' },
        { key: 'place', label: 'Место проведения' },
        { key: 'description', label: 'Описание', type: 'textarea' },
        { key: 'registration_url', label: 'Ссылка на регистрацию' },
    ],
}

export const partnersResource = {
    title: 'Партнёры',
    api: adminPartners,
    columns: [
        { key: 'name', label: 'Название' },
        { key: 'category_label', label: 'Категория' },
        { key: 'status', label: 'Статус', map: publicationMap },
    ],
    fields: [
        { key: 'name', label: 'Название', required: true },
        { key: 'slug', label: 'Адрес латиницей', required: true },
        { key: 'category', label: 'Категория', type: 'select', options: partnerCategories, required: true },
        { key: 'status', label: 'Статус', type: 'select', options: publicationStatuses },
        { key: 'description', label: 'Описание', type: 'textarea' },
        { key: 'benefit', label: 'Бонус для членов', type: 'textarea' },
        { key: 'logo_url', label: 'Ссылка на логотип' },
        { key: 'site_url', label: 'Сайт' },
        { key: 'sort_order', label: 'Порядок сортировки', cast: 'number' },
    ],
}

export const pagesResource = {
    title: 'Страницы',
    api: adminPages,
    columns: [
        { key: 'title', label: 'Заголовок' },
        { key: 'slug', label: 'Адрес' },
        { key: 'status', label: 'Статус', map: publicationMap },
        { key: 'sort_order', label: 'Порядок' },
    ],
    fields: [
        { key: 'title', label: 'Заголовок', required: true },
        { key: 'slug', label: 'Адрес латиницей', required: true },
        { key: 'status', label: 'Статус', type: 'select', options: publicationStatuses },
        { key: 'content', label: 'Содержимое (HTML)', type: 'textarea' },
        { key: 'sort_order', label: 'Порядок сортировки', cast: 'number' },
    ],
}

export const blocksResource = {
    title: 'Блоки страниц',
    api: adminBlocks,
    creatable: false,
    deletable: false,
    columns: [
        { key: 'section', label: 'Раздел', map: toMap(contentSections) },
        { key: 'title', label: 'Заголовок' },
        { key: 'items', label: 'Элементы' },
        { key: 'key', label: 'Ключ' },
    ],
    fields: [
        { key: 'title', label: 'Заголовок' },
        { key: 'subtitle', label: 'Подзаголовок', type: 'textarea' },
        { key: 'body', label: 'Текст', type: 'textarea' },
        { key: 'items', label: 'Элементы блока', type: 'json' },
        { key: 'sort_order', label: 'Порядок сортировки', cast: 'number' },
    ],
}

export const membershipResource = {
    title: 'Заявки на вступление',
    api: adminMembership,
    creatable: false,
    deletable: false,
    columns: [
        { key: 'name', label: 'Заявитель' },
        { key: 'category_label', label: 'Категория' },
        { key: 'email', label: 'Email' },
        { key: 'phone', label: 'Телефон', nowrap: true },
        { key: 'city', label: 'Город' },
        { key: 'status', label: 'Статус', map: applicationMap },
        { key: 'created_at', label: 'Создана', format: 'date' },
    ],
    fields: [
        { key: 'status', label: 'Статус', type: 'select', options: applicationStatuses },
        { key: 'manager_comment', label: 'Комментарий менеджера', type: 'textarea' },
    ],
}

export const accreditationResource = {
    title: 'Заявки на аккредитацию',
    api: adminAccreditation,
    creatable: false,
    deletable: false,
    columns: [
        { key: 'organization', label: 'Организация' },
        { key: 'type_label', label: 'Тип' },
        { key: 'contact_name', label: 'Контакт' },
        { key: 'email', label: 'Email' },
        { key: 'status', label: 'Статус', map: applicationMap },
        { key: 'created_at', label: 'Создана', format: 'date' },
    ],
    fields: [
        { key: 'status', label: 'Статус', type: 'select', options: applicationStatuses },
        { key: 'manager_comment', label: 'Комментарий менеджера', type: 'textarea' },
    ],
}

export const contactsResource = {
    title: 'Обращения',
    api: adminContact,
    creatable: false,
    deletable: false,
    columns: [
        { key: 'name', label: 'Имя' },
        { key: 'topic_label', label: 'Тема' },
        { key: 'email', label: 'Email' },
        { key: 'status', label: 'Статус', map: applicationMap },
        { key: 'created_at', label: 'Создано', format: 'date' },
    ],
    fields: [
        { key: 'status', label: 'Статус', type: 'select', options: applicationStatuses },
        { key: 'manager_comment', label: 'Комментарий менеджера', type: 'textarea' },
    ],
}
