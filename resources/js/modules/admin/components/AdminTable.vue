<template>
    <div class="admin-table__wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th v-for="col in columns" :key="col.key">{{ col.label }}</th>
                    <th v-if="$slots.actions" class="admin-table__actions-head"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="row in rows" :key="row.id">
                    <td v-for="col in columns" :key="col.key" :data-label="col.label">
                        <slot :name="`cell-${col.key}`" :row="row">{{ row[col.key] }}</slot>
                    </td>
                    <td v-if="$slots.actions" class="admin-table__actions">
                        <slot name="actions" :row="row" />
                    </td>
                </tr>
                <tr v-if="!rows.length">
                    <td :colspan="columns.length + 1" class="admin-table__empty">Записей нет</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script setup>
defineProps({
    columns: { type: Array, required: true },
    rows: { type: Array, default: () => [] },
})
</script>
<style scoped>
.admin-table__wrap {
    overflow-x: auto;
    background: var(--color-white);
    border: 1px solid rgba(0, 0, 0, 0.07);
    border-radius: var(--radius);
}

.admin-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

.admin-table th {
    text-align: left;
    padding: 14px 16px;
    white-space: nowrap;
    font-size: 11.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--color-gray);
    border-bottom: 1px solid rgba(0, 0, 0, 0.07);
    white-space: nowrap;
}

.admin-table td {
    padding: 16px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    vertical-align: middle;
    color: var(--color-text);
    line-height: 1.5;
}

.admin-table tr:last-child td { border-bottom: none; }

.admin-table__actions {
    text-align: right;
    white-space: nowrap;
    padding-left: 24px;
}

.admin-table__actions > * + * { margin-left: 10px; }
.admin-table__actions-head { width: 1%; }

.admin-table__actions :deep(.btn--sm) {
    min-height: 38px;
    padding: 0 18px;
}

/* Широкие таблицы скроллятся, но кнопки действий всегда остаются на виду */
@media (min-width: 1101px) {
    .admin-table__actions,
    .admin-table__actions-head {
        position: sticky;
        right: 0;
        z-index: 1;
        background: var(--color-white);
    }
}

.admin-table__empty {
    text-align: center;
    color: var(--color-gray);
    padding: 32px 16px;
}

/* Между планшетом и широким монитором таблица уплотняется, чтобы
   колонка действий не уезжала в горизонтальный скролл */
@media (max-width: 1300px) and (min-width: 1101px) {
    .admin-table { font-size: 13.5px; }
    .admin-table th { padding: 13px 12px; }
    .admin-table td { padding: 14px 12px; }
    .admin-table__actions { padding-left: 18px; }
    .admin-table__actions > * + * { margin-left: 8px; }
    .admin-table__actions :deep(.btn--sm) { padding: 0 15px; }
}

@media (max-width: 1100px) {
    .admin-table__wrap {
        border: none;
        background: transparent;
        overflow-x: visible;
    }

    .admin-table,
    .admin-table tbody,
    .admin-table tr,
    .admin-table td {
        display: block;
        width: 100%;
    }

    .admin-table thead { display: none; }

    .admin-table tr {
        background: var(--color-white);
        border: 1px solid rgba(0, 0, 0, 0.07);
        border-radius: var(--radius);
        padding: 6px 4px;
        margin-bottom: 12px;
    }

    .admin-table td {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        gap: 12px;
        padding: 10px 14px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        font-size: 14px;
    }

    .admin-table td:last-of-type { border-bottom: none; }

    .admin-table td::before {
        content: attr(data-label);
        flex: 0 0 auto;
        max-width: 45%;
        min-width: 0;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: var(--color-gray);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .admin-table td:not(.admin-table__actions) > * {
        min-width: 0;
        flex: 1 1 auto;
        text-align: right;
        overflow-wrap: break-word;
        word-break: normal;
    }

    /* Одна разделительная линия перед кнопками, а не две подряд */
    .admin-table td:nth-last-of-type(2) { border-bottom: none; }

    .admin-table td.admin-table__actions {
        display: grid;
        grid-auto-flow: column;
        grid-auto-columns: 1fr;
        gap: 10px;
        border-bottom: none;
        border-top: 1px solid rgba(0, 0, 0, 0.06);
        margin-top: 4px;
        padding: 12px 14px;
    }

    .admin-table td.admin-table__actions::before { display: none; }

    .admin-table td.admin-table__actions > * {
        width: 100%;
        margin: 0;
    }

    .admin-table__empty {
        background: var(--color-white);
        border-radius: var(--radius);
        justify-content: center;
        border-bottom: none;
    }

    .admin-table__empty::before { content: none; display: none; }
}
</style>
