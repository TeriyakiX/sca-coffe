<?php

declare(strict_types=1);

use App\Http\Controllers\Api\NewsController;
use Illuminate\Support\Facades\Route;

Route::prefix('news')->group(function () {
    Route::get('', [NewsController::class, 'list']);
    Route::get('{slug}', [NewsController::class, 'item']);
});

Route::prefix('admin/news')->middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('', [NewsController::class, 'adminList']);
    Route::post('', [NewsController::class, 'create']);

    Route::prefix('{newsId}')->whereUuid('newsId')->group(function () {
        Route::put('', [NewsController::class, 'update']);
        Route::delete('', [NewsController::class, 'delete']);
    });
});
