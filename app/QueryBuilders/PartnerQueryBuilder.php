<?php

declare(strict_types=1);

namespace App\QueryBuilders;

use App\Enums\General\PublicationStatusEnum;
use App\Models\Partner;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Partner
 */
final class PartnerQueryBuilder extends Builder
{
    public final function published(): self
    {
        return $this->where(Partner::STATUS, PublicationStatusEnum::PUBLISHED->value);
    }

    public final function byCategory(string $category): self
    {
        return $this->where(Partner::CATEGORY, $category);
    }

    public final function bySlug(string $slug): self
    {
        return $this->where(Partner::SLUG, $slug);
    }

    public final function ordered(): self
    {
        return $this->orderBy(Partner::SORT_ORDER)->orderBy(Partner::NAME);
    }
}
