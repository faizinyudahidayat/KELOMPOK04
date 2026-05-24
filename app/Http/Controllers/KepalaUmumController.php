<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class KepalaUmumController extends Controller
{
    /**
     * Tampilan Dashboard Kepala Umum
     */
    public function dashboard_index()
    {
        // PROTEKSI KEAMANAN: Memeriksa kedua format role ('kepala_umum' dan 'kepala-umum')
        if (Auth::user()->role !== 'kepala_umum' && Auth::user()->role !== 'kepala-umum') {
            abort(403, 'Akses Ditolak! Anda bukan Kepala Umum.');
        }

        // Ambil data statistik dari database db_inventaris
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
        // Proteksi keamanan level role ganda
        if (Auth::user()->role !== 'kepala_umum' && Auth::user()->role !== 'kepala-umum') {
            abort(403, 'Akses Ditolak!');
        }

        // Cari data pengajuan berdasarkan ID
        $pengajuan = Pengajuan::findOrFail($id);

        // Ubah status menjadi 'verifikasi' agar sinkron dengan sistem logistik pusat
        $pengajuan->status = 'verifikasi';
        $pengajuan->save();

        return redirect()->back()->with('success', 'Pengajuan logistik berhasil disetujui dan diteruskan ke Admin!');
    }

    /**
     * FITUR AKSI: Menolak Pengajuan Karyawan
     */
    public function tolak($id)
    {
        // Proteksi keamanan level role ganda
        if (Auth::user()->role !== 'kepala_umum' && Auth::user()->role !== 'kepala-umum') {
            abort(403, 'Akses Ditolak!');
        }

        // Cari data pengajuan berdasarkan ID
        $pengajuan = Pengajuan::findOrFail($id);

        // Ubah status menjadi 'ditolak'
        $pengajuan->status = 'ditolak';
        $pengajuan->save();

        return redirect()->back()->with('success', 'Pengajuan logistik telah resmi ditolak.');
    }
}
