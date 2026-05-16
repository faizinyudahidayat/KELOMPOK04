<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;

class KaryawanController extends Controller
{
    /**
     * Tampilan Dashboard Karyawan
     * Menampilkan statistik pengajuan milik user yang sedang login.
     */
    public function index()
    {
        // Menghitung statistik sederhana untuk dashboard
        $totalPengajuan = Pengajuan::where('user_id', Auth::id())->count();
        $pengajuanPending = Pengajuan::where('user_id', Auth::id())->where('status', 'pending')->count();

        return view('karyawan.dashboard', compact('totalPengajuan', 'pengajuanPending'));
    }

    /**
     * Menampilkan daftar riwayat pengajuan milik karyawan
     */
    public function pengajuan_index()
    {
        // Mengambil data pengajuan beserta relasi barangnya dengan Eager Loading
        $pengajuans = Pengajuan::with('barang')
                        ->where('user_id', Auth::id())
                        ->latest()
                        ->get();

        return view('karyawan.pengajuan.index', compact('pengajuans'));
    }

    /**
     * Menampilkan form untuk membuat pengajuan baru
     */
    public function pengajuan_create()
    {
        // Mengambil barang yang stoknya masih tersedia untuk dipilih
        $barangs = Barang::where('stok', '>', 0)->get();
        return view('karyawan.pengajuan.create', compact('barangs'));
    }

    /**
     * Menyimpan data pengajuan ke database
     */
    public function pengajuan_store(Request $request)
    {
        // Validasi input dengan pesan kustom
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|numeric|min:1',
            'alasan' => 'required|string|max:255',
        ], [
            'barang_id.required' => 'Pilih barang terlebih dahulu.',
            'jumlah.min' => 'Jumlah minimal pengajuan adalah 1.',
            'alasan.required' => 'Alasan pengajuan wajib diisi.',
        ]);

        // Proses penyimpanan data
        Pengajuan::create([
            'user_id' => Auth::id(),
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'alasan' => $request->alasan,
            'status' => 'pending' // Status awal: Menunggu Verifikasi
        ]);

        return redirect()->route('karyawan.pengajuan.index')
                         ->with('success', 'Pengajuan berhasil dikirim dan menunggu verifikasi.');
    }

    /**
     * Menampilkan Laporan Inventaris (Hanya Lihat Stok)
     * Sesuai dengan Use Case: Lihat Laporan Inventaris
     */
    public function laporan_index()
    {
        // Mengambil semua data barang beserta kategorinya
        $barangs = Barang::with('category')->get();
        return view('karyawan.laporan.index', compact('barangs'));
    }
}
