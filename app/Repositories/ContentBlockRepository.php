<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTOs\Content\ContentBlockUpdateDto;
use App\Models\ContentBlock;
use App\QueryBuilders\ContentBlockQueryBuilder;
use Illuminate\Database\Eloquent\Collection;

final readonly class ContentBlockRepository
{
    public final function list(string|null $section = null): Collection
    {
        return ContentBlock::query()
            ->when($section, fn(ContentBlockQueryBuilder $builder) => $builder->bySection($section))
            ->ordered()
            ->get();
    }

    public final function item(string $blockId): ContentBlock|null
    {
        return ContentBlock::query()->find($blockId);
    }

    public final function update(ContentBlock $block, ContentBlockUpdateDto $dto): ContentBlock|null
    {
        return $block->update($dto->toArray())
            ? $block
            : null;
    }
}
