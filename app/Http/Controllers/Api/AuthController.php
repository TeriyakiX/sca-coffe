<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Enums\General\ResponseStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ApiLoginRequest;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

final class AuthController extends Controller
{
    public final function login(ApiLoginRequest $request): JsonResponse
    {
        if (!Auth::attempt($request->credentials(), $request->boolean('remember'))) {
            return new JsonResponse([
                'status' => ResponseStatusEnum::ERROR->value,
                'message' => __('auth.failed'),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $request->session()->regenerate();

        return new JsonResponse([
            'status' => ResponseStatusEnum::SUCCESS->value,
            'message' => __('responses/auth.login'),
            'data' => new UserResource(Auth::user()),
        ]);
    }

    public final function logout(Request $request): JsonResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return new JsonResponse([
            'status' => ResponseStatusEnum::SUCCESS->value,
            'message' => __('responses/auth.logout'),
        ]);
    }

    public final function me(Request $request): JsonResponse
    {
        return new JsonResponse([
            'status' => ResponseStatusEnum::SUCCESS->value,
            'data' => new UserResource($request->user()),
        ]);
    }
}
