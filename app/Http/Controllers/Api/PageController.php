<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Page\PageCreateRequest;
use App\Http\Requests\Page\PageUpdateRequest;
use App\Http\Resources\Page\PageFullResource;
use App\Http\Resources\Page\PageListResource;
use App\Services\Page\PageService;
use App\Traits\HandlesApiResponsesTrait;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class PageController extends Controller
{
    use HandlesApiResponsesTrait;

    public final function __construct(
        private readonly PageService $service,
    )
    {
    }

    public final function list(): JsonResponse
    {
        return $this->executeAction(
            fn() => PageListResource::collection($this->service->list()),
            'responses/page.list',
        );
    }

    public final function adminList(): JsonResponse
    {
        return $this->executeAction(
            fn() => PageListResource::collection($this->service->adminList()),
            'responses/page.list',
        );
    }

    public final function item(string $slug): JsonResponse
    {
        return $this->executeAction(
            fn() => new PageFullResource($this->service->item($slug)),
            'responses/page.item',
        );
    }

    public final function create(PageCreateRequest $request): JsonResponse
    {
        return $this->executeAction(
            fn() => new PageFullResource($this->service->create($request->toDto())),
            'responses/page.create',
            Response::HTTP_CREATED,
        );
    }

    public final function update(string $pageId, PageUpdateRequest $request): JsonResponse
    {
        return $this->executeAction(
            fn() => new PageFullResource($this->service->update($pageId, $request->toDto())),
            'responses/page.update',
        );
    }

    public final function delete(string $pageId): JsonResponse
    {
        return $this->executeVoidAction(
            fn() => $this->service->delete($pageId),
            'responses/page.delete',
        );
    }
}
