<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KaryawanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Utama dialihkan ke login
Route::get('/', function () {
    return redirect()->route('login');
});

/**
 * Rute Autentikasi (Login, Logout, & Lupa Password)
 */
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Fitur Lupa Password
Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'resetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'updatePassword'])->name('password.update');


/**
 * 1. Rute untuk Administrator (Prefix: admin)
 */
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Dashboard Utama
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Manajemen Barang
    Route::get('/barang', [AdminController::class, 'barang_index'])->name('admin.barang.index');
    Route::get('/barang/create', [AdminController::class, 'create'])->name('admin.barang.create');
    Route::post('/barang/store', [AdminController::class, 'store'])->name('admin.barang.store');
    Route::get('/barang/{id}/edit', [AdminController::class, 'barang_edit'])->name('admin.barang.edit');
    Route::put('/barang/{id}/update', [AdminController::class, 'barang_update'])->name('admin.barang.update');
    Route::delete('/barang/{id}/delete', [AdminController::class, 'barang_destroy'])->name('admin.barang.destroy');

    // Manajemen Kategori (SUDAH DIPERBAIKI)
    Route::get('/category', [AdminController::class, 'category_index'])->name('admin.category.index');
    Route::post('/category/store', [AdminController::class, 'category_store'])->name('admin.category.store'); // 👈 KUNCI UTAMA: Penyelamat Tombol Tambah Kategori
    Route::get('/category/{id}/edit', [AdminController::class, 'category_edit'])->name('admin.category.edit');
    Route::put('/category/{id}/update', [AdminController::class, 'category_update'])->name('admin.category.update');
    Route::delete('/category/{id}/delete', [AdminController::class, 'category_destroy'])->name('admin.category.destroy');
});


/**
 * 2. Rute untuk Karyawan (Prefix: karyawan)
 * Sesuai Use Case: Melakukan Pengajuan & Lihat Laporan
 */
Route::middleware(['auth'])->prefix('karyawan')->group(function () {
    // Dashboard Karyawan
    Route::get('/dashboard', [KaryawanController::class, 'index'])->name('karyawan.dashboard');

    // Fitur Melakukan Pengajuan Barang
    Route::get('/pengajuan', [KaryawanController::class, 'pengajuan_index'])->name('karyawan.pengajuan.index');
    Route::get('/pengajuan/create', [KaryawanController::class, 'pengajuan_create'])->name('karyawan.pengajuan.create');
    Route::post('/pengajuan/store', [KaryawanController::class, 'pengajuan_store'])->name('karyawan.pengajuan.store');

    // Fitur Melihat Laporan Inventaris (Stok)
    Route::get('/laporan', [KaryawanController::class, 'laporan_index'])->name('karyawan.laporan.index');
});
