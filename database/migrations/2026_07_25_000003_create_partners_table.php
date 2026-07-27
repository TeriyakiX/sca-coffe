<?php

declare(strict_types=1);

use App\Enums\Partner\PartnerIndexEnum;
use App\Models\Partner;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public final function up(): void
    {
        Schema::create(Partner::DATABASE_TABLE, function (Blueprint $table) {
            $table->uuid(Partner::ID)->primary();

            $table->string(Partner::SLUG, 255)->unique(PartnerIndexEnum::UNIQUE_INDEX_SLUG->value);
            $table->string(Partner::CATEGORY, 55);
            $table->string(Partner::STATUS, 55);
            $table->string(Partner::NAME, 255);
            $table->text(Partner::DESCRIPTION)->nullable();
            $table->text(Partner::BENEFIT)->nullable();
            $table->string(Partner::LOGO_URL, 2048)->nullable();
            $table->string(Partner::SITE_URL, 2048)->nullable();
            $table->unsignedSmallInteger(Partner::SORT_ORDER)->default(0);

            $table->timestamp(Partner::CREATED_AT)->nullable();
            $table->timestamp(Partner::UPDATED_AT)->nullable();
            $table->timestamp(Partner::DELETED_AT)->nullable();

            $table->index([Partner::CATEGORY], PartnerIndexEnum::INDEX_CATEGORY->value);
            $table->index([Partner::STATUS], PartnerIndexEnum::INDEX_STATUS->value);
        });
    }

    public final function down(): void
    {
        Schema::dropIfExists(Partner::DATABASE_TABLE);
    }
};
