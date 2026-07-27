<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\EventCreateRequest;
use App\Http\Requests\Event\EventListRequest;
use App\Http\Requests\Event\EventUpdateRequest;
use App\Http\Resources\Event\EventFullResource;
use App\Services\Event\EventService;
use App\Traits\HandlesApiResponsesTrait;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class EventController extends Controller
{
    use HandlesApiResponsesTrait;

    public final function __construct(
        private readonly EventService $service,
    )
    {
    }

    public final function list(EventListRequest $request): JsonResponse
    {
        return $this->executeAction(
            fn() => EventFullResource::collection($this->service->list($request->toDto()))->response()->getData(true),
            'responses/event.list',
        );
    }

    public final function adminList(EventListRequest $request): JsonResponse
    {
        return $this->executeAction(
            fn() => EventFullResource::collection($this->service->adminList($request->toDto()))->response()->getData(true),
            'responses/event.list',
        );
    }

    public final function item(string $slug): JsonResponse
    {
        return $this->executeAction(
            fn() => new EventFullResource($this->service->item($slug)),
            'responses/event.item',
        );
    }

    public final function create(EventCreateRequest $request): JsonResponse
    {
        return $this->executeAction(
            fn() => new EventFullResource($this->service->create($request->toDto())),
            'responses/event.create',
            Response::HTTP_CREATED,
        );
    }

    public final function update(string $eventId, EventUpdateRequest $request): JsonResponse
    {
        return $this->executeAction(
            fn() => new EventFullResource($this->service->update($eventId, $request->toDto())),
            'responses/event.update',
        );
    }

    public final function delete(string $eventId): JsonResponse
    {
        return $this->executeVoidAction(
            fn() => $this->service->delete($eventId),
            'responses/event.delete',
        );
    }
}
