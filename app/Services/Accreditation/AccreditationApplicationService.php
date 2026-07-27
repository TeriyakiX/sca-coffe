<?php

declare(strict_types=1);

namespace App\Services\Accreditation;

use App\DTOs\Accreditation\AccreditationApplicationCreateDto;
use App\DTOs\Accreditation\AccreditationApplicationListDto;
use App\DTOs\Accreditation\AccreditationApplicationUpdateDto;
use App\Enums\General\ApplicationStatusEnum;
use App\Exceptions\Accreditation\AccreditationApplicationNotFoundException;
use App\Exceptions\Accreditation\AccreditationApplicationUpdateEmptyDataException;
use App\Exceptions\Accreditation\AccreditationApplicationUpdateFailedException;
use App\Jobs\NotifyApplicationReceivedJob;
use App\Models\AccreditationApplication;
use App\Repositories\AccreditationApplicationRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final readonly class AccreditationApplicationService
{
    public final function __construct(
        private AccreditationApplicationRepository $repository,
    )
    {
    }

    public final function list(AccreditationApplicationListDto $dto): LengthAwarePaginator
    {
        return $this->repository->list($dto);
    }

    /**
     * @throws AccreditationApplicationNotFoundException
     */
    public final function item(string $applicationId): AccreditationApplication
    {
        return $this->repository->item($applicationId) ?? throw new AccreditationApplicationNotFoundException();
    }

    public final function create(AccreditationApplicationCreateDto $dto): AccreditationApplication
    {
        $application = $this->repository->create($dto);

        NotifyApplicationReceivedJob::dispatch(
            __('responses/accreditation.notification-subject'),
            __('responses/accreditation.notification-body', [
                'organization' => $application->{AccreditationApplication::ORGANIZATION},
                'email' => $application->{AccreditationApplication::EMAIL},
                'phone' => $application->{AccreditationApplication::PHONE},
                'type' => $application->{AccreditationApplication::TYPE}->label(),
            ]),
        );

        return $application;
    }

    /**
     * @throws AccreditationApplicationUpdateEmptyDataException|AccreditationApplicationNotFoundException|AccreditationApplicationUpdateFailedException
     */
    public final function update(AccreditationApplication|string $application, AccreditationApplicationUpdateDto $dto): AccreditationApplication
    {
        if (empty($dto->toArray())) {
            throw new AccreditationApplicationUpdateEmptyDataException();
        }

        if (is_string($application) && !$application = $this->repository->item($application)) {
            throw new AccreditationApplicationNotFoundException();
        }

        $updated = $this->repository->update($application, $dto) ?? throw new AccreditationApplicationUpdateFailedException();

        if ($dto->status && $dto->status !== ApplicationStatusEnum::NEW->value) {
            $updated->forceFill([AccreditationApplication::PROCESSED_AT => now()])->save();
        }

        return $updated;
    }
}
