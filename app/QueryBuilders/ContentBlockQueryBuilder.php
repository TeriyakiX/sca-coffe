<?php

declare(strict_types=1);

namespace App\QueryBuilders;

use App\Models\ContentBlock;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin ContentBlock
 */
final class ContentBlockQueryBuilder extends Builder
{
    public final function bySection(string $section): self
    {
        return $this->where(ContentBlock::SECTION, $section);
    }

    public final function byKey(string $key): self
    {
        return $this->where(ContentBlock::KEY, $key);
    }

    public final function ordered(): self
    {
        return $this->orderBy(ContentBlock::SORT_ORDER)->orderBy(ContentBlock::KEY);
    }
}
