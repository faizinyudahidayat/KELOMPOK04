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
        Schema::create('keuangans', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel pengajuans (foreign key)
            $table->foreignId('pengajuan_id')->nullable()->constrained('pengajuans')->onDelete('cascade');

            // Kolom pencatatan dana operasional inventaris
            $table->string('nomor_referensi', 50)->unique(); // Kode otomatis cetak bukti belanja
            $table->decimal('anggaran_DIsetujui', 12, 2)->default(0); // Nominal dana yang dicairkan
            $table->string('sumber_dana', 100)->default('Anggaran Kampus UNIBA');
            $table->text('catatan_keuangan')->nullable(); // Alasan pencairan atau penolakan
            $table->string('status_pembayaran', 50)->default('belum_dicairkan'); // atau 'lunas'

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keuangans');
    }
};
