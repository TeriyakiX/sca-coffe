<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn() => Inertia::render('Home'))->name('home');

Route::get('/events', fn() => Inertia::render('modules/events/pages/Index'))->name('events');
Route::get('/courses', fn() => Inertia::render('modules/courses/pages/Index'))->name('courses');
Route::get('/resources', fn() => Inertia::render('modules/resources/pages/Index'))->name('resources');
Route::get('/membership', fn() => Inertia::render('modules/membership/pages/Index'))->name('membership');
Route::get('/education', fn() => Inertia::render('modules/education/pages/Index'))->name('education');
Route::get('/business', fn() => Inertia::render('modules/business/pages/Index'))->name('business');
Route::get('/master', fn() => Inertia::render('modules/master/pages/Index'))->name('master');
Route::get('/about', fn() => Inertia::render('About/Index'))->name('about');
Route::get('/membership/join', fn() => Inertia::render('modules/membership/pages/Join'))->name('membership.join');

Route::get('/page/{slug}', [PageController::class, 'show'])->name('page');
Route::get('/info', [PageController::class, 'index'])->name('info');

require __DIR__.'/auth.php';
