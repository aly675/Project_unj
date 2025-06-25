<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class SupkorlaController extends Controller
{
    public function dashboard()
    {
        return view('supkorla.dashboard');
    }

    public function daftar_pengajuan_page()
    {
        return view('supkorla.daftar-pengajuan.daftar-pengajuan');
    }

    public function daftar_ruangan_page()
    {
        $fasilitasList = Fasilitas::all();
        $ruangans = Ruangan::with('fasilitas')->get();

        return view('supkorla.daftar-ruangan.daftar-ruangan', compact('ruangans', 'fasilitasList'));
    }



}
