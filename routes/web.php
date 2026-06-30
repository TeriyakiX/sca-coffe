<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// ===== ГЛАВНАЯ =====
Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

// ===== СТРАНИЦЫ МЕНЮ =====
Route::get('/events', function () {
    return Inertia::render('Events/EventsPage');
})->name('events');

Route::get('/courses', function () {
    return Inertia::render('Courses/CoursesPage');
})->name('courses');

Route::get('/resources', function () {
    return Inertia::render('Resources/ResourcesPage');
})->name('resources');

Route::get('/membership', function () {
    return Inertia::render('Membership/MembershipPage');
})->name('membership');

// ===== ОБРАЗОВАНИЕ =====
Route::get('/education', function () {
    return Inertia::render('Education/Index');
})->name('education');

// ===== БИЗНЕС-ОБРАЗОВАНИЕ =====
Route::get('/business', function () {
    return Inertia::render('Business/Index');
})->name('business');

// ===== MASTER =====
Route::get('/master', function () {
    return Inertia::render('Master/Index');
})->name('master');

// ===== О НАС =====
Route::get('/about', function () {
    return Inertia::render('About/Index');
})->name('about');

// ===== ЧЛЕНСТВО =====
Route::get('/membership/join', function () {
    return Inertia::render('Membership/Join');
})->name('membership.join');

// ===== СТРАНИЦЫ ФУТЕРА =====
Route::get('/page/{slug}', [PageController::class, 'show'])->name('page');

Route::get('/info', [PageController::class, 'index'])->name('info');

// ===== АВТОРИЗАЦИЯ =====
require __DIR__.'/auth.php';
