<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        // Tambahkan kolom foto ke tabel berita
        // jika tabel dan kolom tersebut belum ada.
        if (
            Schema::hasTable('berita') &&
            !Schema::hasColumn('berita', 'foto')
        ) {
            Schema::table('berita', function (Blueprint $table) {
                $table->string('foto')->nullable();
            });
        }

        // Tambahkan kolom foto ke tabel destinasi
        // jika tabel dan kolom tersebut belum ada.
        if (
            Schema::hasTable('destinasi') &&
            !Schema::hasColumn('destinasi', 'foto')
        ) {
            Schema::table('destinasi', function (Blueprint $table) {
                $table->string('foto')->nullable();
            });
        }

        // Tambahkan kolom foto ke tabel agenda
        // jika tabel dan kolom tersebut belum ada.
        if (
            Schema::hasTable('agenda') &&
            !Schema::hasColumn('agenda', 'foto')
        ) {
            Schema::table('agenda', function (Blueprint $table) {
                $table->string('foto')->nullable();
            });
        }
    }

    /**
     * Membatalkan migration.
     */
    public function down(): void
    {
        // Hapus kolom foto dari tabel berita
        if (
            Schema::hasTable('berita') &&
            Schema::hasColumn('berita', 'foto')
        ) {
            Schema::table('berita', function (Blueprint $table) {
                $table->dropColumn('foto');
            });
        }

        // Hapus kolom foto dari tabel destinasi
        if (
            Schema::hasTable('destinasi') &&
            Schema::hasColumn('destinasi', 'foto')
        ) {
            Schema::table('destinasi', function (Blueprint $table) {
                $table->dropColumn('foto');
            });
        }

        // Hapus kolom foto dari tabel agenda
        if (
            Schema::hasTable('agenda') &&
            Schema::hasColumn('agenda', 'foto')
        ) {
            Schema::table('agenda', function (Blueprint $table) {
                $table->dropColumn('foto');
            });
        }
    }
};