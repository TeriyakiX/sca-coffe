import http, { unwrap } from './http'

export const login = async (payload) => unwrap(await http.post('/auth/login', payload))

export const logout = async () => http.post('/auth/logout')

export const me = async () => unwrap(await http.get('/auth/me'))

const crud = (resource) => ({
    list: async (params = {}) => unwrap(await http.get(`/admin/${resource}`, { params })),
    create: async (payload) => unwrap(await http.post(`/admin/${resource}`, payload)),
    update: async (id, payload) => unwrap(await http.put(`/admin/${resource}/${id}`, payload)),
    remove: async (id) => http.delete(`/admin/${resource}/${id}`),
})

export const adminNews = crud('news')
export const adminEvents = crud('events')
export const adminPartners = crud('partners')
export const adminPages = crud('pages')
export const adminBlocks = crud('content/blocks')
export const adminMembership = crud('membership/applications')
export const adminAccreditation = crud('accreditation/applications')
export const adminContact = crud('contact/requests')
