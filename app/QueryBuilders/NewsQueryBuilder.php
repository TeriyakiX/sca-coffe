<?php

declare(strict_types=1);

namespace App\QueryBuilders;

use App\Enums\General\PublicationStatusEnum;
use App\Models\News;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin News
 */
final class NewsQueryBuilder extends Builder
{
    public final function search(string $search): self
    {
        $words = explode(' ', $search);

        return $this->where(function (self $builder) use ($words) {
            foreach ($words as $index => $word) {
                $method = $index === 0 ? 'where' : 'orWhere';

                $builder->$method(News::TITLE, 'LIKE', "%$word%")
                    ->orWhere(News::EXCERPT, 'LIKE', "%$word%");
            }
        });
    }

    public final function byCategory(string $category): self
    {
        return $this->where(News::CATEGORY, $category);
    }

    public final function byCategories(array $categories): self
    {
        return $this->whereIn(News::CATEGORY, $categories);
    }

    public final function byStatus(string $status): self
    {
        return $this->where(News::STATUS, $status);
    }

    public final function bySlug(string $slug): self
    {
        return $this->where(News::SLUG, $slug);
    }

    public final function published(): self
    {
        return $this->where(News::STATUS, PublicationStatusEnum::PUBLISHED->value)
            ->whereNotNull(News::PUBLISHED_AT)
            ->where(News::PUBLISHED_AT, '<=', now());
    }

    public final function latestPublished(): self
    {
        return $this->orderByDesc(News::PUBLISHED_AT);
    }
}
