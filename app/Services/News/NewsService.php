<?php

declare(strict_types=1);

namespace App\Services\News;

use App\DTOs\News\NewsCreateDto;
use App\DTOs\News\NewsListDto;
use App\DTOs\News\NewsUpdateDto;
use App\Exceptions\News\NewsDeleteFailedException;
use App\Exceptions\News\NewsNotFoundException;
use App\Exceptions\News\NewsUpdateEmptyDataException;
use App\Exceptions\News\NewsUpdateFailedException;
use App\Models\News;
use App\Repositories\NewsRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final readonly class NewsService
{
    public final function __construct(
        private NewsRepository $repository,
    )
    {
    }

    public final function list(NewsListDto $dto): LengthAwarePaginator
    {
        return $this->repository->publishedList($dto);
    }

    public final function adminList(NewsListDto $dto): LengthAwarePaginator
    {
        return $this->repository->adminList($dto);
    }

    /**
     * @throws NewsNotFoundException
     */
    public final function item(string $slug): News
    {
        return $this->repository->publishedBySlug($slug) ?? throw new NewsNotFoundException();
    }

    public final function create(NewsCreateDto $dto): News
    {
        return $this->repository->create($dto);
    }

    /**
     * @throws NewsUpdateEmptyDataException|NewsNotFoundException|NewsUpdateFailedException
     */
    public final function update(News|string $news, NewsUpdateDto $dto): News
    {
        if (empty($dto->toArray())) {
            throw new NewsUpdateEmptyDataException();
        }

        if (is_string($news) && !$news = $this->repository->item($news)) {
            throw new NewsNotFoundException();
        }

        return $this->repository->update($news, $dto) ?? throw new NewsUpdateFailedException();
    }

    /**
     * @throws NewsNotFoundException|NewsDeleteFailedException
     */
    public final function delete(News|string $news): bool
    {
        if (is_string($news) && !$news = $this->repository->item($news)) {
            throw new NewsNotFoundException();
        }

        return $this->repository->delete($news) ?: throw new NewsDeleteFailedException();
    }
}
