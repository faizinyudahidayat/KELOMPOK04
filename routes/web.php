<?php

use Illuminate\Support\Facades\Route;
// Import AdminController agar bisa digunakan
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

// Rute Dashboard Admin (Yang penting jalan dulu)
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
