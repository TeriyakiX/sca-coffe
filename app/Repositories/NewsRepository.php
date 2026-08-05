<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTOs\News\NewsCreateDto;
use App\DTOs\News\NewsListDto;
use App\DTOs\News\NewsUpdateDto;
use App\Models\News;
use App\QueryBuilders\NewsQueryBuilder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final readonly class NewsRepository
{
    public final function publishedList(NewsListDto $dto): LengthAwarePaginator
    {
        return News::query()
            ->published()
            ->when($dto->search, fn(NewsQueryBuilder $builder) => $builder->search($dto->search))
            ->when($dto->category, fn(NewsQueryBuilder $builder) => $builder->byCategory($dto->category))
            ->when($dto->categories, fn(NewsQueryBuilder $builder) => $builder->byCategories($dto->categories))
            ->latestPublished()
            ->paginate($dto->perPage);
    }

    public final function adminList(NewsListDto $dto): LengthAwarePaginator
    {
        return News::query()
            ->when($dto->search, fn(NewsQueryBuilder $builder) => $builder->search($dto->search))
            ->when($dto->category, fn(NewsQueryBuilder $builder) => $builder->byCategory($dto->category))
            ->latestPublished()
            ->paginate($dto->perPage);
    }

    public final function publishedBySlug(string $slug): News|null
    {
        return News::query()
            ->published()
            ->bySlug($slug)
            ->first();
    }

    public final function item(string $newsId): News|null
    {
        return News::query()->find($newsId);
    }

    public final function create(NewsCreateDto $dto): News
    {
        return News::query()->create([
            News::TITLE => $dto->title,
            News::SLUG => $dto->slug,
            News::CATEGORY => $dto->category,
            News::EXCERPT => $dto->excerpt,
            News::AUTHOR => $dto->author,
            News::CONTENT => $dto->content,
            News::COVER_URL => $dto->cover_url,
            News::STATUS => $dto->status,
            News::PUBLISHED_AT => $dto->published_at,
        ]);
    }

    public final function update(News $news, NewsUpdateDto $dto): News|null
    {
        return $news->update($dto->toArray())
            ? $news
            : null;
    }

    public final function delete(News $news): bool
    {
        return $news->delete();
    }
}
