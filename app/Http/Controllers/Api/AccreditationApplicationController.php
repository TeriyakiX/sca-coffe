<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Accreditation\AccreditationApplicationCreateRequest;
use App\Http\Requests\Accreditation\AccreditationApplicationListRequest;
use App\Http\Requests\Accreditation\AccreditationApplicationUpdateRequest;
use App\Http\Resources\Accreditation\AccreditationApplicationFullResource;
use App\Services\Accreditation\AccreditationApplicationService;
use App\Traits\HandlesApiResponsesTrait;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class AccreditationApplicationController extends Controller
{
    use HandlesApiResponsesTrait;

    public final function __construct(
        private readonly AccreditationApplicationService $service,
    )
    {
    }

    public final function create(AccreditationApplicationCreateRequest $request): JsonResponse
    {
        return $this->executeAction(
            fn() => new AccreditationApplicationFullResource($this->service->create($request->toDto())),
            'responses/accreditation.create',
            Response::HTTP_CREATED,
        );
    }

    public final function list(AccreditationApplicationListRequest $request): JsonResponse
    {
        return $this->executeAction(
            fn() => AccreditationApplicationFullResource::collection($this->service->list($request->toDto()))->response()->getData(true),
            'responses/accreditation.list',
        );
    }

    public final function item(string $applicationId): JsonResponse
    {
        return $this->executeAction(
            fn() => new AccreditationApplicationFullResource($this->service->item($applicationId)),
            'responses/accreditation.item',
        );
    }

    public final function update(string $applicationId, AccreditationApplicationUpdateRequest $request): JsonResponse
    {
        return $this->executeAction(
            fn() => new AccreditationApplicationFullResource($this->service->update($applicationId, $request->toDto())),
            'responses/accreditation.update',
        );
    }
}
