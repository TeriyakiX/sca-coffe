<?php

declare(strict_types=1);

use App\Http\Controllers\Api\PageController;
use Illuminate\Support\Facades\Route;

Route::prefix('pages')->group(function () {
    Route::get('', [PageController::class, 'list']);
    Route::get('{slug}', [PageController::class, 'item']);
});

Route::prefix('admin/pages')->middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('', [PageController::class, 'adminList']);
    Route::post('', [PageController::class, 'create']);

    Route::prefix('{pageId}')->whereUuid('pageId')->group(function () {
        Route::put('', [PageController::class, 'update']);
        Route::delete('', [PageController::class, 'delete']);
    });
});
