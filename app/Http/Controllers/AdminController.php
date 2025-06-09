<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard_page(){
        return view('admin.dashboard');
    }

     public function daftar_referensi_page()
     {
        return view('admin.daftar-referensi.daftar-referensi');
    }

     public function peminjaman_page(){
        return view('admin.peminjaman.peminjaman');
    }


}
