<?php

declare(strict_types=1);

use App\Enums\Page\PageIndexEnum;
use App\Models\Page;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public final function up(): void
    {
        Schema::create(Page::DATABASE_TABLE, function (Blueprint $table) {
            $table->uuid(Page::ID)->primary();

            $table->string(Page::SLUG, 255)->unique(PageIndexEnum::UNIQUE_INDEX_SLUG->value);
            $table->string(Page::STATUS, 55);
            $table->string(Page::TITLE, 255);
            $table->longText(Page::CONTENT)->nullable();
            $table->unsignedSmallInteger(Page::SORT_ORDER)->default(0);

            $table->timestamp(Page::CREATED_AT)->nullable();
            $table->timestamp(Page::UPDATED_AT)->nullable();
            $table->timestamp(Page::DELETED_AT)->nullable();

            $table->index([Page::STATUS], PageIndexEnum::INDEX_STATUS->value);
            $table->index([Page::SORT_ORDER], PageIndexEnum::INDEX_SORT_ORDER->value);
        });
    }

    public final function down(): void
    {
        Schema::dropIfExists(Page::DATABASE_TABLE);
    }
};
