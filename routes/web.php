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


Route::middleware(['guest'])->group(function(){

    Route::get("/login", [AuthController::class, "masuk"])->name("login");
    Route::get("/register", [AuthController::class, "daftar"])->name("register");
    Route::post("/login/submit", [AuthController::class, "login"])->name("login.submit");
    Route::post("/register/submit", [AuthController::class, "register"])->name("register.submit");
});


Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get("/", [AdminController::class, "dashboard"])->name("admin.dashboard");
});

Route::prefix('superadmin')->middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get("/", [SuperAdminController::class, "dashboard"])->name("superadmin.dashboard");
});

Route::prefix('kepalaupt')->middleware( ['auth', 'role:kepalaupt'])->group(function () {
    Route::get("/", [KepalaUptController::class, "dashboard"])->name("kepalaupt.dashboard");
});

Route::prefix( 'supkorla')->middleware(['auth', 'role:supkorla'])->group(function () {
    Route::get("/", [SupkorlaController::class, "dashboard"])->name("supkorla.dashboard");
});

Route::get('/token', function() {
    return csrf_token();
});


Route::resource("/ha", SuperAdminController::class);

Route::post("/haa/{id}", [SuperAdminController::class, 'update']);
