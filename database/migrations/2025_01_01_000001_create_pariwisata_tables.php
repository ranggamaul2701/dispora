<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('destinasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->string('kategori');
            $table->string('gambar')->nullable();
            $table->string('icon', 20)->default('🌴');
            $table->decimal('rating', 2, 1)->default(0);
            $table->unsignedInteger('ulasan')->default(0);
            $table->string('harga')->default('Gratis');
            $table->string('jam')->default('08.00 - 17.00 WITA');
            $table->string('durasi')->default('1 - 2 Jam');
            $table->text('alamat');
            $table->text('maps')->nullable();
            $table->text('deskripsi');
            $table->json('fasilitas')->nullable();
            $table->text('tips')->nullable();
            $table->string('galeri_slug')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('kategori');
            $table->string('gambar')->nullable();
            $table->string('icon', 20)->default('📰');
            $table->text('ringkasan');
            $table->longText('konten');
            $table->unsignedInteger('views')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        Schema::create('agenda', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('lokasi');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();
            $table->string('jam_mulai')->nullable();
            $table->string('kategori');
            $table->string('icon', 20)->default('📅');
            $table->text('deskripsi');
            $table->string('penyelenggara')->nullable();
            $table->string('kontak')->nullable();
            $table->string('gambar')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        Schema::create('pesan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('subjek');
            $table->text('isi');
            $table->boolean('dibaca')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesan');
        Schema::dropIfExists('agenda');
        Schema::dropIfExists('berita');
        Schema::dropIfExists('destinasi');
    }
};
