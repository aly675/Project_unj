<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\VerifikasiRuangan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class KepalaUptController extends Controller
{

    /*
        Halaman Dashboard Kepala UPT
    **/

    public function dashboard()
    {
        return view('kepalaUpt.dashboard');
    }

    public function getSummary()
    {
        return response()->json([
            'total' => peminjaman::count(),
            'diterima' => peminjaman::whereIn('status', ['Diterima', 'Menunggu Verifikasi'])->count(),
            'ditolak' => peminjaman::where('status', 'Ditolak')->count(),
            'menunggu' => peminjaman::where('status', 'Menunggu Persetujuan')->count(),
        ]);
    }

    public function getSuratList(Request $request)
    {
        $query = peminjaman::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nomor_surat', 'like', "%$search%")
                    ->orWhere('nama_peminjam', 'like', "%$search%")
                    ->orWhere('asal_surat', 'like', "%$search%");
            });
        }

        // Filter status
        if ($request->filled('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        // Sort
        switch ($request->sort_by) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'a-z':
                $query->orderBy('nama_peminjam', 'asc');
                break;
            case 'z-a':
                $query->orderBy('nama_peminjam', 'desc');
                break;
            default: // newest
                $query->orderBy('created_at', 'desc');
                break;
        }

        // Pagination
        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);
        $data = $query->paginate($perPage, ['*'], 'page', $page);

        // Convert string json ke array
        $data->getCollection()->transform(function ($item) {
            $item->tanggal_peminjaman = json_decode($item->tanggal_peminjaman, true);
            return $item;
        });

        return response()->json($data);
    }


    /*
        Halaman Peminjaman Kepala UPT
    **/

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

    public function terima($id)
    {
        $pengajuan = Peminjaman::findOrFail($id);
        $pengajuan->status = 'Menunggu Verifikasi';
        $pengajuan->save();

        return response()->json(['success' => true, 'message' => 'Pengajuan disetujui.']);
    }

    public function tolak(Request $request, $id)
    {
        $request->validate([
        'alasan' => 'required|string|max:255',
    ]);

        $pengajuan = Peminjaman::findOrFail($id);
        $pengajuan->status = 'Ditolak';
        $pengajuan->alesan = $request->alasan;
        $pengajuan->save();

        return response()->json(['success' => true, 'message' => 'Pengajuan ditolak.']);
    }


/**
 *
 * Halamana Kalender
 *
 */

    public function kalender_page()
    {
        return view('kepalaUpt.kalender.kalender');
    }

    public function data_ketersedian_ruangan(Request $request)
    {
        // 1. Ambil semua peminjaman yang statusnya "Diterima".
        $peminjamanDiterima = Peminjaman::where('status', 'Diterima')
                                ->with('verifikasiRuangans.ruangan')
                                ->get();

        // 2. Siapkan array kosong untuk menampung event kalender.
        $events = [];

        // 3. Lakukan perulangan untuk setiap peminjaman yang diterima.
        foreach ($peminjamanDiterima as $peminjaman) {
            // --- PERBAIKAN DI SINI ---
            // Secara manual ubah string JSON menjadi array untuk mencegah error.
            $tanggalData = $peminjaman->tanggal_peminjaman;
            $daftarTanggal = is_string($tanggalData) ? json_decode($tanggalData, true) : $tanggalData;

            // Pastikan hasilnya adalah array, jika tidak, buat array kosong.
            if (!is_array($daftarTanggal)) {
                $daftarTanggal = [];
            }
            // --- AKHIR PERBAIKAN ---

            // Lakukan perulangan untuk setiap ruangan yang diverifikasi dalam peminjaman ini.
            foreach ($peminjaman->verifikasiRuangans as $verifikasi) {
                if ($verifikasi->ruangan) {
                    $namaRuangan = $verifikasi->ruangan->nama;

                    // Lakukan perulangan untuk setiap tanggal, lalu buat event-nya.
                    foreach ($daftarTanggal as $tanggal) {
                        $events[] = [
                            'title' => $namaRuangan, // Judul event adalah nama ruangan
                            'start' => $tanggal,      // Tanggal event
                            'allDay' => true,         // Anggap event ini seharian penuh
                            'className' => 'badge-terbatas' // Class CSS untuk styling
                        ];
                    }
                }
            }
        }

        // 4. Kembalikan hasilnya sebagai JSON.
        return response()->json($events);
    }
}
