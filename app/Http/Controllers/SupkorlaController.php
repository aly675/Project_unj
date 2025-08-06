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

    public function getSummary()
    {
        return response()->json([
            'total' => peminjaman::count(),
            'diterima' => peminjaman::where('status', 'Diterima')->count(),
            'menungguPersetujuan' => peminjaman::where('status', 'Menunggu Persetujuan')->count(),
            'menungguVerifikasi' => peminjaman::where('status', 'Menunggu Verifikasi')->count(),
        ]);
    }

    public function getDataSupkorlaDashboard(Request $request)
    {
        $query = Peminjaman::query();
        $status = $request->input('status', 'all');
        $sort = $request->input('sort', 'newest');
        // Search
        if ($request->has('search') && $request->search !== '') {
            $query->where(function ($q) use ($request) {
                $q->where('nomor_surat', 'like', '%' . $request->search . '%')
                ->orWhere('jumlah_hari', 'like', '%' . $request->search . '%');
            });
        }

        // Filter status
        if ($request->has('status') && $request->status !== 'all') {
            if ($request->status === 'sudah diverifikasi') {
                $query->where('status', 'Diterima');
            } else {
                $query->where('status', $request->status);
            }
        }

        // Sort
        switch ($request->sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'a-z':
                $query->orderBy('nomor_surat', 'asc');
                break;
            case 'z-a':
                $query->orderBy('nomor_surat', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc'); // fallback
                break;
        }


        // Pagination
        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);
        $data = $query->paginate($perPage, ['*'], 'page', $page);

        // Transform data
        $formatted = $data->getCollection()->map(function ($item) {
            return [
                'nama_peminjam' => $item->nama_peminjam,
                'tanggal_peminjaman' => $item->tanggal_peminjaman,
                'nomor_surat' => $item->nomor_surat,
                'lama_peminjaman' => $item->jumlah_hari . ' hari', // dari kolom jumlah_hari
                'jumlah_ruangan' => $item->jumlah_ruangan !== null ? (int) $item->jumlah_ruangan : 0,
                'status' => $item->status === 'Diterima' ? 'sudah diverifikasi' : $item->status,
            ];
        });

        if ($formatted->isEmpty()) {
            return response()->json([
                'data' => [],
                'message' => 'Tidak ada data ditemukan',
                'meta' => [
                    'total' => 0,
                    'per_page' => $perPage,
                    'current_page' => $page,
                    'last_page' => 1,
                    'from' => null,
                    'to' => null,
                ]
            ]);
        }

        return response()->json([
            'data' => $formatted,
            'meta' => [
                'total' => $data->total(),
                'per_page' => $data->perPage(),
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'from' => $data->firstItem(),
                'to' => $data->lastItem(),
            ]
        ]);
    }


    public function daftar_pengajuan_page()
    {
        $pengajuans = Peminjaman::where('status', 'Menunggu Verifikasi')->get();
        $ruangans = Ruangan::with('fasilitas')->get();
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
