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
    public function register(Request $request){
        $validate = $request->validate([
            "name" =>"required|unique:users,name",
            "password" => "required|confirmed|min:6",
            "role" => "required"
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;

        return redirect()->back()->with("succes", "Data Berhasil Ditambahkan");
    }
public function login(Request $request)
{
    $validate = $request->validate([
        'name' => 'required',
        'password' => 'required',
    ]);

    if (Auth::attempt($validate)) {
        $request->session()->regenerate();
        $name = Auth::user()->name;

        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', "Selamat Datang $name");
        }

        if (Auth::user()->role === 'superadmin') {
            return redirect()->route('superadmin.dashboard')->with('success', "Selamat Datang $name");
        }

        if (Auth::user()->role === 'kepalaupt') {
            return redirect()->route('kepalaupt.dashboard')->with('success', "Selamat Datang $name");
        }

        if (Auth::user()->role === 'supkorla') {
            return redirect()->route('supkorla.dashboard')->with('success', "Selamat Datang $name");
        }

        // fallback kalau role tidak cocok
        return redirect('/')->with('error', 'Role tidak dikenali');
    }

    return back()->withErrors([
        'name' => 'Login gagal, cek username dan password.',
    ])->onlyInput('name');
}

}
