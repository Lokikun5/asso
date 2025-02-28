<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('institution_partners', function (Blueprint $table) {
            // ✅ Changer `additional_info` de JSON à VARCHAR(191)
            $table->string('additional_info', 191)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('institution_partners', function (Blueprint $table) {
            // ⏪ Revenir au type JSON en cas de rollback
            $table->json('additional_info')->nullable()->change();
        });
    }
};