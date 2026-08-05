<?php

use App\Services\Seo\MetaResolver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

// Постоянные перенаправления старых адресов на канонические.
// Обрабатываются сервером, чтобы поисковики видели 301, а не отдачу SPA.
foreach ((array) config('legacy_pages.redirects') as $slug => $target) {
    Route::permanentRedirect("/page/{$slug}", $target);
}

// Закрытые страницы: 410 Gone — адрес больше не действует и замены нет.
Route::get('/page/{slug}', function (string $slug) {
    abort(Response::HTTP_GONE);
})->whereIn('slug', (array) config('legacy_pages.gone'));

Route::get('/{any?}', function (Request $request, MetaResolver $meta) {
    return view('app', [
        'meta' => $meta->resolve($request->path(), $request->url()),
    ]);
})->where('any', '.*');
