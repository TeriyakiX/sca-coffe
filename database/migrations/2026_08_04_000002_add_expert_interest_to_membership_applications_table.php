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
            // Раздел 3.5 правок: отдельное поле об интересе к работе в экспертной группе
            $table->boolean(MembershipApplication::EXPERT_INTEREST)
                ->default(false)
                ->after(MembershipApplication::ABOUT);
        });
    }

    public final function down(): void
    {
        Schema::table(MembershipApplication::DATABASE_TABLE, function (Blueprint $table) {
            $table->dropColumn(MembershipApplication::EXPERT_INTEREST);
        });
    }
};
