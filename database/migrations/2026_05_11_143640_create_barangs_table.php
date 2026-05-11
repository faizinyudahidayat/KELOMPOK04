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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel categories (Foreign Key)
            // Penting: Pastikan migration 'categories' sudah dijalankan lebih dulu
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');

            $table->string('nama_barang');
            $table->string('merk');
            $table->text('spesifikasi');
            $table->integer('stok')->default(0);
            $table->decimal('harga', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
