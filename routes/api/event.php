<?php

declare(strict_types=1);

use App\Http\Controllers\Api\EventController;
use Illuminate\Support\Facades\Route;

Route::prefix('events')->group(function () {
    Route::get('', [EventController::class, 'list']);
    Route::get('{slug}', [EventController::class, 'item']);
});

Route::prefix('admin/events')->middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('', [EventController::class, 'adminList']);
    Route::post('', [EventController::class, 'create']);

    Route::prefix('{eventId}')->whereUuid('eventId')->group(function () {
        Route::put('', [EventController::class, 'update']);
        Route::delete('', [EventController::class, 'delete']);
    });
});
