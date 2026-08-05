<?php

declare(strict_types=1);

use App\Models\News;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public final function up(): void
    {
        Schema::table(News::DATABASE_TABLE, function (Blueprint $table) {
            // Чек-лист документа: у каждого материала должен быть автор или редакция.
            $table->string(News::AUTHOR, 255)
                ->nullable()
                ->after(News::EXCERPT);
        });
    }

    public final function down(): void
    {
        Schema::table(News::DATABASE_TABLE, function (Blueprint $table) {
            $table->dropColumn(News::AUTHOR);
        });
    }
};
