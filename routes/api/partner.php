<?php

declare(strict_types=1);

use App\Http\Controllers\Api\PartnerController;
use Illuminate\Support\Facades\Route;

Route::prefix('partners')->group(function () {
    Route::get('', [PartnerController::class, 'list']);
});

Route::prefix('admin/partners')->middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('', [PartnerController::class, 'adminList']);
    Route::post('', [PartnerController::class, 'create']);

    Route::prefix('{partnerId}')->whereUuid('partnerId')->group(function () {
        Route::put('', [PartnerController::class, 'update']);
        Route::delete('', [PartnerController::class, 'delete']);
    });
});
