<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Category;
use App\Models\Pengajuan;
use App\Models\User; // DITAMBAHKAN
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Menampilkan Dashboard Utama Admin
     */
    public function index()
    {
        // PROTEKSI KEAMANAN
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses Ditolak! Panel ini hanya untuk Admin.');
        }

        // Kueri bawaan
        $totalBarang = Barang::count();
        $totalKategori = Category::count();
        $allBarang = Barang::with('category')->latest()->take(5)->get();
        $users = User::all(); // Mengambil data user untuk dashboard

        $totalPengajuan     = Pengajuan::count() ?? 0;
        $pengajuanPending   = Pengajuan::where('status', 'pending')->count() ?? 0;
        $pengajuanDisetujui = Pengajuan::where('status', 'verifikasi')->count() ?? 0;
        $pengajuanDitolak  = Pengajuan::where('status', 'ditolak')->count() ?? 0;

        return view('admin.dashboard', compact(
            'totalBarang', 'totalKategori', 'allBarang',
            'totalPengajuan', 'pengajuanPending', 'pengajuanDisetujui',
            'pengajuanDitolak', 'users'
        ));
    }


   // --- FITUR MANAJEMEN USER ---

    public function user_index()
    {
        $users = User::all();
        return view('admin.users_index', compact('users'));
    }

    public function user_destroy($id)
    {
        $user = User::findOrFail($id);

        // Mencegah admin menghapus akunnya sendiri
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun sendiri!');
        }

        $user->delete();
        return redirect()->back()->with('success', 'User berhasil dihapus!');
    }

    // Tambahkan metode baru ini di sini:
    public function user_store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:admin,karyawan,kepala-umum,keuangan',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User baru berhasil ditambahkan!');
    }

    // --- FITUR BARANG (KODE ANDA TETAP SAMA) ---

    public function barang_index()
    {
        $allBarang = Barang::with('category')->latest()->get();
        return view('admin.barang_index', compact('allBarang'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.create_barang', compact('categories'));
    }

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

    // --- FITUR KATEGORI (KODE ANDA TETAP SAMA) ---

    public function category_index()
    {
        $categories = Category::all();
        $totalCategory = $categories->count();

        return view('admin.category_index', compact('categories', 'totalCategory'));
    }

    public function category_store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:categories,nama_kategori',
        ]);

        Category::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->back()->with('success', 'Kategori baru berhasil disimpan ke sistem!');
    }

    public function category_edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category_edit', compact('category'));
    }

    public function category_update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:categories,nama_kategori,' . $id,
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
