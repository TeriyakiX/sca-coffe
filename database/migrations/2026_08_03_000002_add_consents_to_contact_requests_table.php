<?php

declare(strict_types=1);

use App\Models\ContactRequest;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public final function up(): void
    {
        Schema::table(ContactRequest::DATABASE_TABLE, function (Blueprint $table) {
            $table->timestamp(ContactRequest::CONSENT_AT)
                ->nullable()
                ->after(ContactRequest::MESSAGE);

            $table->boolean(ContactRequest::MARKETING_CONSENT)
                ->default(false)
                ->after(ContactRequest::CONSENT_AT);
        });
    }

    public final function down(): void
    {
        Schema::table(ContactRequest::DATABASE_TABLE, function (Blueprint $table) {
            $table->dropColumn([
                ContactRequest::CONSENT_AT,
                ContactRequest::MARKETING_CONSENT,
            ]);
        });
    }
};
