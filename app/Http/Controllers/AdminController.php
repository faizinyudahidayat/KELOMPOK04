<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Category;

class AdminController extends Controller
{
    /**
     * Menampilkan Dashboard Utama
     */
    public function index()
    {
        $totalBarang = Barang::count();
        $totalKategori = Category::count();
        $allBarang = Barang::with('category')->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalBarang', 'totalKategori', 'allBarang'));
    }

    /**
     * Menampilkan Daftar Semua Barang
     */
    public function barang_index()
    {
        $allBarang = Barang::with('category')->latest()->get();
        return view('admin.barang_index', compact('allBarang'));
    }

    /**
     * Menampilkan Daftar Kategori
     */
    public function category_index()
    {
        $categories = Category::all();
        return view('admin.category_index', compact('categories'));
    }

    /**
     * Menampilkan Form Tambah Barang
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.create_barang', compact('categories'));
    }

    /**
     * Menyimpan data barang baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'nama_barang' => 'required|string|max:255',
            'merk'        => 'required|string|max:100',
            'stok'        => 'required|integer|min:0',
            'harga'       => 'required|numeric|min:0',
            'spesifikasi' => 'nullable|string',
        ]);

        Barang::create([
            'category_id' => $request->category_id,
            'nama_barang' => $request->nama_barang,
            'merk'        => $request->merk,
            'stok'        => $request->stok,
            'harga'       => $request->harga,
            'spesifikasi' => $request->spesifikasi ?? '-',
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Barang berhasil ditambahkan!');
    }

    // --- FITUR EDIT, UPDATE, & DELETE BARANG ---

    public function barang_edit($id)
    {
        $barang = Barang::findOrFail($id);
        $categories = Category::all();
        return view('admin.barang_edit', compact('barang', 'categories'));
    }

    public function barang_update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'nama_barang' => 'required|string|max:255',
            'merk'        => 'required|string|max:100',
            'stok'        => 'required|integer|min:0',
            'harga'       => 'required|numeric|min:0',
            'spesifikasi' => 'nullable|string',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update([
            'category_id' => $request->category_id,
            'nama_barang' => $request->nama_barang,
            'merk'        => $request->merk,
            'stok'        => $request->stok,
            'harga'       => $request->harga,
            'spesifikasi' => $request->spesifikasi ?? '-',
        ]);

        return redirect()->route('admin.barang.index')->with('success', 'Data barang berhasil diperbarui!');
    }

    public function barang_destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();
        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil dihapus!');
    }

    // --- FITUR EDIT, UPDATE, & DELETE KATEGORI ---

    public function category_edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category_edit', compact('category'));
    }

    public function category_update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('admin.category.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function category_destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.category.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
