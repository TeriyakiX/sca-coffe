<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Membership\MembershipApplicationCreateRequest;
use App\Http\Requests\Membership\MembershipApplicationListRequest;
use App\Http\Requests\Membership\MembershipApplicationUpdateRequest;
use App\Http\Resources\Membership\MembershipApplicationFullResource;
use App\Services\Membership\MembershipApplicationService;
use App\Traits\HandlesApiResponsesTrait;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class MembershipApplicationController extends Controller
{
    use HandlesApiResponsesTrait;

    public final function __construct(
        private readonly MembershipApplicationService $service,
    )
    {
    }

    public final function create(MembershipApplicationCreateRequest $request): JsonResponse
    {
        return $this->executeAction(
            fn() => new MembershipApplicationFullResource($this->service->create($request->toDto())),
            'responses/membership.create',
            Response::HTTP_CREATED,
        );
    }

    public final function list(MembershipApplicationListRequest $request): JsonResponse
    {
        return $this->executeAction(
            fn() => MembershipApplicationFullResource::collection($this->service->list($request->toDto()))->response()->getData(true),
            'responses/membership.list',
        );
    }

    public final function item(string $applicationId): JsonResponse
    {
        return $this->executeAction(
            fn() => new MembershipApplicationFullResource($this->service->item($applicationId)),
            'responses/membership.item',
        );
    }

    public final function update(string $applicationId, MembershipApplicationUpdateRequest $request): JsonResponse
    {
        return $this->executeAction(
            fn() => new MembershipApplicationFullResource($this->service->update($applicationId, $request->toDto())),
            'responses/membership.update',
        );
    }
}
