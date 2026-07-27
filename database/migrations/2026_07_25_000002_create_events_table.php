<?php

declare(strict_types=1);

use App\Enums\Event\EventIndexEnum;
use App\Models\Event;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public final function up(): void
    {
        Schema::create(Event::DATABASE_TABLE, function (Blueprint $table) {
            $table->uuid(Event::ID)->primary();

            $table->string(Event::SLUG, 255)->unique(EventIndexEnum::UNIQUE_INDEX_SLUG->value);
            $table->string(Event::TYPE, 55);
            $table->string(Event::STATUS, 55);
            $table->string(Event::TITLE, 255);
            $table->text(Event::DESCRIPTION)->nullable();
            $table->string(Event::PLACE, 255)->nullable();
            $table->string(Event::REGISTRATION_URL, 2048)->nullable();

            $table->timestamp(Event::STARTS_AT);
            $table->timestamp(Event::ENDS_AT)->nullable();
            $table->timestamp(Event::CREATED_AT)->nullable();
            $table->timestamp(Event::UPDATED_AT)->nullable();
            $table->timestamp(Event::DELETED_AT)->nullable();

            $table->index([Event::TYPE], EventIndexEnum::INDEX_TYPE->value);
            $table->index([Event::STATUS], EventIndexEnum::INDEX_STATUS->value);
            $table->index([Event::STARTS_AT], EventIndexEnum::INDEX_STARTS_AT->value);
        });
    }

    public final function down(): void
    {
        Schema::dropIfExists(Event::DATABASE_TABLE);
    }
};
