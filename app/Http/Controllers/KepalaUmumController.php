<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Barang;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KepalaUmumController extends Controller
{
    public function dashboard_index()
    {
        if (!in_array(Auth::user()->role, ['kepala_umum', 'kepala-umum'])) {
            abort(403, 'Akses Ditolak! Anda bukan Kepala Umum.');
        }

        // Sesuaikan query dengan status yang ada: 'verifikasi' sebagai pengganti 'disetujui'
        $countPending  = Pengajuan::where('status', 'pending')->count();
        $countVerified = Pengajuan::where('status', 'verifikasi')->count(); // ubah dari 'disetujui'
        $countBarang   = Barang::count();
        $countDitolak  = Pengajuan::where('status', 'ditolak')->count();

        $semuaPengajuans = Pengajuan::with(['user', 'barang'])->latest()->get();
        $pendingPengajuans = Pengajuan::with(['user', 'barang'])->where('status', 'pending')->latest()->take(5)->get();
        $users = User::orderBy('created_at', 'desc')->get();

        return view('kepala_umum.dashboard', compact(
            'countPending', 'countVerified', 'countBarang', 'countDitolak',
            'pendingPengajuans', 'semuaPengajuans', 'users'
        ));
    }

    public function setujui($id)
    {
        // Cek pengajuan di tabel 'pengajuans'
        $pengajuan = DB::table('pengajuans')->where('id', $id)->first();
        if (!$pengajuan) {
            return back()->with('error', 'Pengajuan tidak ditemukan.');
        }
        if ($pengajuan->status !== 'pending') {
            return back()->with('error', 'Pengajuan sudah diproses sebelumnya.');
        }

        // Gunakan status 'verifikasi' (karena 'disetujui' tidak ada di ENUM)
        $affected = DB::update(
            "UPDATE pengajuans SET status = ?, updated_at = ? WHERE id = ?",
            ['verifikasi', now(), $id]
        );

        return $affected
            ? back()->with('success', 'Pengajuan berhasil diverifikasi.')
            : back()->with('error', 'Gagal mengupdate status.');
    }

    public function tolak($id)
    {
        $pengajuan = DB::table('pengajuans')->where('id', $id)->first();
        if (!$pengajuan) {
            return back()->with('error', 'Pengajuan tidak ditemukan.');
        }
        if ($pengajuan->status !== 'pending') {
            return back()->with('error', 'Pengajuan sudah diproses sebelumnya.');
        }

        $affected = DB::update(
            "UPDATE pengajuans SET status = ?, updated_at = ? WHERE id = ?",
            ['ditolak', now(), $id]
        );

        return $affected
            ? back()->with('success', 'Pengajuan berhasil ditolak.')
            : back()->with('error', 'Gagal mengupdate status.');
    }
}
