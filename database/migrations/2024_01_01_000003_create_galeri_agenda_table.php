<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('album_galeri', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->string('cover')->nullable();
            $table->timestamps();
        });

        Schema::create('galeri', function (Blueprint $table) {
            $table->id();
            $table->foreignId('album_id')->constrained('album_galeri')->onDelete('cascade');
            $table->string('judul');
            $table->string('file');
            $table->enum('tipe', ['foto', 'video'])->default('foto');
            $table->timestamps();
        });

        Schema::create('agenda', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->string('lokasi');
            $table->string('kategori');
            $table->string('jam')->nullable();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->time('jam_mulai')->nullable();
            $table->string('penyelenggara')->nullable();
            $table->string('kontak')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        Schema::create('kontak_pesan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('subjek');
            $table->text('pesan');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kontak_pesan');
        Schema::dropIfExists('agenda');
        Schema::dropIfExists('galeri');
        Schema::dropIfExists('album_galeri');
    }
};
