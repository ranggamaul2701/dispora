<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('destinasi') && !Schema::hasColumn('destinasi', 'foto_tambahan')) {
            Schema::table('destinasi', function (Blueprint $table) {
                $table->json('foto_tambahan')->nullable()->after('gambar');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('destinasi') && Schema::hasColumn('destinasi', 'foto_tambahan')) {
            Schema::table('destinasi', function (Blueprint $table) {
                $table->dropColumn('foto_tambahan');
            });
        }
    }
};
