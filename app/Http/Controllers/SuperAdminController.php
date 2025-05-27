<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function dashboard()
    {
        $users = User::all(); // Menampilkan semua user ke dashboard
        return view('superadmin.dashboard', compact('users'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            "email" => "required|email|unique:users,email",
            "name" => "required|unique:users,name",
            "password" => "required|confirmed|min:6",
            "role" => "required"
        ]);

        $user = new User();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->status = $request->status ?? 'aktif';
        $user->save(); // <-- Jangan lupa save!

        return redirect()->back()->with("success", "Data Berhasil Ditambahkan");
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('superadmin.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "nullable|confirmed|min:6",
            "role" => "required",
            "status" => "required"
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->role = $request->role;
        $user->status = $request->status;
        $user->save();

        return redirect()->route('superadmin.dashboard')->with("success", "Data berhasil diupdate");
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with("success", "Data berhasil dihapus");
    }
}
