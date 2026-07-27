<?php

declare(strict_types=1);

use App\Http\Controllers\Api\MembershipApplicationController;
use Illuminate\Support\Facades\Route;

Route::post('membership/applications', [MembershipApplicationController::class, 'create'])
    ->middleware('throttle:applications');

Route::prefix('admin/membership/applications')->middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('', [MembershipApplicationController::class, 'list']);

    Route::prefix('{applicationId}')->whereUuid('applicationId')->group(function () {
        Route::get('', [MembershipApplicationController::class, 'item']);
        Route::put('', [MembershipApplicationController::class, 'update']);
    });
});
