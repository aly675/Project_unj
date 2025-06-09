<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($validate)) {
            $request->session()->regenerate();
            $name = Auth::user()->name;

            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard-page')->with('success', "Selamat Datang $name");
            }

            if (Auth::user()->role === 'superadmin') {
                return redirect()->route('superadmin.dashboard-page')->with('success', "Selamat Datang $name");
            }

            if (Auth::user()->role === 'kepalaupt') {
                return redirect()->route('kepalaupt.dashboard')->with('success', "Selamat Datang $name");
            }

            if (Auth::user()->role === 'supkorla') {
                return redirect()->route('supkorla.dashboard')->with('success', "Selamat Datang $name");
            }

            // fallback kalau role tidak cocok
            return redirect('/')->with('error', 'username not found');
        }

        return back()->withErrors([
            'name' => 'Login gagal, cek username dan password.',
        ])->onlyInput('name');
    }

   public function logout(Request $request)
    {
        // Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

}
