<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTOs\Partner\PartnerCreateDto;
use App\DTOs\Partner\PartnerListDto;
use App\DTOs\Partner\PartnerUpdateDto;
use App\Models\Partner;
use App\QueryBuilders\PartnerQueryBuilder;
use Illuminate\Database\Eloquent\Collection;

final readonly class PartnerRepository
{
    public final function publishedList(PartnerListDto $dto): Collection
    {
        return Partner::query()
            ->published()
            ->when($dto->category, fn(PartnerQueryBuilder $builder) => $builder->byCategory($dto->category))
            ->ordered()
            ->get();
    }

    public final function adminList(PartnerListDto $dto): Collection
    {
        return Partner::query()
            ->when($dto->category, fn(PartnerQueryBuilder $builder) => $builder->byCategory($dto->category))
            ->ordered()
            ->get();
    }

    public final function item(string $partnerId): Partner|null
    {
        return Partner::query()->find($partnerId);
    }

    public final function create(PartnerCreateDto $dto): Partner
    {
        return Partner::query()->create([
            Partner::NAME => $dto->name,
            Partner::SLUG => $dto->slug,
            Partner::CATEGORY => $dto->category,
            Partner::DESCRIPTION => $dto->description,
            Partner::BENEFIT => $dto->benefit,
            Partner::LOGO_URL => $dto->logo_url,
            Partner::SITE_URL => $dto->site_url,
            Partner::STATUS => $dto->status,
            Partner::SORT_ORDER => $dto->sort_order,
        ]);
    }

    public final function update(Partner $partner, PartnerUpdateDto $dto): Partner|null
    {
        return $partner->update($dto->toArray())
            ? $partner
            : null;
    }

    public final function delete(Partner $partner): bool
    {
        return $partner->delete();
    }
}
