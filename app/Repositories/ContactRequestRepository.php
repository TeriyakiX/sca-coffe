<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTOs\Contact\ContactRequestCreateDto;
use App\DTOs\Contact\ContactRequestListDto;
use App\DTOs\Contact\ContactRequestUpdateDto;
use App\Models\ContactRequest;
use App\QueryBuilders\ContactRequestQueryBuilder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final readonly class ContactRequestRepository
{
    public final function list(ContactRequestListDto $dto): LengthAwarePaginator
    {
        return ContactRequest::query()
            ->when($dto->status, fn(ContactRequestQueryBuilder $builder) => $builder->byStatus($dto->status))
            ->when($dto->topic, fn(ContactRequestQueryBuilder $builder) => $builder->byTopic($dto->topic))
            ->newestFirst()
            ->paginate($dto->perPage);
    }

    public final function item(string $requestId): ContactRequest|null
    {
        return ContactRequest::query()->find($requestId);
    }

    public final function create(ContactRequestCreateDto $dto): ContactRequest
    {
        return ContactRequest::query()->create([
            ContactRequest::TOPIC => $dto->topic,
            ContactRequest::NAME => $dto->name,
            ContactRequest::EMAIL => $dto->email,
            ContactRequest::PHONE => $dto->phone,
            ContactRequest::MESSAGE => $dto->message,
            ContactRequest::CONSENT_AT => now(),
            ContactRequest::MARKETING_CONSENT => $dto->marketingConsent,
        ]);
    }

    public final function update(ContactRequest $request, ContactRequestUpdateDto $dto): ContactRequest|null
    {
        return $request->update($dto->toArray())
            ? $request
            : null;
    }
}
