<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Utama dialihkan ke login jika ingin sistem tertutup
Route::get('/', function () {
    return redirect()->route('login');
});

/**
 * Rute Autentikasi (Login & Logout)
 */
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


/**
 * Rute untuk Administrator (Diproteksi Middleware Auth)
 */
Route::middleware(['auth'])->prefix('admin')->group(function () {

    // 1. Dashboard Utama
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // 2. Manajemen Barang
    Route::get('/barang', [AdminController::class, 'barang_index'])->name('admin.barang.index');
    Route::get('/barang/create', [AdminController::class, 'create'])->name('admin.barang.create');
    Route::post('/barang/store', [AdminController::class, 'store'])->name('admin.barang.store');

    // Fitur Edit & Delete Barang
    Route::get('/barang/{id}/edit', [AdminController::class, 'barang_edit'])->name('admin.barang.edit');
    Route::put('/barang/{id}/update', [AdminController::class, 'barang_update'])->name('admin.barang.update');
    Route::delete('/barang/{id}/delete', [AdminController::class, 'barang_destroy'])->name('admin.barang.destroy');

    // 3. Manajemen Kategori
    Route::get('/category', [AdminController::class, 'category_index'])->name('admin.category.index');

    // Fitur Edit & Delete Kategori
    Route::get('/category/{id}/edit', [AdminController::class, 'category_edit'])->name('admin.category.edit');
    Route::put('/category/{id}/update', [AdminController::class, 'category_update'])->name('admin.category.update');
    Route::delete('/category/{id}/delete', [AdminController::class, 'category_destroy'])->name('admin.category.destroy');

});
