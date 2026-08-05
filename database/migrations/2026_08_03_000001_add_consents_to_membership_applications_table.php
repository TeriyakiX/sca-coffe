<?php

declare(strict_types=1);

use App\Models\MembershipApplication;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public final function up(): void
    {
        Schema::table(MembershipApplication::DATABASE_TABLE, function (Blueprint $table) {
            // Согласие на обработку персональных данных обязательно, фиксируем момент выдачи.
            $table->timestamp(MembershipApplication::CONSENT_AT)
                ->nullable()
                ->after(MembershipApplication::ABOUT);

            // Подписка на информационные материалы — отдельное и необязательное согласие.
            $table->boolean(MembershipApplication::MARKETING_CONSENT)
                ->default(false)
                ->after(MembershipApplication::CONSENT_AT);
        });
    }

    public final function down(): void
    {
        Schema::table(MembershipApplication::DATABASE_TABLE, function (Blueprint $table) {
            $table->dropColumn([
                MembershipApplication::CONSENT_AT,
                MembershipApplication::MARKETING_CONSENT,
            ]);
        });
    }
};
