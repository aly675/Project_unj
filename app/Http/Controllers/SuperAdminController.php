<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function dashboard()
    {
        $users = User::all(); // Menampilkan semua user ke dashboard
        $totalUsers = $users->count();
        $activeUsers = $users->where('status', 'aktif')->count();
        $nonActiveUsers = $users->where('status', 'non-aktif')->count();
        return view('superadmin.dashboard', compact('users', 'totalUsers', 'activeUsers', 'nonActiveUsers'));
    }

public function store(Request $request)
{
    $validate = $request->validate([
        "email" => "required|email|unique:users,email",
        "name" => "required|unique:users,name",
        "password" => "required|min:6",
        "role" => "required",
        "image" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048"
    ]);

    $user = new User();
    $user->email = $request->email;
    $user->name = $request->name;
    $user->password = bcrypt($request->password);
    $user->role = $request->role;
    $user->status = $request->status ?? 'aktif';

    // Simpan gambar ke storage/app/public/users
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('users', 'public'); // folder 'users' di dalam 'storage/app/public'
        $user->image = $imagePath; // simpan path relatif seperti 'users/namafile.jpg'
    }

    $user->save();

    return redirect()->route("superadmin.manejemen-users-page")->with("success", "Data Berhasil Ditambahkan");
}


    public function show($id){
        $data = User::findOrFail($id);

        return response()->json($data);
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('superadmin.edit', compact('user'));
    }

        public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validate = $request->validate([
            "email" => "required|email|unique:users,email," . $id,
            "name" => "required",
            "password" => "nullable|min:6",
            "role" => "required",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048"
        ]);

        $user->email = $request->email;
        $user->name = $request->name;
        $user->role = $request->role;
        $user->status = $request->status ?? 'aktif';

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('users', 'public');
            $user->image = $imagePath;
        }

        $user->save();

        return response()->json(['message' => 'Berhasil diupdate']);
    }


    public function destroy($id)
    {
        // $user = User::findOrFail($id);
        // $user->delete();

        // return redirect()->back()->with("success", "Data berhasil dihapus");

        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['success' => true]);
    }

    public function manejemen_users_page()
    {
        $users = User::all(); // Menampilkan semua user ke dashboard
        return view('superadmin.manajemen-users.manejemen-users', compact('users'));
    }

    public function tambah_user_page()
    {
        return view('superadmin.manajemen-users.tambah-user');
    }

    public function toggleStatus(Request $request)
    {
        $user = User::findOrFail($request->id);

        // Toggle status dari enum
        $user->status = $user->status === 'aktif' ? 'non-aktif' : 'aktif';
        $user->save();

        return response()->json([
            'success' => true,
            'status' => $user->status === 'aktif' ? 'ON' : 'OFF',
            'class'  => $user->status === 'aktif' ? 'text-teal-custom' : 'text-red-500'
        ]);
    }

}
