<?php

declare(strict_types=1);

use App\Http\Controllers\Api\ContactRequestController;
use Illuminate\Support\Facades\Route;

Route::post('contact/requests', [ContactRequestController::class, 'create'])
    ->middleware('throttle:applications');

Route::prefix('admin/contact/requests')->middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('', [ContactRequestController::class, 'list']);

    Route::prefix('{requestId}')->whereUuid('requestId')->group(function () {
        Route::get('', [ContactRequestController::class, 'item']);
        Route::put('', [ContactRequestController::class, 'update']);
    });
});
