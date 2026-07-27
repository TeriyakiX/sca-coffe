import { onMounted, ref } from 'vue'
import { fetchContentBlocks } from '@/shared/api/content'

export const useContentBlocks = (section) => {
    const blocks = ref({})
    const loading = ref(true)
    const failed = ref(false)

    const load = async () => {
        loading.value = true
        failed.value = false

        try {
            const list = await fetchContentBlocks(section)

            blocks.value = list.reduce((acc, block) => {
                acc[block.key] = block

                return acc
            }, {})
        } catch (e) {
            failed.value = true
        } finally {
            loading.value = false
        }
    }

    const block = (key) => blocks.value[key] ?? { title: '', subtitle: '', body: '', items: [] }

    const items = (key) => block(key).items ?? []

    onMounted(load)

    return { blocks, block, items, loading, failed, load }
}
