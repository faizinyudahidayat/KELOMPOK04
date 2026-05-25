<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // ◄ PENTING

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Memaksa MySQL mengubah ENUM lama menjadi VARCHAR(50) agar bebas menampung 'keuangan'
        DB::statement("ALTER TABLE users MODIFY COLUMN role VARCHAR(50) NOT NULL DEFAULT 'karyawan'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Mengembalikan ke ENUM semula jika migrasi di-rollback
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'karyawan', 'kepala_umum') NOT NULL DEFAULT 'karyawan'");
    }
};
