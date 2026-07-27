<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

final class CreateAdminCommand extends Command
{
    protected $signature = 'admin:create {email} {password} {--name=Администратор}';

    protected $description = 'Создать или обновить администратора панели';

    public final function handle(): int
    {
        $user = User::query()->updateOrCreate(
            ['email' => $this->argument('email')],
            [
                'name' => $this->option('name'),
                'password' => Hash::make($this->argument('password')),
                'is_admin' => true,
                'email_verified_at' => now(),
            ],
        );

        $this->info("Администратор готов: {$user->email}");

        return self::SUCCESS;
    }
}
