<?php

declare(strict_types=1);

use App\Http\Controllers\Api\ContentBlockController;
use Illuminate\Support\Facades\Route;

Route::prefix('content/blocks')->group(function () {
    Route::get('', [ContentBlockController::class, 'list']);
});

Route::prefix('admin/content/blocks')->middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('', [ContentBlockController::class, 'list']);

    Route::prefix('{blockId}')->whereUuid('blockId')->group(function () {
        Route::get('', [ContentBlockController::class, 'item']);
        Route::put('', [ContentBlockController::class, 'update']);
    });
});
