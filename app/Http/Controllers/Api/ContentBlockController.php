<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Content\ContentBlockListRequest;
use App\Http\Requests\Content\ContentBlockUpdateRequest;
use App\Http\Resources\Content\ContentBlockResource;
use App\Services\Content\ContentBlockService;
use App\Traits\HandlesApiResponsesTrait;
use Illuminate\Http\JsonResponse;

final class ContentBlockController extends Controller
{
    use HandlesApiResponsesTrait;

    public final function __construct(
        private readonly ContentBlockService $service,
    )
    {
    }

    public final function list(ContentBlockListRequest $request): JsonResponse
    {
        return $this->executeAction(
            fn() => ContentBlockResource::collection($this->service->list($request->section())),
            'responses/content.list',
        );
    }

    public final function item(string $blockId): JsonResponse
    {
        return $this->executeAction(
            fn() => new ContentBlockResource($this->service->item($blockId)),
            'responses/content.item',
        );
    }

    public final function update(string $blockId, ContentBlockUpdateRequest $request): JsonResponse
    {
        return $this->executeAction(
            fn() => new ContentBlockResource($this->service->update($blockId, $request->toDto())),
            'responses/content.update',
        );
    }
}
