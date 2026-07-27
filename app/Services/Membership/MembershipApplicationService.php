<?php

declare(strict_types=1);

namespace App\Services\Membership;

use App\DTOs\Membership\MembershipApplicationCreateDto;
use App\DTOs\Membership\MembershipApplicationListDto;
use App\DTOs\Membership\MembershipApplicationUpdateDto;
use App\Enums\General\ApplicationStatusEnum;
use App\Exceptions\Membership\MembershipApplicationNotFoundException;
use App\Exceptions\Membership\MembershipApplicationUpdateEmptyDataException;
use App\Exceptions\Membership\MembershipApplicationUpdateFailedException;
use App\Jobs\NotifyApplicationReceivedJob;
use App\Models\MembershipApplication;
use App\Repositories\MembershipApplicationRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final readonly class MembershipApplicationService
{
    public final function __construct(
        private MembershipApplicationRepository $repository,
    )
    {
    }

    public final function list(MembershipApplicationListDto $dto): LengthAwarePaginator
    {
        return $this->repository->list($dto);
    }

    /**
     * @throws MembershipApplicationNotFoundException
     */
    public final function item(string $applicationId): MembershipApplication
    {
        return $this->repository->item($applicationId) ?? throw new MembershipApplicationNotFoundException();
    }

    public final function create(MembershipApplicationCreateDto $dto): MembershipApplication
    {
        $application = $this->repository->create($dto);

        NotifyApplicationReceivedJob::dispatch(
            __('responses/membership.notification-subject'),
            __('responses/membership.notification-body', [
                'name' => $application->{MembershipApplication::NAME},
                'email' => $application->{MembershipApplication::EMAIL},
                'phone' => $application->{MembershipApplication::PHONE},
                'category' => $application->{MembershipApplication::CATEGORY}->label(),
            ]),
        );

        return $application;
    }

    /**
     * @throws MembershipApplicationUpdateEmptyDataException|MembershipApplicationNotFoundException|MembershipApplicationUpdateFailedException
     */
    public final function update(MembershipApplication|string $application, MembershipApplicationUpdateDto $dto): MembershipApplication
    {
        if (empty($dto->toArray())) {
            throw new MembershipApplicationUpdateEmptyDataException();
        }

        if (is_string($application) && !$application = $this->repository->item($application)) {
            throw new MembershipApplicationNotFoundException();
        }

        $updated = $this->repository->update($application, $dto) ?? throw new MembershipApplicationUpdateFailedException();

        if ($dto->status && $dto->status !== ApplicationStatusEnum::NEW->value) {
            $updated->forceFill([MembershipApplication::PROCESSED_AT => now()])->save();
        }

        return $updated;
    }
}
