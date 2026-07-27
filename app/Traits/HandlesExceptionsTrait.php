<?php

declare(strict_types=1);

namespace App\Traits;

use App\Enums\General\ResponseStatusEnum;
use App\Exceptions\DomainException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

trait HandlesExceptionsTrait
{
    private function handleException(Throwable $e): JsonResponse
    {
        if ($e instanceof DomainException) {
            if ($e->shouldLog()) {
                $this->logException($e);
            }

            return new JsonResponse([
                'status' => ResponseStatusEnum::ERROR->value,
                'message' => $e->getMessage(),
            ], $e->getCode());
        }

        $this->logException($e);

        return new JsonResponse([
            'status' => ResponseStatusEnum::ERROR->value,
            'message' => __('responses/errors.internal-server-error'),
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    private function logException(Throwable $e): void
    {
        Log::channel('daily')->error($e->getMessage(), [
            'exception' => $e::class,
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
        ]);
    }
}
