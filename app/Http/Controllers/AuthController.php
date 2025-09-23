<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tetap diperlukan untuk Auth::check() di middleware jika mau mixed
use Illuminate\Support\Facades\Hash; // Penting: Pastikan ini ada

class AuthController extends Controller
{

    public function daftar(){
        return view('auth.register');
    }


    public function masuk(){
        return view("auth.login");
    }


    public function login(Request $request)
    {

        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        $user= User::where('email', $validate['email'])->first();


        if (!$user || !Hash::check($validate['password'], $user->password)) {

            return response()->json([
                'message' => 'Login gagal, email atau password salah.'
            ], 401);
        }


        Auth::login($user);


        $token = $user->createToken('auth-token', ['role:' . $user->role])->plainTextToken;

        return response()->json([
            'message' => 'Login Succes',
            'user' => $user,
            'token' => $token,
        ], 200);
    }


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
