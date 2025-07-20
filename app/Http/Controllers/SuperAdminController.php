<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function dashboard()
    {
        $users = User::all();
        $totalUsers = $users->count();
        $activeUsers = $users->where('status', 'aktif')->count();
        $nonActiveUsers = $users->where('status', 'non-aktif')->count();
        return view('superadmin.dashboard', compact('users', 'totalUsers', 'activeUsers', 'nonActiveUsers'));
    }

    // Jika ingin API JSON untuk fetch tanpa reload (ajax) nanti:
    public function stats_json()
    {
        $data = [
            'totalRoles' => 4,
            'totalUsers' => User::count(),
            'activeUsers' => User::where('status', 'aktif')->count(),
            'nonActiveUsers' => User::where('status', 'non-aktif')->count(),
        ];

        return response()->json($data);
    }

    public function latestUsersJson(Request $request)
    {
        $query = User::query();

        // Search filter
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->orWhere('role', 'like', "%$search%");
            });
        }

        // Sort filter
        if ($request->has('sortBy') && $request->sortBy != '') {
            $sortBy = $request->sortBy;
            switch ($sortBy) {
                case 'oldest':
                    $query->oldest();
                    break;
                case 'newest':
                    $query->latest();
                    break;
                case 'a-z':
                    $query->orderBy('name', 'asc');
                    break;
                case 'z-a':
                    $query->orderBy('name', 'desc');
                    break;
                case 'aktif':
                    $query->where('status', 'aktif');
                    break;
                case 'non-aktif':
                    $query->where('status', 'non-aktif');
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }

        // Pagination
        $perPage = $request->perPage ?? 5;
        $users = $query->paginate($perPage);

        // Kirimkan JSON response dengan structure rapi
        return response()->json([
            'data' => $users->items(),
            'current_page' => $users->currentPage(),
            'last_page' => $users->lastPage(),
            'per_page' => $users->perPage(),
            'total' => $users->total(),
            'from' => $users->firstItem(),
            'to' => $users->lastItem(),
        ]);
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


    public function show($id)
    {
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
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['success' => true]);
    }

    public function manejemen_users_page()
    {
        $users = User::all(); // Menampilkan semua user ke dashboard
        $userCount = $users->count();
        return view('superadmin.manajemen-users.manejemen-users', compact('users', 'userCount'));
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

    public function users_json(Request $request)
    {
        $query = User::query();

        // Search filter
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('role', 'like', "%$search%");
            });
        }

        // Sort handling
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'a-z':
                    $query->orderBy('name', 'asc');
                    break;
                case 'z-a':
                    $query->orderBy('name', 'desc');
                    break;
                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest();
        }

        $perPage = $request->perPage ?? 10;
        $users = $query->paginate($perPage);

        return response()->json($users);
    }



}
