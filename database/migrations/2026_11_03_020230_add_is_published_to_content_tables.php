<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $tables = ['destinasi', 'berita', 'agenda'];

        foreach ($tables as $table) {
            if (Schema::hasTable($table) &&
                !Schema::hasColumn($table, 'is_published')) {

                Schema::table($table, function (Blueprint $table) {
                    $table->boolean('is_published')
                        ->default(true)
                        ->after('id');
                });
            }
        }
    }

    public function down(): void
    {
        $tables = ['destinasi', 'berita', 'agenda'];

        foreach ($tables as $table) {
            if (Schema::hasTable($table) &&
                Schema::hasColumn($table, 'is_published')) {

                Schema::table($table, function (Blueprint $table) {
                    $table->dropColumn('is_published');
                });
            }
        }
    }
};