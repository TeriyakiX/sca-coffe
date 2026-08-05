<?php

declare(strict_types=1);

namespace Database\Seeders\Concerns;

use Illuminate\Database\Eloquent\Model;

/**
 * Модели контента используют мягкое удаление, а уникальные индексы
 * по slug и key про deleted_at не знают. Из-за этого обычный updateOrCreate
 * не находит удалённую запись и падает на вставке дубля.
 *
 * Состояние удаления намеренно не меняем: если запись убрали через админку,
 * сидер обновит её содержимое, но не вернёт на сайт.
 */
trait UpsertsSoftDeleted
{
    /**
     * @param class-string<Model> $model
     */
    protected function upsertRecord(string $model, array $attributes, array $values = []): Model
    {
        $existing = $model::query()
            ->withTrashed()
            ->where($attributes)
            ->first();

        if ($existing) {
            $existing->fill($values)->save();

            return $existing;
        }

        return $model::query()->create($attributes + $values);
    }
}
