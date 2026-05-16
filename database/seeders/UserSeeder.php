<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Akun Khusus Admin
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Faizin',
                'password' => Hash::make('admin1234'),
                'role' => 'admin',
            ]
        );

        // 2. Akun Khusus Karyawan
        User::updateOrCreate(
            ['email' => 'karyawan@gmail.com'],
            [
                'name' => 'Karyawan ',
                'password' => Hash::make('karyawan123'),
                'role' => 'karyawan',
            ]
        );
    }
}
