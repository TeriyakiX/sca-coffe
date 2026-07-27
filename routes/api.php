<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::group([], base_path('routes/api/auth.php'));
    Route::group([], base_path('routes/api/content.php'));
    Route::group([], base_path('routes/api/page.php'));
    Route::group([], base_path('routes/api/news.php'));
    Route::group([], base_path('routes/api/event.php'));
    Route::group([], base_path('routes/api/partner.php'));
    Route::group([], base_path('routes/api/membership.php'));
    Route::group([], base_path('routes/api/accreditation.php'));
    Route::group([], base_path('routes/api/contact.php'));
});
