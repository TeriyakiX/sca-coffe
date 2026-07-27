<?php

declare(strict_types=1);

use App\Enums\Membership\MembershipApplicationIndexEnum;
use App\Models\MembershipApplication;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public final function up(): void
    {
        Schema::create(MembershipApplication::DATABASE_TABLE, function (Blueprint $table) {
            $table->uuid(MembershipApplication::ID)->primary();

            $table->string(MembershipApplication::CATEGORY, 55);
            $table->string(MembershipApplication::SPECIALIZATION, 55);
            $table->string(MembershipApplication::STATUS, 55);
            $table->string(MembershipApplication::NAME, 255);
            $table->string(MembershipApplication::EMAIL, 255);
            $table->string(MembershipApplication::PHONE, 32);
            $table->string(MembershipApplication::CITY, 120);
            $table->string(MembershipApplication::COMPANY, 255)->nullable();
            $table->text(MembershipApplication::ABOUT)->nullable();
            $table->text(MembershipApplication::MANAGER_COMMENT)->nullable();

            $table->timestamp(MembershipApplication::PROCESSED_AT)->nullable();
            $table->timestamp(MembershipApplication::CREATED_AT)->nullable();
            $table->timestamp(MembershipApplication::UPDATED_AT)->nullable();
            $table->timestamp(MembershipApplication::DELETED_AT)->nullable();

            $table->index([MembershipApplication::STATUS], MembershipApplicationIndexEnum::INDEX_STATUS->value);
            $table->index([MembershipApplication::CATEGORY], MembershipApplicationIndexEnum::INDEX_CATEGORY->value);
            $table->index([MembershipApplication::EMAIL], MembershipApplicationIndexEnum::INDEX_EMAIL->value);
        });
    }

    public final function down(): void
    {
        Schema::dropIfExists(MembershipApplication::DATABASE_TABLE);
    }
};
