<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KepalaUptController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\SupkorlaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::fallback(function () {
    return view('errors.404'); // pakai view kamu sendiri
})->middleware(['web', 'auth']); // ini penting!


Route::middleware(['guest'])->group(function(){

    Route::get("/login", [AuthController::class, "masuk"])->name("login");
    Route::get("/register", [AuthController::class, "daftar"])->name("register");
    Route::post("/login/submit", [AuthController::class, "login"])->name("login.submit");
    Route::post("/register/submit", [AuthController::class, "register"])->name("register.submit");
});


Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get("/", [AdminController::class, "dashboard_page"])->name("admin.dashboard-page");

    Route::prefix('/peminjaman')->group( function(){
        Route::get("", [AdminController::class, "peminjaman_page"])->name(name: "admin.peminjaman-page");
        Route::get("/tambah-peminjaman", [AdminController::class, "tambah_peminjaman_page"])->name("admin.tambah-peminjaman-page");
        Route::post("/tambah-peminjaman/submit", [AdminController::class, "buatSurat"])->name("admin.tambah-peminjaman");
        Route::get("/detail-peminjaman", [AdminController::class, "detail_peminjaman_page"])->name("admin.detail-peminjaman-page");
        Route::get("/update-peminjaman", [AdminController::class, "update_peminjaman_page"])->name("admin.update-peminjaman-page");


    });

    Route::prefix('daftar-referensi')->group( function(){
        Route::get("", [AdminController::class, "daftar_referensi_page"])->name("admin.daftar-referensi-page");
        Route::get("/tambah-ruangan", [AdminController::class, "tambah_ruangan_page"])->name("admin.tambah-ruangan-page");
        Route::post("/tambah-peminjaman/submit", [AdminController::class, "tambahRuangan"])->name("tambah.ruangan");
        Route::delete('/admin/ruangan/{id}', [AdminController::class, 'destroy'])->name('admin.delete-ruangan');
        Route::post("/update/ruangan/{id}", [AdminController::class, 'updateRuangan'])->name("admin.update-submit");
    });
});

Route::prefix('superadmin')->middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get("/", [SuperAdminController::class, "dashboard"])->name("superadmin.dashboard-page");
    Route::prefix('/manajemen-users')->group( function() {
        Route::get('', [SuperAdminController::class, 'manejemen_users_page'])->name('superadmin.manejemen-users-page');
        Route::get('/tambah-user', [SuperAdminController::class, 'tambah_user_page'])->name('superadmin.tambah-user-page');
        Route::post("/tambah-user/submit", [SuperAdminController::class,"store"])->name("superadmin.user-submit");
        Route::post('/update-user/submit/{id}', [SuperAdminController::class, 'update'])->name('superadmin.update-submit');
        Route::post('/users/toggle-status', [SuperAdminController::class, 'toggleStatus'])->name('superadmin.toggle-status');
        Route::delete('delete/user/{id}', [SuperAdminController::class, 'destroy'])->name('superadmin.delete-user');
    });
});

Route::prefix('kepala-upt')->middleware( ['auth', 'role:kepalaupt'])->group(function () {
    Route::get("/", [KepalaUptController::class, "dashboard"])->name("kepalaupt.dashboard-page");
    Route::prefix('pengajuan-surat')->group( function(){
        Route::get('', [KepalaUptController::class, 'pengajuan_surat_page'])->name('kepalaupt.pengajuan-surat-page');
    });
    Route::prefix('kalender')->group( function(){
        Route::get('', [KepalaUptController::class, 'kalender_page'])->name('kepalaupt.kalender');
    });
});

Route::prefix( 'supkorla')->middleware(['auth', 'role:supkorla'])->group(function () {
    Route::get("/", [SupkorlaController::class, "dashboard"])->name("supkorla.dashboard-page");
});

Route::get('/token', function() {
    return csrf_token();
});

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::resource("/ha", SuperAdminController::class);

Route::post("/haa/{id}", [SuperAdminController::class, 'update']);
