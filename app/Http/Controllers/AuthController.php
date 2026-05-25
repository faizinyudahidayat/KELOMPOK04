<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function login()
    {
        if (Auth::check()) {
            // Mengunci pengalihan ke rute yang pas jika user terlanjur login
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'karyawan') {
                return redirect()->route('karyawan.dashboard');
            } elseif ($user->role === 'kepala_umum') {
                return redirect()->route('kepala_umum.dashboard');
            } elseif ($user->role === 'keuangan') {
                return redirect()->route('keuangan.dashboard');
            }
        }
        return view('auth.login');
    }

    /**
     * Proses autentikasi user
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // SOLUSI UTAMA: Menggunakan redirect()->route() agar tidak terjebak memori 'intended' rute sebelumnya
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Selamat datang kembali, Admin!');
            } elseif ($user->role === 'karyawan') {
                return redirect()->route('karyawan.dashboard')
                    ->with('success', 'Selamat datang kembali!');
            } elseif ($user->role === 'kepala_umum') {
                return redirect()->route('kepala_umum.dashboard')
                    ->with('success', 'Selamat datang Kepala Umum!');
            } elseif ($user->role === 'keuangan') {
                return redirect()->route('keuangan.dashboard')
                    ->with('success', 'Selamat datang Keuangan!');
            }

            // Jalur alternatif jika role tidak dikenali sistem
            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * TAMPILKAN HALAMAN LUPA PASSWORD
     */
    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    /**
     * PROSES KIRIM LINK RESET (Sekaligus Redirect ke Form Reset)
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Masukkan email Anda.',
            'email.email' => 'Format email tidak valid.',
            'email.exists' => 'Email tidak terdaftar dalam sistem.'
        ]);

        // Buat token simulasi sederhana
        $token = bin2hex(random_bytes(20));

        // LANGSUNG ARAHKAN ke halaman input password baru agar user tidak bingung
        return redirect()->route('password.reset', ['token' => $token])
            ->with([
                'success' => 'Email terverifikasi. Silakan masukkan password baru Anda.',
                'email' => $request->email // Mengirim email ke halaman berikutnya agar user tidak perlu ngetik ulang
            ]);
    }

    /**
     * 1. TAMPILKAN FORM INPUT PASSWORD BARU
     */
    public function resetPasswordForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    /**
     * 2. PROSES UPDATE PASSWORD KE DATABASE
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ], [
            'email.exists' => 'Email tidak ditemukan.',
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.'
        ]);

        // Cari user berdasarkan email dan update passwordnya
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Setelah berhasil, lempar kembali ke LOGIN
        return redirect()->route('login')->with('success', 'Password berhasil diubah. Silakan login dengan password baru.');
    }

    /**
     * Proses logout user (Metode GET aman dan stabil)
     */
    public function logout(Request $request)
    {
        // Proses pembatalan autentikasi user
        Auth::logout();

        // Menghancurkan session lama agar token csrf tidak bentrok di perangkat seluler/laptop
        $request->session()->invalidate();

        // Memperbarui token session untuk mencegah token fiksasi (session fixation)
        $request->session()->regenerateToken();

        // Mengarahkan kembali ke route bernama 'login' secara konsisten
        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar.');
    }
}
