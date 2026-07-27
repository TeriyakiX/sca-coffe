<?php

declare(strict_types=1);

use App\Enums\News\NewsIndexEnum;
use App\Models\News;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public final function up(): void
    {
        Schema::create(News::DATABASE_TABLE, function (Blueprint $table) {
            $table->uuid(News::ID)->primary();

            $table->string(News::SLUG, 255)->unique(NewsIndexEnum::UNIQUE_INDEX_SLUG->value);
            $table->string(News::CATEGORY, 55);
            $table->string(News::STATUS, 55);
            $table->string(News::TITLE, 255);
            $table->string(News::EXCERPT, 500);
            $table->longText(News::CONTENT)->nullable();
            $table->string(News::COVER_URL, 2048)->nullable();

            $table->timestamp(News::PUBLISHED_AT)->nullable();
            $table->timestamp(News::CREATED_AT)->nullable();
            $table->timestamp(News::UPDATED_AT)->nullable();
            $table->timestamp(News::DELETED_AT)->nullable();

            $table->index([News::CATEGORY], NewsIndexEnum::INDEX_CATEGORY->value);
            $table->index([News::STATUS], NewsIndexEnum::INDEX_STATUS->value);
            $table->index([News::PUBLISHED_AT], NewsIndexEnum::INDEX_PUBLISHED_AT->value);
        });
    }

    public final function down(): void
    {
        Schema::dropIfExists(News::DATABASE_TABLE);
    }
};
