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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel users (siapa yang mengajukan)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Menghubungkan ke tabel barangs (barang apa yang diajukan)
            $table->foreignId('barang_id')->constrained('barangs')->onDelete('cascade');

            $table->integer('jumlah');
            $table->text('alasan');

            // Status pengajuan sesuai alur diagram (Menunggu, Disetujui, Ditolak)
            $table->enum('status', ['pending', 'verifikasi', 'ditolak'])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
