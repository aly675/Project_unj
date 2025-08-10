<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\VerifikasiRuangan;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    // public function data_ruangan_json(Request $request)
    // {
    //      // 1. Ambil semua data ruangan beserta fasilitasnya (Eager Loading)
    //     $semuaRuangan = Ruangan::with('fasilitas')->get();

    //     $dataPeminjaman = VerifikasiRuangan::with('peminjaman', 'ruangan')->get();

    //     // 2. Transformasi ke Array Bersih untuk ditampilkan
    //     $data = $semuaRuangan->map(function ($ruangan) {
    //         return [
    //             'id' => $ruangan->id,
    //             'nomor' => $ruangan->nomor,
    //             'nama' => $ruangan->nama,
    //             'kapasitas' => $ruangan->kapasitas,
    //             'gambar' => $ruangan->gambar,
    //             // Kita transformasikan juga data fasilitas agar bersih
    //             'fasilitas' => $ruangan->fasilitas->map(function ($fasilitas) {
    //                 return [
    //                     'nama' => $fasilitas->nama,
    //                     'jumlah' => $fasilitas->pivot->jumlah,
    //                 ];
    //             }),
    //         ];
    //     });

    //     // 3. Kembalikan hasilnya dalam format JSON
    //     return response()->json([
    //         'message' => 'Data ruangan berhasil diambil',
    //         'data' => $data,
    //     ]);
    // }

    public function data_ruangan_json(Request $request)
    {
        // Validasi input
        $request->validate([
            'tanggal' => 'sometimes|date_format:Y-m-d',
            'search' => 'nullable|string|max:100',
        ]);

        // Ambil input atau gunakan default tanggal hari ini
        $tanggalCek = $request->input('tanggal', Carbon::now()->format('Y-m-d'));
        $searchTerm = $request->input('search');

        // --- PERUBAHAN LOGIKA QUERY DIMULAI DI SINI ---

        // 3a. Cari dulu ID dari semua peminjaman yang Diterima pada tanggal tersebut.
        $peminjamanDiterimaIds = Peminjaman::where(DB::raw('TRIM(status)'), 'Diterima')
            ->where('tanggal_peminjaman', 'like', '%'.$tanggalCek.'%')
            ->pluck('id');

        // dd($peminjamanDiterimaIds);

        // 3b. Gunakan ID peminjaman di atas untuk mencari ruangan mana saja yang terpakai.
        $ruanganTerpakaiIds = VerifikasiRuangan::whereIn('peminjamen_id', $peminjamanDiterimaIds)
            ->pluck('ruangan_id')
            ->unique();

        // --- AKHIR PERUBAHAN LOGIKA QUERY ---

        // Query utama dengan filter pencarian
        $semuaRuangan = Ruangan::with('fasilitas')
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where('nama', 'like', "%{$searchTerm}%");
            })
            ->get();

        // Transformasi data menjadi array bersih
        $data = $semuaRuangan->map(function ($ruangan) use ($ruanganTerpakaiIds) {
            $isTerpakai = $ruanganTerpakaiIds->contains($ruangan->id);
            return [
                'id' => $ruangan->id,
                'nomor' => $ruangan->nomor,
                'nama' => $ruangan->nama,
                'kapasitas' => $ruangan->kapasitas,
                'gambar' => $ruangan->gambar,
                'status_ketersediaan' => $isTerpakai ? 'Sedang Dipakai' : 'Tersedia',
                'fasilitas' => $ruangan->fasilitas->map(function ($fasilitas) {
                    return [
                        'nama' => $fasilitas->nama,
                        'jumlah' => $fasilitas->pivot->jumlah,
                    ];
                }),
            ];
        });

        // Kembalikan hasil JSON
        return response()->json([
            'message' => 'Data ketersediaan ruangan berhasil diambil',
            'data' => $data,
        ]);
    }
}
