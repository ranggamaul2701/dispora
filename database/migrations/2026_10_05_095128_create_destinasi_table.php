<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('destinasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->string('kategori');
            $table->string('foto')->nullable();
            $table->string('icon')->default('🌴');
            $table->decimal('rating', 2, 1)->default(0);
            $table->integer('ulasan')->default(0);
            $table->string('harga')->default('Gratis');
            $table->string('jam')->default('08.00-17.00');
            $table->string('durasi')->default('1-2 Jam');
            $table->text('alamat');
            $table->text('maps')->nullable();
            $table->text('deskripsi');
            $table->json('fasilitas')->nullable();
            $table->text('tips')->nullable();
            $table->string('galeri_slug')->nullable();
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('destinasi');
    }
};