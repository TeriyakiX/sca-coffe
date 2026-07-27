<?php

declare(strict_types=1);

return [
    /*
     * Учётная запись администратора для AdminUserSeeder.
     * Пароль задаётся только через .env и в репозиторий не попадает.
     */
    'user' => [
        'name' => env('ADMIN_NAME', 'Администратор'),
        'email' => env('ADMIN_EMAIL', 'admin@sca-coffee.ru'),
        'password' => env('ADMIN_PASSWORD'),
    ],
];
