<?php

declare(strict_types=1);

use App\Enums\Contact\ContactRequestIndexEnum;
use App\Models\ContactRequest;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public final function up(): void
    {
        Schema::create(ContactRequest::DATABASE_TABLE, function (Blueprint $table) {
            $table->uuid(ContactRequest::ID)->primary();

            $table->string(ContactRequest::TOPIC, 55);
            $table->string(ContactRequest::STATUS, 55);
            $table->string(ContactRequest::NAME, 255);
            $table->string(ContactRequest::EMAIL, 255);
            $table->text(ContactRequest::MESSAGE);
            $table->text(ContactRequest::MANAGER_COMMENT)->nullable();

            $table->timestamp(ContactRequest::PROCESSED_AT)->nullable();
            $table->timestamp(ContactRequest::CREATED_AT)->nullable();
            $table->timestamp(ContactRequest::UPDATED_AT)->nullable();
            $table->timestamp(ContactRequest::DELETED_AT)->nullable();

            $table->index([ContactRequest::STATUS], ContactRequestIndexEnum::INDEX_STATUS->value);
            $table->index([ContactRequest::TOPIC], ContactRequestIndexEnum::INDEX_TOPIC->value);
            $table->index([ContactRequest::EMAIL], ContactRequestIndexEnum::INDEX_EMAIL->value);
        });
    }

    public final function down(): void
    {
        Schema::dropIfExists(ContactRequest::DATABASE_TABLE);
    }
};
