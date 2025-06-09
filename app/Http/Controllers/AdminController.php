<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard_page()
    {
        return view('admin.dashboard');
    }

     public function daftar_referensi_page()
    {
        return view('admin.daftar-referensi.daftar-referensi');
    }

    public function peminjaman_page()
    {
        return view('admin.peminjaman.peminjaman');
    }

    public function tambah_peminjaman_page()
    {
        return view('admin.peminjaman.tambah-peminjaman');
    }

    public function detail_peminjaman_page()
    {
        return view('admin.peminjaman.detail-peminjaman');
    }
    public function update_peminjaman_page()
    {
        return view('admin.peminjaman.update-peminjaman');
    }

    public function tambah_ruangan_page()
    {
        return view('admin.daftar-referensi.tambah-ruangan');
    }

    public function update_ruangan_page()
    {
        return view('admin.daftar-referensi.update-ruangan');
    }

}
