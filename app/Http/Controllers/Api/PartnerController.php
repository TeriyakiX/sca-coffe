<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Partner\PartnerCreateRequest;
use App\Http\Requests\Partner\PartnerListRequest;
use App\Http\Requests\Partner\PartnerUpdateRequest;
use App\Http\Resources\Partner\PartnerFullResource;
use App\Services\Partner\PartnerService;
use App\Traits\HandlesApiResponsesTrait;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class PartnerController extends Controller
{
    use HandlesApiResponsesTrait;

    public final function __construct(
        private readonly PartnerService $service,
    )
    {
    }

    public final function list(PartnerListRequest $request): JsonResponse
    {
        return $this->executeAction(
            fn() => PartnerFullResource::collection($this->service->list($request->toDto())),
            'responses/partner.list',
        );
    }

    public final function adminList(PartnerListRequest $request): JsonResponse
    {
        return $this->executeAction(
            fn() => PartnerFullResource::collection($this->service->adminList($request->toDto())),
            'responses/partner.list',
        );
    }

    public final function create(PartnerCreateRequest $request): JsonResponse
    {
        return $this->executeAction(
            fn() => new PartnerFullResource($this->service->create($request->toDto())),
            'responses/partner.create',
            Response::HTTP_CREATED,
        );
    }

    public final function update(string $partnerId, PartnerUpdateRequest $request): JsonResponse
    {
        return $this->executeAction(
            fn() => new PartnerFullResource($this->service->update($partnerId, $request->toDto())),
            'responses/partner.update',
        );
    }

    public final function delete(string $partnerId): JsonResponse
    {
        return $this->executeVoidAction(
            fn() => $this->service->delete($partnerId),
            'responses/partner.delete',
        );
    }
}
