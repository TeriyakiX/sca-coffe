<?php

declare(strict_types=1);

use App\Models\AccreditationApplication;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public final function up(): void
    {
        Schema::table(AccreditationApplication::DATABASE_TABLE, function (Blueprint $table) {
            // Раздел 3.7 правок: опыт, количество преподавателей, комментарий
            // и отдельное необязательное согласие на информационные материалы
            $table->string(AccreditationApplication::EXPERIENCE, 55)
                ->nullable()
                ->after(AccreditationApplication::FACILITIES);

            $table->unsignedSmallInteger(AccreditationApplication::TRAINERS_COUNT)
                ->nullable()
                ->after(AccreditationApplication::EXPERIENCE);

            $table->text(AccreditationApplication::COMMENT)
                ->nullable()
                ->after(AccreditationApplication::TRAINERS_COUNT);

            $table->timestamp(AccreditationApplication::CONSENT_AT)
                ->nullable()
                ->after(AccreditationApplication::COMMENT);

            $table->boolean(AccreditationApplication::MARKETING_CONSENT)
                ->default(false)
                ->after(AccreditationApplication::CONSENT_AT);
        });
    }

    public final function down(): void
    {
        Schema::table(AccreditationApplication::DATABASE_TABLE, function (Blueprint $table) {
            $table->dropColumn([
                AccreditationApplication::EXPERIENCE,
                AccreditationApplication::TRAINERS_COUNT,
                AccreditationApplication::COMMENT,
                AccreditationApplication::CONSENT_AT,
                AccreditationApplication::MARKETING_CONSENT,
            ]);
        });
    }
};
