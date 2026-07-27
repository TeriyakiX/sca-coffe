import http, { unwrap } from './http'

export const fetchNews = async (params = {}) => unwrap(await http.get('/news', { params }))

export const fetchNewsItem = async (slug) => unwrap(await http.get(`/news/${slug}`))

export const fetchEvents = async (params = {}) => unwrap(await http.get('/events', { params }))

export const fetchEventItem = async (slug) => unwrap(await http.get(`/events/${slug}`))

export const fetchPartners = async (params = {}) => unwrap(await http.get('/partners', { params })) ?? []

export const sendMembershipApplication = async (payload) =>
    unwrap(await http.post('/membership/applications', payload))

export const sendAccreditationApplication = async (payload) =>
    unwrap(await http.post('/accreditation/applications', payload))

export const sendContactRequest = async (payload) =>
    unwrap(await http.post('/contact/requests', payload))
