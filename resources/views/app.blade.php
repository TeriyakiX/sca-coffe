<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Мета отдаются сервером: поисковики и мессенджеры не выполняют JS,
         поэтому заголовок, который проставляет роутер, им недоступен --}}
    <title>{{ $meta['title'] }}</title>
    <meta name="description" content="{{ $meta['description'] }}">
    <link rel="canonical" href="{{ $meta['url'] }}">

    <meta property="og:type" content="{{ $meta['type'] }}">
    <meta property="og:site_name" content="{{ $meta['site_name'] }}">
    <meta property="og:title" content="{{ $meta['title'] }}">
    <meta property="og:description" content="{{ $meta['description'] }}">
    <meta property="og:url" content="{{ $meta['url'] }}">
    <meta property="og:locale" content="ru_RU">
    <meta property="og:image" content="{{ url('/images/logo.svg') }}">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="{{ $meta['title'] }}">
    <meta name="twitter:description" content="{{ $meta['description'] }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div id="app"></div>
</body>
</html>
