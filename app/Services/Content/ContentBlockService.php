<?php

declare(strict_types=1);

namespace App\Services\Content;

use App\DTOs\Content\ContentBlockUpdateDto;
use App\Exceptions\Content\ContentBlockNotFoundException;
use App\Exceptions\Content\ContentBlockUpdateEmptyDataException;
use App\Exceptions\Content\ContentBlockUpdateFailedException;
use App\Models\ContentBlock;
use App\Repositories\ContentBlockRepository;
use Illuminate\Database\Eloquent\Collection;

final readonly class ContentBlockService
{
    public final function __construct(
        private ContentBlockRepository $repository,
    )
    {
    }

    public final function list(string|null $section = null): Collection
    {
        return $this->repository->list($section);
    }

    /**
     * @throws ContentBlockNotFoundException
     */
    public final function item(string $blockId): ContentBlock
    {
        return $this->repository->item($blockId) ?? throw new ContentBlockNotFoundException();
    }

    /**
     * @throws ContentBlockUpdateEmptyDataException|ContentBlockNotFoundException|ContentBlockUpdateFailedException
     */
    public final function update(ContentBlock|string $block, ContentBlockUpdateDto $dto): ContentBlock
    {
        if (empty($dto->toArray())) {
            throw new ContentBlockUpdateEmptyDataException();
        }

        if (is_string($block) && !$block = $this->repository->item($block)) {
            throw new ContentBlockNotFoundException();
        }

        return $this->repository->update($block, $dto) ?? throw new ContentBlockUpdateFailedException();
    }
}
