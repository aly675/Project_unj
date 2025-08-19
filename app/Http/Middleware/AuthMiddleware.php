<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        $roles = explode('|', $role); // Pisahkan peran jika multiple (ex: 'admin|superadmin')

        $user = $request->user(); // Dapatkan user yang terautentikasi (bisa dari sesi atau token)

        // Periksa apakah ada user terautentikasi (baik via sesi atau token)
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated.'], 401); // 401 Unauthorized
        }

        // Jika user terautentikasi via token Sanctum
        if ($user->currentAccessToken()) {
            foreach ($roles as $r) {
                // Periksa apakah token memiliki kemampuan 'role:namarole'
                if ($user->tokenCan('role:' . $r)) {
                    return $next($request); // Lanjutkan jika token memiliki kemampuan yang cocok
                }
            }
        }
        // Jika user terautentikasi via sesi (misalnya, untuk rute yang masih diakses browser)
        // Perhatian: Dengan "sanctum semua", jalur sesi ini mungkin tidak akan terpakai lagi
        // untuk rute yang dilindungi auth:sanctum. Namun, tetap dipertahankan untuk kompatibilitas.
        else if (Auth::check()) {
            if (in_array(Auth::user()->role, $roles)) {
                return $next($request); // Lanjutkan jika user sesi memiliki peran yang cocok
            }
        }

        // Jika user terautentikasi tetapi tidak memiliki peran yang sesuai (atau token tidak punya abilities)
        return response()->json(['message' => 'Anda tidak memiliki hak akses yang diperlukan.'], 403); // 403 Forbidden
    }
}
