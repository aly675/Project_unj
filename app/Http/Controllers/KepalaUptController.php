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

    public function getSummary()
    {
        return response()->json([
            'total' => peminjaman::count(),
            'diterima' => peminjaman::where('status', 'Diterima')->count(),
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

}
