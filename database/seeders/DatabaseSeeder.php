<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil seeder secara berurutan agar data langsung siap pakai
        $this->call([
            UserSeeder::class,   // Membuat akun Admin Faizin & Karyawan Yuda
            BarangSeeder::class, // Membuat data master barang (Kertas, Tinta, Proyektor)
        ]);
    }
}
