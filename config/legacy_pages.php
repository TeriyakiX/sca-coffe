<?php

declare(strict_types=1);

/*
 * Раздел 7 документа правок: старые адреса не должны оставаться
 * доступными как самостоятельные разделы.
 */
return [
    // Страницы закрыты: отдаём 410 Gone — замена не предусмотрена
    'gone' => [
        'material-technical',
        'career-center',
        'scholarships',
        'paid-services',
        'vacancies',
        'nutrition',
    ],

    // Постоянные перенаправления на канонические адреса
    'redirects' => [
        'education' => '/education',
        'standards' => '/standards',
    ],
];
