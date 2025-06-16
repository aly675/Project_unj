<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    $ruangan = Ruangan::findOrFail($id);

    // Validasi
    $request->validate([
        'nomor_ruangan' => 'required',
        'nama_ruangan' => 'required',
        'kapasitas' => 'required|integer|min:1',
        'fasilitas' => 'required|array',
        'jumlah' => 'required|array',
    ]);

    // Gambar baru (jika ada)
    if ($request->hasFile('gambar_ruangan')) {
        if ($ruangan->gambar) {
            Storage::disk('public')->delete($ruangan->gambar);
        }
        $ruangan->gambar = $request->file('gambar_ruangan')->store('ruangan', 'public');
    }

    $ruangan->update([
        'nomor' => $request->nomor_ruangan,
        'nama' => $request->nama_ruangan,
        'kapasitas' => $request->kapasitas,
        'gambar' => $ruangan->gambar,
    ]);

    // Update fasilitas
    $pivotData = [];
    foreach ($request->fasilitas as $i => $id_fasilitas) {
        $pivotData[$id_fasilitas] = ['jumlah' => $request->jumlah[$i] ?? 1];
    }
    $ruangan->fasilitas()->sync($pivotData);

    return response()->json([
        'message' => 'Ruangan berhasil diperbarui.',
        'data' => $ruangan->load('fasilitas')
    ]);
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
