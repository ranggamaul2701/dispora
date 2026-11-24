<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('berita') && Schema::hasColumn('berita', 'kategori_id')) {
            Schema::table('berita', function (Blueprint $table) {
                $table->unsignedBigInteger('kategori_id')->nullable()->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('berita') && Schema::hasColumn('berita', 'kategori_id')) {
            Schema::table('berita', function (Blueprint $table) {
                $table->unsignedBigInteger('kategori_id')->nullable(false)->change();
            });
        }
    }
};
