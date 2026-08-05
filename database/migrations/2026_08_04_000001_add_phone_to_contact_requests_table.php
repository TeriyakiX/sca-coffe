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
            // Раздел 5.2 правок: телефон в форме обратной связи, необязательный
            $table->string(ContactRequest::PHONE, 32)
                ->nullable()
                ->after(ContactRequest::EMAIL);
        });
    }

    public final function down(): void
    {
        Schema::table(ContactRequest::DATABASE_TABLE, function (Blueprint $table) {
            $table->dropColumn(ContactRequest::PHONE);
        });
    }
};
