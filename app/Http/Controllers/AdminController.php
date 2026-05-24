<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Category;
use App\Models\Pengajuan; // Memanggil model Pengajuan agar terhubung ke db_inventaris
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Menampilkan Dashboard Utama Admin
     */
    public function index()
    {
        // PROTEKSI KEAMANAN: Jika yang memaksa masuk bukan admin, langsung tolak!
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses Ditolak! Panel ini hanya untuk Admin.');
        }

        // Kueri bawaan Admin data barang dan kategori
        $totalBarang = Barang::count();
        $totalKategori = Category::count();
        $allBarang = Barang::with('category')->latest()->take(5)->get();

        // FIXED SYNCHRONIZATION: Variabel sinkron dengan Blade panel utama
        $totalPengajuan    = Pengajuan::count() ?? 0;
        $pengajuanPending  = Pengajuan::where('status', 'pending')->count() ?? 0;
        $pengajuanDisetujui = Pengajuan::where('status', 'verifikasi')->count() ?? 0;
        $pengajuanDitolak  = Pengajuan::where('status', 'ditolak')->count() ?? 0;

        // Melempar semua variabel ke file blade dashboard admin
        return view('admin.dashboard', compact(
            'totalBarang',
            'totalKategori',
            'allBarang',
            'totalPengajuan',
            'pengajuanPending',
            'pengajuanDisetujui',
            'pengajuanDitolak'
        ));
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

    // --- FITUR MANAJEMEN KATEGORI (FIXED SINKRONISASI FIELD) ---

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
     * FIXED: Request disamakan menggunakan 'nama_kategori' sesuai modal form Blade
     */
    public function category_store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:categories,nama_kategori',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique'   => 'Nama kategori sudah terdaftar di sistem.',
        ]);

        Category::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        // Dialihkan kembali dengan membawa notifikasi sukses pop-up
        return redirect()->back()->with('success', 'Kategori baru berhasil disimpan ke sistem!');
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
     * FIXED: Request disamakan menggunakan 'nama_kategori'
     */
    public function category_update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:categories,nama_kategori,' . $id,
        ], [
            'nama_kategori.required' => 'Nama kategori tidak boleh kosong.',
            'nama_kategori.unique'   => 'Nama kategori sudah digunakan.',
        ]);

        $category = Category::findOrFail($id);

        $category->update([
            'nama_kategori' => $request->nama_kategori
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
