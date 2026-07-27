<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTOs\Membership\MembershipApplicationCreateDto;
use App\DTOs\Membership\MembershipApplicationListDto;
use App\DTOs\Membership\MembershipApplicationUpdateDto;
use App\Models\MembershipApplication;
use App\QueryBuilders\MembershipApplicationQueryBuilder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final readonly class MembershipApplicationRepository
{
    public final function list(MembershipApplicationListDto $dto): LengthAwarePaginator
    {
        return MembershipApplication::query()
            ->when($dto->search, fn(MembershipApplicationQueryBuilder $builder) => $builder->search($dto->search))
            ->when($dto->status, fn(MembershipApplicationQueryBuilder $builder) => $builder->byStatus($dto->status))
            ->when($dto->category, fn(MembershipApplicationQueryBuilder $builder) => $builder->byCategory($dto->category))
            ->newestFirst()
            ->paginate($dto->perPage);
    }

    public final function item(string $applicationId): MembershipApplication|null
    {
        return MembershipApplication::query()->find($applicationId);
    }

    public final function create(MembershipApplicationCreateDto $dto): MembershipApplication
    {
        return MembershipApplication::query()->create([
            MembershipApplication::CATEGORY => $dto->category,
            MembershipApplication::SPECIALIZATION => $dto->specialization,
            MembershipApplication::NAME => $dto->name,
            MembershipApplication::EMAIL => $dto->email,
            MembershipApplication::PHONE => $dto->phone,
            MembershipApplication::CITY => $dto->city,
            MembershipApplication::COMPANY => $dto->company,
            MembershipApplication::ABOUT => $dto->about,
        ]);
    }

    public final function update(MembershipApplication $application, MembershipApplicationUpdateDto $dto): MembershipApplication|null
    {
        return $application->update($dto->toArray())
            ? $application
            : null;
    }
}
