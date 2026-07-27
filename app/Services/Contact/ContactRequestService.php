<?php

declare(strict_types=1);

namespace App\Services\Contact;

use App\DTOs\Contact\ContactRequestCreateDto;
use App\DTOs\Contact\ContactRequestListDto;
use App\DTOs\Contact\ContactRequestUpdateDto;
use App\Enums\General\ApplicationStatusEnum;
use App\Exceptions\Contact\ContactRequestNotFoundException;
use App\Exceptions\Contact\ContactRequestUpdateEmptyDataException;
use App\Exceptions\Contact\ContactRequestUpdateFailedException;
use App\Jobs\NotifyApplicationReceivedJob;
use App\Models\ContactRequest;
use App\Repositories\ContactRequestRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final readonly class ContactRequestService
{
    public final function __construct(
        private ContactRequestRepository $repository,
    )
    {
    }

    public final function list(ContactRequestListDto $dto): LengthAwarePaginator
    {
        return $this->repository->list($dto);
    }

    /**
     * @throws ContactRequestNotFoundException
     */
    public final function item(string $requestId): ContactRequest
    {
        return $this->repository->item($requestId) ?? throw new ContactRequestNotFoundException();
    }

    public final function create(ContactRequestCreateDto $dto): ContactRequest
    {
        $request = $this->repository->create($dto);

        NotifyApplicationReceivedJob::dispatch(
            __('responses/contact.notification-subject'),
            __('responses/contact.notification-body', [
                'name' => $request->{ContactRequest::NAME},
                'email' => $request->{ContactRequest::EMAIL},
                'topic' => $request->{ContactRequest::TOPIC}->label(),
                'message' => $request->{ContactRequest::MESSAGE},
            ]),
        );

        return $request;
    }

    /**
     * @throws ContactRequestUpdateEmptyDataException|ContactRequestNotFoundException|ContactRequestUpdateFailedException
     */
    public final function update(ContactRequest|string $request, ContactRequestUpdateDto $dto): ContactRequest
    {
        if (empty($dto->toArray())) {
            throw new ContactRequestUpdateEmptyDataException();
        }

        if (is_string($request) && !$request = $this->repository->item($request)) {
            throw new ContactRequestNotFoundException();
        }

        $updated = $this->repository->update($request, $dto) ?? throw new ContactRequestUpdateFailedException();

        if ($dto->status && $dto->status !== ApplicationStatusEnum::NEW->value) {
            $updated->forceFill([ContactRequest::PROCESSED_AT => now()])->save();
        }

        return $updated;
    }
}
