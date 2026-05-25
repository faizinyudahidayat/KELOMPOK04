<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Barang; // Pastikan model Barang sudah di-import
use Illuminate\Support\Facades\Auth;

class KepalaUmumController extends Controller
{
    public function dashboard_index()
    {
        // 1. Proteksi Keamanan
        if (Auth::user()->role !== 'kepala_umum' && Auth::user()->role !== 'kepala-umum') {
            abort(403, 'Akses Ditolak! Anda bukan Kepala Umum.');
        }

        // 2. Data Statistik (Dashboard Metrics)
        $countPending  = Pengajuan::where('status', 'pending')->count() ?? 0;
        $countVerified = Pengajuan::where('status', 'verifikasi')->count() ?? 0;
        $countBarang   = Barang::count() ?? 0;
        $countKritis   = Barang::where('stok', '<=', 10)->count() ?? 0;

        // 3. Data Stok Real-time (TAMBAHAN UNTUK MONITORING)
        // Kita ambil semua barang untuk ditampilkan di tab "Analisis Logistik"
        $stokLogistik = Barang::orderBy('stok', 'asc')->get();

        // 4. Antrean Pengajuan
        $pendingPengajuans = Pengajuan::with(['user', 'barang'])
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        return view('kepala_umum.dashboard', compact(
            'countPending',
            'countVerified',
            'countBarang',
            'countKritis',
            'pendingPengajuans',
            'stokLogistik' // Kirim data stok ke view
        ));
    }

    // ... method setujui() dan tolak() tetap sama ...
}
