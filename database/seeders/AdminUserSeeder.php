<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

final class AdminUserSeeder extends Seeder
{
    public final function run(): void
    {
        $email = (string) config('admin.user.email');
        $password = config('admin.user.password');

        if (blank($password)) {
            $this->command?->warn('ADMIN_PASSWORD не задан в .env — администратор не создан.');

            return;
        }

        $user = User::query()->firstWhere('email', $email);

        // Существующему администратору пароль не трогаем, чтобы повторный
        // db:seed при деплое не сбрасывал уже изменённый пароль.
        if ($user) {
            $user->forceFill(['is_admin' => true])->save();

            $this->command?->info("Администратор {$email} уже существует — обновлён только доступ.");

            return;
        }

        User::query()->create([
            'name' => (string) config('admin.user.name'),
            'email' => $email,
            // Модель сама хеширует пароль — каст 'password' => 'hashed'
            'password' => (string) $password,
            'is_admin' => true,
        ]);

        $this->command?->info("Создан администратор {$email}.");
    }
}
