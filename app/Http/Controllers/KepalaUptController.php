<?php

namespace App\Http\Controllers;

use App\Models\peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;

class KepalaUptController extends Controller
{
    public function dashboard()
    {
        return view('kepalaUpt.dashboard');
    }

    public function pengajuan_surat_page()
    {
         $peminjamans = peminjaman::all();
        // Format tanggal JSON ke "Senin, 01 Januari 2025"
        Carbon::setLocale('id');
        foreach ($peminjamans as $p) {
            $decoded = json_decode($p->tanggal_peminjaman, true) ?? [];
            // Format tanggal untuk ditampilkan
            $formatted = collect($decoded)->map(function ($tgl) {
                return Carbon::parse($tgl)->translatedFormat('l, d F Y');
            });
            $p->tanggal_formatted = $formatted;
            $p->lama_hari = count($decoded);
            // Tambahkan URL lampiran (untuk JavaScript di blade)
            $p->lampiran_url = $p->lampiran ? asset('storage/' . $p->lampiran) : null;
        }
        return view('kepalaUpt.pengajuan-surat.pengajuan-surat', compact("peminjamans"));
    }

    public function kalender_page()
    {
        return view('kepalaUpt.kalender.kalender');
    }

    public function terima($id)
        {
            $pengajuan = Peminjaman::findOrFail($id);
            $pengajuan->status = 'Menunggu Verifikasi';
            $pengajuan->save();

            return response()->json(['success' => true, 'message' => 'Pengajuan disetujui.']);
        }

    public function tolak($id)
        {
            $pengajuan = Peminjaman::findOrFail($id);
            $pengajuan->status = 'Ditolak';
            $pengajuan->save();

            return response()->json(['success' => true, 'message' => 'Pengajuan ditolak.']);
        }

    
}
