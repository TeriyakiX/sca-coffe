<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\ContactRequestCreateRequest;
use App\Http\Requests\Contact\ContactRequestListRequest;
use App\Http\Requests\Contact\ContactRequestUpdateRequest;
use App\Http\Resources\Contact\ContactRequestFullResource;
use App\Services\Contact\ContactRequestService;
use App\Traits\HandlesApiResponsesTrait;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class ContactRequestController extends Controller
{
    use HandlesApiResponsesTrait;

    public final function __construct(
        private readonly ContactRequestService $service,
    )
    {
    }

    public final function create(ContactRequestCreateRequest $request): JsonResponse
    {
        return $this->executeAction(
            fn() => new ContactRequestFullResource($this->service->create($request->toDto())),
            'responses/contact.create',
            Response::HTTP_CREATED,
        );
    }

    public final function list(ContactRequestListRequest $request): JsonResponse
    {
        return $this->executeAction(
            fn() => ContactRequestFullResource::collection($this->service->list($request->toDto()))->response()->getData(true),
            'responses/contact.list',
        );
    }

    public final function item(string $requestId): JsonResponse
    {
        return $this->executeAction(
            fn() => new ContactRequestFullResource($this->service->item($requestId)),
            'responses/contact.item',
        );
    }

    public final function update(string $requestId, ContactRequestUpdateRequest $request): JsonResponse
    {
        return $this->executeAction(
            fn() => new ContactRequestFullResource($this->service->update($requestId, $request->toDto())),
            'responses/contact.update',
        );
    }
}
