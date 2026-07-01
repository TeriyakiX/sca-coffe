<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn() => Inertia::render('Home'))->name('home');

Route::get('/business', fn() => Inertia::render('Business/Index'))->name('business');
Route::get('/education', fn() => Inertia::render('Education/Index'))->name('education');
Route::get('/membership', fn() => Inertia::render('Membership/Index'))->name('membership');
Route::get('/membership/join', fn() => Inertia::render('Membership/Join'))->name('membership.join');
Route::get('/events', fn() => Inertia::render('Events/Index'))->name('events');
Route::get('/courses', fn() => Inertia::render('Courses/Index'))->name('courses');
Route::get('/resources', fn() => Inertia::render('Resources/Index'))->name('resources');
Route::get('/master', fn() => Inertia::render('Master/Index'))->name('master');

Route::get('/page/{slug}', [PageController::class, 'show'])->name('page');
Route::get('/info', [PageController::class, 'index'])->name('info');

require __DIR__.'/auth.php';
