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

    // --- FITUR MANAJEMEN KATEGORI (FIXED COLUMN) ---

    /**
     * 1. Menampilkan Daftar Kategori
     */
    public function category_index()
    {
        $categories = Category::all();
        $totalCategory = $categories->count();

        return view('admin.category_index', compact('categories', 'totalCategory'));
    }

    /**
     * 2. Menyimpan Kategori Baru
     */
    public function category_store(Request $request)
    {
        // Tetap menggunakan input form 'name', tapi dicek ke kolom 'nama_kategori' di DB
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,nama_kategori',
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Nama kategori sudah terdaftar.',
        ]);

        // FIX: Simpan ke kolom 'nama_kategori'
        Category::create([
            'nama_kategori' => $request->name
        ]);

        return redirect()->route('admin.category.index')->with('success', 'Kategori baru berhasil disimpan!');
    }

    /**
     * 3. Menampilkan Form Edit Kategori
     */
    public function category_edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category_edit', compact('category'));
    }

    /**
     * 4. Memproses Update Kategori
     */
    public function category_update(Request $request, $id)
    {
        // FIX: Validasi unik mengecek ke kolom 'nama_kategori'
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,nama_kategori,' . $id,
        ], [
            'name.required' => 'Nama kategori tidak boleh kosong.',
            'name.unique' => 'Nama kategori sudah digunakan.',
        ]);

        $category = Category::findOrFail($id);

        // FIX: Update ke kolom 'nama_kategori'
        $category->update([
            'nama_kategori' => $request->name
        ]);

        return redirect()->route('admin.category.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * 5. Menghapus Kategori
     */
    public function category_destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.category.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
