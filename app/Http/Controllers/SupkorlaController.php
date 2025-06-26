<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Fasilitas;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Models\VerifikasiRuangan;

class SupkorlaController extends Controller
{
    public function dashboard()
    {
        return view('supkorla.dashboard');
    }


        public function daftar_pengajuan_page()
        {
            $pengajuans = Peminjaman::where('status', 'Menunggu Verifikasi')->get();
            $ruangans = Ruangan::all();

            // Ambil semua ruangan yang sedang digunakan di tanggal mana pun
            $verifikasiList = VerifikasiRuangan::with('peminjaman')->get();

            // Mapping: [tanggal_string => [ruangan_id]]
            $ruanganDipakaiPerTanggal = [];

            foreach ($verifikasiList as $verif) {
                $tanggalArray = json_decode($verif->peminjaman->tanggal_peminjaman);
                foreach ($tanggalArray as $tgl) {
                    $ruanganDipakaiPerTanggal[$tgl][] = $verif->ruangan_id;
                }
            }

            return view('supkorla.daftar-pengajuan.daftar-pengajuan', compact('pengajuans', 'ruangans', 'ruanganDipakaiPerTanggal'));
        }

    public function daftar_ruangan_page()
    {
        $fasilitasList = Fasilitas::all();
        $ruangans = Ruangan::with('fasilitas')->get();

        return view('supkorla.daftar-ruangan.daftar-ruangan', compact('ruangans', 'fasilitasList'));
    }

    public function verifikasi(Request $request)
    {
        $request->validate([
            'peminjamen_id' => 'required|exists:peminjamen,id',
            'ruangan_id' => 'required|array',
            'ruangan_id.*' => 'exists:ruangans,id',
        ]);

        $peminjaman = Peminjaman::findOrFail($request->peminjamen_id);
        $tanggalPeminjaman = json_decode($peminjaman->tanggal_peminjaman, true);

        // Cek jika jumlah ruangan yang dipilih sesuai permintaan
        if (count($request->ruangan_id) !== (int)$peminjaman->jumlah_ruangan) {
            return back()->with('error', 'Jumlah ruangan yang dipilih tidak sesuai dengan permintaan!');
        }

        // Cek konflik ruangan pada tanggal yang sama
        foreach ($request->ruangan_id as $ruanganId) {
            foreach ($tanggalPeminjaman as $tanggal) {
                $adaKonflik = VerifikasiRuangan::where('ruangan_id', $ruanganId)
                    ->whereHas('peminjaman', function ($query) use ($tanggal) {
                        $query->whereJsonContains('tanggal_peminjaman', $tanggal);
                    })->exists();

                if ($adaKonflik) {
                    return back()->with('error', 'Ruangan ID ' . $ruanganId . ' sudah digunakan pada tanggal ' . $tanggal);
                }
            }
        }

        // Simpan verifikasi
        foreach ($request->ruangan_id as $ruanganId) {
            VerifikasiRuangan::create([
                'peminjamen_id' => $peminjaman->id,
                'ruangan_id' => $ruanganId,
            ]);
        }

        // Update status peminjaman ke "Diterima"
        $peminjaman->update(['status' => 'Diterima']);

        return back()->with('success', 'Verifikasi ruangan berhasil disimpan.');
    }



}
