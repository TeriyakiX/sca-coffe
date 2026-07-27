<?php

declare(strict_types=1);

use App\Enums\Content\ContentBlockIndexEnum;
use App\Models\ContentBlock;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public final function up(): void
    {
        Schema::create(ContentBlock::DATABASE_TABLE, function (Blueprint $table) {
            $table->uuid(ContentBlock::ID)->primary();

            $table->string(ContentBlock::KEY, 120)->unique(ContentBlockIndexEnum::UNIQUE_INDEX_KEY->value);
            $table->string(ContentBlock::SECTION, 55);
            $table->string(ContentBlock::TITLE, 255)->nullable();
            $table->string(ContentBlock::SUBTITLE, 500)->nullable();
            $table->text(ContentBlock::BODY)->nullable();
            $table->json(ContentBlock::ITEMS)->nullable();
            $table->unsignedSmallInteger(ContentBlock::SORT_ORDER)->default(0);

            $table->timestamp(ContentBlock::CREATED_AT)->nullable();
            $table->timestamp(ContentBlock::UPDATED_AT)->nullable();
            $table->timestamp(ContentBlock::DELETED_AT)->nullable();

            $table->index([ContentBlock::SECTION], ContentBlockIndexEnum::INDEX_SECTION->value);
            $table->index([ContentBlock::SORT_ORDER], ContentBlockIndexEnum::INDEX_SORT_ORDER->value);
        });
    }

    public final function down(): void
    {
        Schema::dropIfExists(ContentBlock::DATABASE_TABLE);
    }
};
