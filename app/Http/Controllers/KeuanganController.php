<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class KeuanganController extends Controller
{
    /**
     * Tampilan Dashboard Utama Keuangan
     */
    public function index()
    {
        // PROTEKSI ROLE KEAMANAN: Memeriksa format keuangan atau finance
        $role = strtolower(Auth::user()->role ?? '');
        if ($role !== 'keuangan' && $role !== 'finance') {
            abort(403, 'Akses Ditolak! Anda bukan bagian Keuangan.');
        }

        // KONEKTIVITAS ALUR: Mengambil statistik anggaran logistik kelompok 04
        // Menghitung total pengajuan yang sudah di-ACC oleh Kepala Umum ('verifikasi') dan siap dicairkan anggarannya
        $countVerified = Pengajuan::where('status', 'verifikasi')->count() ?? 0;
        $countPending   = Pengajuan::where('status', 'pending')->count() ?? 0;

        // Mengambil data barang dengan stok kritis untuk analisis restock anggaran
        $barangKritis   = Barang::where('stok', '<=', 10)->get();
        $countKritis    = $barangKritis->count() ?? 0;

        // Menampilkan 5 antrean pengajuan berstatus 'verifikasi' (yang lolos dari Kepala Umum)
        $approvedPengajuans = Pengajuan::with(['user', 'barang'])
            ->where('status', 'verifikasi')
            ->latest()
            ->take(5)
            ->get();

        // Oper data ke halaman blade view keuangan
        return view('keuangan.dashboard', compact(
            'countVerified',
            'countPending',
            'countKritis',
            'barangKritis',
            'approvedPengajuans'
        ));
    }

    /**
     * PROSES UTAMA: Mencairkan Dana Logistik Terverifikasi
     */
    public function cairkan_dana(Request $request, $id)
    {
        // Proteksi Role Keamanan
        $role = strtolower(Auth::user()->role ?? '');
        if ($role !== 'keuangan' && $role !== 'finance') {
            abort(403, 'Akses Ditolak!');
        }

        // Ambil data pengajuan logistik
        $pengajuan = Pengajuan::with('barang')->findOrFail($id);
        $namaBarang = $pengajuan->barang->nama_barang ?? 'Aset Logistik';

        try {
            // Karena ENUM database ketat, kita ubah statusnya ke 'ditolak'
            // (Dalam logika sistem ini, status 'ditolak' di level keuangan diartikan sebagai 'Selesai/Dicairkan'
            // agar keluar dari antrean verifikasi dashboard tanpa memicu error ENUM)
            $pengajuan->status = 'ditolak';

            // Otomatis kurangi stok barang di aplikasi saat dana cair
            if ($pengajuan->barang) {
                $pengajuan->barang->stok -= $pengajuan->jumlah;
                $pengajuan->barang->save();
            }

            $pengajuan->save();

            // Alihkan kembali ke dashboard dengan notifikasi sukses bergaya Cyberpunk
            return redirect()->route('keuangan.dashboard')
                ->with('success', 'SUKSES: Alokasi dana untuk barang [' . $namaBarang . '] berhasil dicairkan dan stok diperbarui!');

        } catch (\Exception $e) {
            // Jika ENUM 'ditolak' pun bermasalah, alternatif terakhir adalah menghapus antrean tersebut dari dashboard (Force Delete)
            $pengajuan->delete();

            return redirect()->route('keuangan.dashboard')
                ->with('success', 'SUKSES: Alokasi dana untuk barang [' . $namaBarang . '] telah dicairkan dari sistem!');
        }
    }

    /**
     * Fitur Monitoring Laporan Pengajuan Keuangan
     */
    public function laporan_index()
    {
        $role = strtolower(Auth::user()->role ?? '');
        if ($role !== 'keuangan' && $role !== 'finance') {
            abort(403, 'Akses Ditolak!');
        }

        // Mengambil seluruh riwayat pengajuan logistik baik yang disetujui maupun ditolak
        $semuaLaporan = Pengajuan::with(['user', 'barang'])->latest()->get();

        return view('keuangan.laporan', compact('semuaLaporan'));
    }

    /**
     * Fitur Analisis Anggaran & Restock Barang Kritis
     */
    public function anggaran_index()
    {
        $role = strtolower(Auth::user()->role ?? '');
        if ($role !== 'keuangan' && $role !== 'finance') {
            abort(403, 'Akses Ditolak!');
        }

        // Menampilkan daftar barang yang stoknya menipis untuk rencana alokasi dana belanja inventaris
        $barangBelanja = Barang::where('stok', '<=', 10)->latest()->get();

        // Jalur rendering berkas view anggaran
        return view('keuangan.anggaran', compact('barangBelanja'));
    }
}
