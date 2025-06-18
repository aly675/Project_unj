<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KepalaUptController extends Controller
{
    public function dashboard()
    {
        return view('kepalaUpt.dashboard');
    }

    public function pengajuan_surat_page()
    {
        return view('kepalaUpt.pengajuan-surat.pengajuan-surat');
    }

    public function kalender_page()
    {
        return view('kepalaUpt.kalender.kalender');
    }
}
