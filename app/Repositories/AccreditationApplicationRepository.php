<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTOs\Accreditation\AccreditationApplicationCreateDto;
use App\DTOs\Accreditation\AccreditationApplicationListDto;
use App\DTOs\Accreditation\AccreditationApplicationUpdateDto;
use App\Models\AccreditationApplication;
use App\QueryBuilders\AccreditationApplicationQueryBuilder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final readonly class AccreditationApplicationRepository
{
    public final function list(AccreditationApplicationListDto $dto): LengthAwarePaginator
    {
        return AccreditationApplication::query()
            ->when($dto->search, fn(AccreditationApplicationQueryBuilder $builder) => $builder->search($dto->search))
            ->when($dto->status, fn(AccreditationApplicationQueryBuilder $builder) => $builder->byStatus($dto->status))
            ->when($dto->type, fn(AccreditationApplicationQueryBuilder $builder) => $builder->byType($dto->type))
            ->newestFirst()
            ->paginate($dto->perPage);
    }

    public final function item(string $applicationId): AccreditationApplication|null
    {
        return AccreditationApplication::query()->find($applicationId);
    }

    public final function create(AccreditationApplicationCreateDto $dto): AccreditationApplication
    {
        return AccreditationApplication::query()->create([
            AccreditationApplication::TYPE => $dto->type,
            AccreditationApplication::ORGANIZATION => $dto->organization,
            AccreditationApplication::INN => $dto->inn,
            AccreditationApplication::CITY => $dto->city,
            AccreditationApplication::CONTACT_NAME => $dto->contact_name,
            AccreditationApplication::CONTACT_POSITION => $dto->contact_position,
            AccreditationApplication::EMAIL => $dto->email,
            AccreditationApplication::PHONE => $dto->phone,
            AccreditationApplication::SITE_URL => $dto->site_url,
            AccreditationApplication::PROGRAMS => $dto->programs,
            AccreditationApplication::FACILITIES => $dto->facilities,
            AccreditationApplication::EXPERIENCE => $dto->experience,
            AccreditationApplication::TRAINERS_COUNT => $dto->trainers_count,
            AccreditationApplication::COMMENT => $dto->comment,
            AccreditationApplication::CONSENT_AT => now(),
            AccreditationApplication::MARKETING_CONSENT => $dto->marketingConsent,
        ]);
    }

    public final function update(AccreditationApplication $application, AccreditationApplicationUpdateDto $dto): AccreditationApplication|null
    {
        return $application->update($dto->toArray())
            ? $application
            : null;
    }
}
