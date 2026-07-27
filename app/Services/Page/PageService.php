<?php

declare(strict_types=1);

namespace App\Services\Page;

use App\DTOs\Page\PageCreateDto;
use App\DTOs\Page\PageUpdateDto;
use App\Exceptions\Page\PageDeleteFailedException;
use App\Exceptions\Page\PageNotFoundException;
use App\Exceptions\Page\PageUpdateEmptyDataException;
use App\Exceptions\Page\PageUpdateFailedException;
use App\Models\Page;
use App\Repositories\PageRepository;
use Illuminate\Database\Eloquent\Collection;

final readonly class PageService
{
    public final function __construct(
        private PageRepository $repository,
    )
    {
    }

    public final function list(): Collection
    {
        return $this->repository->publishedList();
    }

    public final function adminList(): Collection
    {
        return $this->repository->allList();
    }

    /**
     * @throws PageNotFoundException
     */
    public final function item(string $slug): Page
    {
        return $this->repository->publishedBySlug($slug) ?? throw new PageNotFoundException();
    }

    public final function create(PageCreateDto $dto): Page
    {
        return $this->repository->create($dto);
    }

    /**
     * @throws PageUpdateEmptyDataException|PageNotFoundException|PageUpdateFailedException
     */
    public final function update(Page|string $page, PageUpdateDto $dto): Page
    {
        if (empty($dto->toArray())) {
            throw new PageUpdateEmptyDataException();
        }

        if (is_string($page) && !$page = $this->repository->item($page)) {
            throw new PageNotFoundException();
        }

        return $this->repository->update($page, $dto) ?? throw new PageUpdateFailedException();
    }

    /**
     * @throws PageNotFoundException|PageDeleteFailedException
     */
    public final function delete(Page|string $page): bool
    {
        if (is_string($page) && !$page = $this->repository->item($page)) {
            throw new PageNotFoundException();
        }

        return $this->repository->delete($page) ?: throw new PageDeleteFailedException();
    }
}
