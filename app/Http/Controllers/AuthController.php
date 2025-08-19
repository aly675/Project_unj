<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tetap diperlukan untuk Auth::check() di middleware jika mau mixed
use Illuminate\Support\Facades\Hash; // Penting: Pastikan ini ada

class AuthController extends Controller
{
    // Perhatian: Fungsi ini masih mengembalikan view.
    // Jika Anda ingin semua jadi API, Anda perlu membuat endpoint API terpisah
    // untuk registrasi yang mengembalikan JSON (misalnya, public function apiRegister(Request $request){...})
    public function daftar(){
        return view('auth.register');
    }

    // Perhatian: Fungsi ini masih mengembalikan view.
    // Jika semua interaksi adalah API, endpoint ini mungkin tidak lagi relevan
    // atau harus diubah untuk melayani kebutuhan frontend SPA/Mobile.
    public function masuk(){
        return view("auth.login");
    }

    /**
     * Menangani permintaan login pengguna untuk API menggunakan Sanctum.
     * Fungsi ini TIDAK AKAN LAGI menangani login berbasis sesi atau redirect.
     * Ini akan selalu mengembalikan respons JSON.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // Validasi input email dan password
        $validate = $request->validate([
            'email' => 'required|email', // Tambahkan validasi 'email' untuk format yang benar
            'password' => 'required',
        ]);

        // Cari pengguna berdasarkan email
        $user = User::where('email', $validate['email'])->first();

        // Cek apakah pengguna ditemukan dan password cocok
        if (!$user || !Hash::check($validate['password'], $user->password)) {
            // Jika login gagal, kembalikan respons JSON dengan status 401 Unauthorized
            return response()->json([
                'message' => 'Login gagal, email atau password salah.'
            ], 401);
        }

        // Buat sesi login untuk pengguna
        Auth::login($user);

        // Opsi: Hapus semua token yang ada sebelumnya untuk pengguna ini.
        // Ini memastikan hanya ada satu token aktif per pengguna pada suatu waktu.
        // Jika Anda ingin user bisa login dari banyak perangkat, jangan gunakan baris ini.
        // $user->tokens()->delete();

        // Buat token baru untuk pengguna.
        // Nama token bisa disesuaikan (misal: 'aplikasi-saya-token').
        // 'abilities' (kemampuan) disematkan ke dalam token berdasarkan peran (role) pengguna.
        // Ini akan digunakan oleh middleware untuk otorisasi.
        $token = $user->createToken('auth-token', ['role:' . $user->role])->plainTextToken;

        // Mengembalikan respons JSON dengan data pengguna yang relevan dan token.
        // Frontend aplikasi Anda (SPA/Mobile) akan menggunakan 'role' dari respons ini
        // untuk mengarahkan pengguna ke dashboard yang sesuai.
        return response()->json([
            'message' => 'Login berhasil!',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role, // Penting: Peran pengguna dikirim kembali
            ],
            'token' => $token,
        ], 200); // Status HTTP 200 OK untuk keberhasilan
    }

    /**
     * Menangani logout pengguna untuk API dengan mencabut token Sanctum yang sedang digunakan.
     * Fungsi ini TIDAK AKAN LAGI membatalkan sesi atau membuat ulang token untuk aplikasi web berbasis sesi.
     * Ini akan selalu mengembalikan respons JSON.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        // Logout dari sesi web
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Jika pengguna juga terautentikasi via Sanctum (misal, dari API lain)
        // maka cabut juga token Sanctum-nya.
        if ($request->user() && $request->user()->currentAccessToken()) {
            $request->user()->currentAccessToken()->delete();
        }

        return response()->json(['message' => 'Logout berhasil.'], 200);
    }
}
