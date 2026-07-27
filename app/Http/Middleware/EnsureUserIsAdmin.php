<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Enums\General\ResponseStatusEnum;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class EnsureUserIsAdmin
{
    public final function handle(Request $request, Closure $next): Response
    {
        if (!$request->user()?->is_admin) {
            return new JsonResponse([
                'status' => ResponseStatusEnum::ERROR->value,
                'message' => __('exceptions.admin.forbidden'),
            ], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
