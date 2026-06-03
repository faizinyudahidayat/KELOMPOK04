<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KepalaUmumController;
use App\Http\Controllers\KeuanganController;

/*
|--------------------------------------------------------------------------
| Web Routes — Sistem Inventaris Kelompok 04 (UNIBA Madura)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

// --- Rute Autentikasi ---
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'resetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'updatePassword'])->name('password.update');

/**
 * 1. Rute untuk Administrator (Prefix: admin)
 */
Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Manajemen Barang
    Route::get('/barang', [AdminController::class, 'barang_index'])->name('admin.barang.index');
    Route::get('/barang/create', [AdminController::class, 'create'])->name('admin.barang.create');
    Route::post('/barang/store', [AdminController::class, 'store'])->name('admin.barang.store');
    Route::get('/barang/{id}/edit', [AdminController::class, 'barang_edit'])->name('admin.barang.edit');
    Route::put('/barang/{id}/update', [AdminController::class, 'barang_update'])->name('admin.barang.update');
    Route::delete('/barang/{id}/delete', [AdminController::class, 'barang_destroy'])->name('admin.barang.destroy');

    // Manajemen Kategori
    Route::get('/category', [AdminController::class, 'category_index'])->name('admin.category.index');
    Route::post('/category/store', [AdminController::class, 'category_store'])->name('admin.category.store');
    Route::get('/category/{id}/edit', [AdminController::class, 'category_edit'])->name('admin.category.edit');
    Route::put('/category/{id}/update', [AdminController::class, 'category_update'])->name('admin.category.update');
    Route::delete('/category/{id}/delete', [AdminController::class, 'category_destroy'])->name('admin.category.destroy');

    // Manajemen User
    Route::get('/users', [AdminController::class, 'user_index'])->name('admin.users.index');
    Route::post('/users/store', [AdminController::class, 'user_store'])->name('admin.users.store');
    Route::put('/users/{id}', [AdminController::class, 'user_update'])->name('admin.users.update'); // <-- TAMBAHAN
    Route::delete('/users/{id}/delete', [AdminController::class, 'user_destroy'])->name('admin.users.destroy');
});

/**
 * 2. Rute untuk Karyawan
 */
Route::middleware(['auth'])->prefix('karyawan')->group(function () {
    Route::get('/dashboard', [KaryawanController::class, 'index'])->name('karyawan.dashboard');
    Route::get('/pengajuan', [KaryawanController::class, 'pengajuan_index'])->name('karyawan.pengajuan.index');
    Route::get('/pengajuan/create', [KaryawanController::class, 'pengajuan_create'])->name('karyawan.pengajuan.create');
    Route::post('/pengajuan/store', [KaryawanController::class, 'pengajuan_store'])->name('karyawan.pengajuan.store');
    Route::get('/laporan', [KaryawanController::class, 'laporan_index'])->name('karyawan.laporan.index');
});

/**
 * 3. Rute untuk Kepala Umum
 */
Route::middleware(['auth'])->prefix('kepala-umum')->group(function () {
    Route::get('/dashboard', [KepalaUmumController::class, 'dashboard_index'])->name('kepala_umum.dashboard');
    Route::post('/pengajuan/{id}/setujui', [KepalaUmumController::class, 'setujui'])->name('kepala_umum.pengajuan.setujui');
    Route::post('/pengajuan/{id}/tolak', [KepalaUmumController::class, 'tolak'])->name('kepala_umum.pengajuan.tolak');
});

/**
 * 4. Rute untuk Keuangan
 */
Route::middleware(['auth'])->prefix('keuangan')->group(function () {
    Route::get('/dashboard', [KeuanganController::class, 'index'])->name('keuangan.dashboard');
    Route::post('/pengajuan/{id}/cairkan', [KeuanganController::class, 'cairkan_dana'])->name('keuangan.pengajuan.cairkan');
    Route::get('/laporan', [KeuanganController::class, 'laporan_index'])->name('keuangan.laporan.index');
    Route::get('/anggaran', [KeuanganController::class, 'anggaran_index'])->name('keuangan.anggaran.index');
});
