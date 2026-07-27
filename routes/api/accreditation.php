<?php

declare(strict_types=1);

use App\Http\Controllers\Api\AccreditationApplicationController;
use Illuminate\Support\Facades\Route;

Route::post('accreditation/applications', [AccreditationApplicationController::class, 'create'])
    ->middleware('throttle:applications');

Route::prefix('admin/accreditation/applications')->middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('', [AccreditationApplicationController::class, 'list']);

    Route::prefix('{applicationId}')->whereUuid('applicationId')->group(function () {
        Route::get('', [AccreditationApplicationController::class, 'item']);
        Route::put('', [AccreditationApplicationController::class, 'update']);
    });
});
