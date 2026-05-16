<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Matikan pengecekan foreign key agar MySQL mengizinkan dikosongkan
        Schema::disableForeignKeyConstraints();

        // 2. Kosongkan tabel barangs
        DB::table('barangs')->truncate();

        // 3. Masukkan data yang sudah fix tanpa kolom 'kondisi'
        DB::table('barangs')->insert([
            [
                'nama_barang' => 'Kertas A4 HVS 80gr',
                'stok' => 25,
                'category_id' => 2,
                'merk' => 'Sinar Dunia',
                'spesifikasi' => 'Warna putih bersih, ukuran 210 x 297 mm, isi 500 lembar.',
                'harga' => 55000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_barang' => 'Tinta Printer Hitam',
                'stok' => 10,
                'category_id' => 2,
                'merk' => 'Epson',
                'spesifikasi' => 'Tinta botol original seri 003, volume 65ml, warna hitam.',
                'harga' => 95000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_barang' => 'Proyektor Portable',
                'stok' => 3,
                'category_id' => 3,
                'merk' => 'Epson',
                'spesifikasi' => 'Resolusi XGA, kecerahan 3600 lumens, konektivitas HDMI & VGA.',
                'harga' => 6500000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 4. Nyalakan kembali pengecekan foreign key demi keamanan database
        Schema::enableForeignKeyConstraints();
    }
}
