<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // --- PASTIKAN BAGIAN INI ADA DI FILE ANDA ---
        $middleware->validateCsrfTokens(except: [
            // PASTIKAN INI SAMA PERSIS DENGAN URL POSTMAN ANDA
            '/api/login',
            '/logout',
            '/api/register',

            // Tambahkan semua rute POST, PUT, DELETE, PATCH yang Anda akses dari Postman
            // PASTIKAN URL-nya sama persis dan pakai wildcard (*) jika ada parameter dinamis
            '/admin/peminjaman/tambah-peminjaman/submit',
            '/admin/peminjaman/delete/*',
            '/admin/peminjaman/update/*',
            '/admin/daftar-referensi/tambah-peminjaman/submit',
            '/admin/ruangan/*',
            '/admin/daftar-referensi/update/ruangan/*',
            '/admin/daftar-referensi/fasilitas/submit',
            '/admin/daftar-referensi/fasilitas/delete/*',
            '/admin/daftar-referensi/fasilitas/update/*',
            
            '/superadmin/manajemen-users/tambah-user/submit',
            '/superadmin/manajemen-users/update-user/submit/*',
            '/superadmin/manajemen-users/users/toggle-status',
            '/superadmin/manajemen-users/delete/user/*',
            '/haa/*',
            '/ha*',

            '/kepala-upt/pengajuan-surat/*/terima',
            '/kepala-upt/pengajuan-surat/*/tolak',

            '/supkorla/daftar-pengajuan-surat/submit',
        ]);
        // --- AKHIR BAGIAN KRUSIAL ---

        $middleware->alias([
            'role' => \App\Http\Middleware\AuthMiddleware::class,
            // 'auth:sanctum' biasanya sudah terdaftar otomatis di Laravel 12
            // Anda tidak perlu menuliskannya di sini kecuali Anda membuat implementasi Sanctum kustom
        ]);

        // Bagian lain seperti $middleware->web() dan $middleware->api() biarkan default.
        // Konfigurasi CSRF melalui validateCsrfTokens() akan menimpa defaultnya.
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
