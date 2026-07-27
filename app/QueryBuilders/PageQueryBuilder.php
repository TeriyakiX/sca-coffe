<?php

declare(strict_types=1);

namespace App\QueryBuilders;

use App\Enums\General\PublicationStatusEnum;
use App\Models\Page;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Page
 */
final class PageQueryBuilder extends Builder
{
    public final function published(): self
    {
        return $this->where(Page::STATUS, PublicationStatusEnum::PUBLISHED->value);
    }

    public final function bySlug(string $slug): self
    {
        return $this->where(Page::SLUG, $slug);
    }

    public final function ordered(): self
    {
        return $this->orderBy(Page::SORT_ORDER)->orderBy(Page::TITLE);
    }
}
