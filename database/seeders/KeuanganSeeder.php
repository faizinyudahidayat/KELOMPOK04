<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class KeuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pengecekan agar data tidak duplikat saat dijalankan ulang di db_inventaris
        $cekUser = User::where('email', 'keuangan@gmail.com')->first();

        if (!$cekUser) {
            User::create([
                'name'     => 'Staf Keuangan Kelompok 04',
                'email'    => 'keuangan@gmail.com',
                'password' => Hash::make('keuangan1'), // Otomatis di-Bcrypt aman oleh Laravel
                'role'     => 'keuangan',
            ]);

            $this->command->info('Sukses: Akun Keuangan berhasil ditambahkan!');
        } else {
            $this->command->warn('Peringatan: Akun Keuangan dengan email tersebut sudah ada.');
        }
    }
}
