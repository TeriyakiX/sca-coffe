<?php

declare(strict_types=1);

namespace App\Traits;

use App\Enums\General\ResponseStatusEnum;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

trait HandlesApiResponsesTrait
{
    use HandlesExceptionsTrait;

    protected function successResponse(
        mixed  $data = null,
        string $message = '',
        int    $status = Response::HTTP_OK
    ): JsonResponse
    {
        $response = [
            'status' => ResponseStatusEnum::SUCCESS->value,
        ];

        if ($message) {
            $response['message'] = $message;
        }

        if ($data !== null) {
            $response['data'] = $data;
        }

        return new JsonResponse($response, $status);
    }

    protected function executeAction(
        callable $action,
        string   $successMessage = '',
        int      $successStatus = Response::HTTP_OK
    ): JsonResponse
    {
        try {
            return $this->successResponse($action(), __($successMessage), $successStatus);
        } catch (Throwable $e) {
            return $this->handleException($e);
        }
    }

    protected function executeVoidAction(callable $action, string $successMessage = ''): JsonResponse
    {
        try {
            $action();

            return $this->successResponse(null, __($successMessage));
        } catch (Throwable $e) {
            return $this->handleException($e);
        }
    }
}
