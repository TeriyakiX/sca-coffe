<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\NewsCreateRequest;
use App\Http\Requests\News\NewsListRequest;
use App\Http\Requests\News\NewsUpdateRequest;
use App\Http\Resources\News\NewsFullResource;
use App\Http\Resources\News\NewsListResource;
use App\Services\News\NewsService;
use App\Traits\HandlesApiResponsesTrait;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class NewsController extends Controller
{
    use HandlesApiResponsesTrait;

    public final function __construct(
        private readonly NewsService $service,
    )
    {
    }

    public final function list(NewsListRequest $request): JsonResponse
    {
        return $this->executeAction(
            fn() => NewsListResource::collection($this->service->list($request->toDto()))->response()->getData(true),
            'responses/news.list',
        );
    }

    public final function adminList(NewsListRequest $request): JsonResponse
    {
        return $this->executeAction(
            fn() => NewsFullResource::collection($this->service->adminList($request->toDto()))->response()->getData(true),
            'responses/news.list',
        );
    }

    public final function item(string $slug): JsonResponse
    {
        return $this->executeAction(
            fn() => new NewsFullResource($this->service->item($slug)),
            'responses/news.item',
        );
    }

    public final function create(NewsCreateRequest $request): JsonResponse
    {
        return $this->executeAction(
            fn() => new NewsFullResource($this->service->create($request->toDto())),
            'responses/news.create',
            Response::HTTP_CREATED,
        );
    }

    public final function update(string $newsId, NewsUpdateRequest $request): JsonResponse
    {
        return $this->executeAction(
            fn() => new NewsFullResource($this->service->update($newsId, $request->toDto())),
            'responses/news.update',
        );
    }

    public final function delete(string $newsId): JsonResponse
    {
        return $this->executeVoidAction(
            fn() => $this->service->delete($newsId),
            'responses/news.delete',
        );
    }
}
