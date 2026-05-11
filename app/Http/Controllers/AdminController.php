<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Category;

class AdminController extends Controller
{
    public function index()
    {
        // Menghitung jumlah data dari database
        $totalBarang = Barang::count();
        $totalKategori = Category::count();

        return view('admin.dashboard', compact('totalBarang', 'totalKategori'));
    }
}
