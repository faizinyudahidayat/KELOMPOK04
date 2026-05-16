<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class KepalaUmumController extends Controller
{
    // 💡 KUNCI FIX: Konstruktor __construct() dengan $this->middleware() dihapus
    // karena jalur otentikasi 'auth' sudah ditangani langsung di routes/web.php

    /**
     * Tampilan Dashboard Kepala Umum
     */
    public function dashboard_index()
    {
        // PROTEKSI KEAMANAN: Jika yang masuk bukan kepala_umum, tendang kembali!
        if (Auth::user()->role !== 'kepala_umum') {
            abort(403, 'Akses Ditolak! Anda bukan Kepala Umum.');
        }

        // Ambil data statistik dari database
        $countPending  = Pengajuan::where('status', 'pending')->count() ?? 0;
        $countVerified = Pengajuan::where('status', 'verifikasi')->count() ?? 0;
        $countBarang   = Barang::count() ?? 0;
        $countKritis   = Barang::where('stok', '<=', 10)->count() ?? 0;

        // Ambil 5 antrean pengajuan terbaru dari karyawan yang statusnya masih pending
        $pendingPengajuans = Pengajuan::with(['user', 'barang'])
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        // Lempar data ke halaman blade view
        return view('kepala_umum.dashboard', compact(
            'countPending',
            'countVerified',
            'countBarang',
            'countKritis',
            'pendingPengajuans'
        ));
    }

    /**
     * FITUR AKSI: Menyetujui Pengajuan Karyawan
     */
    public function setujui($id)
    {
        // Proteksi keamanan level role
        if (Auth::user()->role !== 'kepala_umum') {
            abort(403, 'Akses Ditolak!');
        }

        // Cari data pengajuan berdasarkan ID, jika tidak ada langsung munculkan eror 404
        $pengajuan = Pengajuan::findOrFail($id);

        // Ubah status menjadi 'verifikasi' agar bisa diproses cetak/kurangi stok oleh Admin/Finance
        $pengajuan->status = 'verifikasi';
        $pengajuan->save();

        // Kembalikan ke halaman dashboard dengan notifikasi sukses gokil
        return redirect()->back()->with('success', 'Pengajuan logistik berhasil disetujui dan diteruskan ke Admin!');
    }

    /**
     * FITUR AKSI: Menolak Pengajuan Karyawan
     */
    public function tolak($id)
    {
        // Proteksi keamanan level role
        if (Auth::user()->role !== 'kepala_umum') {
            abort(403, 'Akses Ditolak!');
        }

        // Cari data pengajuan berdasarkan ID
        $pengajuan = Pengajuan::findOrFail($id);

        // Ubah status menjadi 'ditolak'
        $pengajuan->status = 'ditolak';
        $pengajuan->save();

        // Kembalikan ke halaman dashboard dengan notifikasi penolakan
        return redirect()->back()->with('success', 'Pengajuan logistik telah resmi ditolak.');
    }
}
