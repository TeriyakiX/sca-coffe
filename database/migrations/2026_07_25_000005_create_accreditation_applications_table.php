<?php

declare(strict_types=1);

use App\Enums\Accreditation\AccreditationApplicationIndexEnum;
use App\Models\AccreditationApplication;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public final function up(): void
    {
        Schema::create(AccreditationApplication::DATABASE_TABLE, function (Blueprint $table) {
            $table->uuid(AccreditationApplication::ID)->primary();

            $table->string(AccreditationApplication::TYPE, 55);
            $table->string(AccreditationApplication::STATUS, 55);
            $table->string(AccreditationApplication::ORGANIZATION, 255);
            $table->string(AccreditationApplication::INN, 12)->nullable();
            $table->string(AccreditationApplication::CITY, 120);
            $table->string(AccreditationApplication::CONTACT_NAME, 255);
            $table->string(AccreditationApplication::CONTACT_POSITION, 255)->nullable();
            $table->string(AccreditationApplication::EMAIL, 255);
            $table->string(AccreditationApplication::PHONE, 32);
            $table->string(AccreditationApplication::SITE_URL, 2048)->nullable();
            $table->text(AccreditationApplication::PROGRAMS)->nullable();
            $table->text(AccreditationApplication::FACILITIES)->nullable();
            $table->text(AccreditationApplication::MANAGER_COMMENT)->nullable();

            $table->timestamp(AccreditationApplication::PROCESSED_AT)->nullable();
            $table->timestamp(AccreditationApplication::CREATED_AT)->nullable();
            $table->timestamp(AccreditationApplication::UPDATED_AT)->nullable();
            $table->timestamp(AccreditationApplication::DELETED_AT)->nullable();

            $table->index([AccreditationApplication::STATUS], AccreditationApplicationIndexEnum::INDEX_STATUS->value);
            $table->index([AccreditationApplication::TYPE], AccreditationApplicationIndexEnum::INDEX_TYPE->value);
            $table->index([AccreditationApplication::EMAIL], AccreditationApplicationIndexEnum::INDEX_EMAIL->value);
        });
    }

    public final function down(): void
    {
        Schema::dropIfExists(AccreditationApplication::DATABASE_TABLE);
    }
};
