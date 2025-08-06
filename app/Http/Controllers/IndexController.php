<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use App\Models\VerifikasiRuangan;

class IndexController extends Controller
{
    public function data_ruangan_json(Request $request)
    {
         // 1. Ambil semua data ruangan beserta fasilitasnya (Eager Loading)
        $semuaRuangan = Ruangan::with('fasilitas')->get();

        // 2. Transformasi ke Array Bersih untuk ditampilkan
        $data = $semuaRuangan->map(function ($ruangan) {
            return [
                'id' => $ruangan->id,
                'nomor' => $ruangan->nomor,
                'nama' => $ruangan->nama,
                'kapasitas' => $ruangan->kapasitas,
                'gambar' => $ruangan->gambar,
                // Kita transformasikan juga data fasilitas agar bersih
                'fasilitas' => $ruangan->fasilitas->map(function ($fasilitas) {
                    return [
                        'nama' => $fasilitas->nama,
                        'jumlah' => $fasilitas->pivot->jumlah,
                    ];
                }),
            ];
        });

        // 3. Kembalikan hasilnya dalam format JSON
        return response()->json([
            'message' => 'Data ruangan berhasil diambil',
            'data' => $data,
        ]);
    }
}
