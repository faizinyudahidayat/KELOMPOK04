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

            // Role tidak dikenali, arahkan ke halaman utama
            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Tampilkan halaman lupa password
     */
    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    /**
     * Proses kirim link reset (langsung arahkan ke form reset)
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

        $token = bin2hex(random_bytes(20));

        return redirect()->route('password.reset', ['token' => $token])
            ->with([
                'success' => 'Email terverifikasi. Silakan masukkan password baru Anda.',
                'email' => $request->email
            ]);
    }

    /**
     * Form input password baru
     */
    public function resetPasswordForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    /**
     * Proses update password baru ke database
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

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('success', 'Password berhasil diubah. Silakan login dengan password baru.');
    }

    /**
     * Proses logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar.');
    }
}
