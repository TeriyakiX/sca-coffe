<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTOs\Page\PageCreateDto;
use App\DTOs\Page\PageUpdateDto;
use App\Models\Page;
use Illuminate\Database\Eloquent\Collection;

final readonly class PageRepository
{
    public final function publishedList(): Collection
    {
        return Page::query()
            ->published()
            ->ordered()
            ->get();
    }

    public final function allList(): Collection
    {
        return Page::query()
            ->ordered()
            ->get();
    }

    public final function publishedBySlug(string $slug): Page|null
    {
        return Page::query()
            ->published()
            ->bySlug($slug)
            ->first();
    }

    public final function item(string $pageId): Page|null
    {
        return Page::query()->find($pageId);
    }

    public final function create(PageCreateDto $dto): Page
    {
        return Page::query()->create([
            Page::TITLE => $dto->title,
            Page::SLUG => $dto->slug,
            Page::CONTENT => $dto->content,
            Page::STATUS => $dto->status,
            Page::SORT_ORDER => $dto->sort_order,
        ]);
    }

    public final function update(Page $page, PageUpdateDto $dto): Page|null
    {
        return $page->update($dto->toArray())
            ? $page
            : null;
    }

    public final function delete(Page $page): bool
    {
        return $page->delete();
    }
}
