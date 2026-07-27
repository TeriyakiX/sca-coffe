import http, { unwrap } from './http'

export const fetchContentBlocks = async (section) => {
    const response = await http.get('/content/blocks', { params: { section } })

    return unwrap(response) ?? []
}

export const fetchPages = async () => unwrap(await http.get('/pages')) ?? []

export const fetchPage = async (slug) => unwrap(await http.get(`/pages/${slug}`))
