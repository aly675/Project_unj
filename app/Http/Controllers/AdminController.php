<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Ruangan;
use App\Models\Fasilitas;
use App\Models\peminjaman;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard_page()
    {
        $ruangan = Ruangan::count();
        return view('admin.dashboard', compact("ruangan"));
    }

    public function peminjaman_page()
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
        return view('admin.peminjaman.peminjaman', compact('peminjamans'));
    }

    public function peminjaman_json(Request $request)
    {
        $perPage = $request->get('perPage', 10); // default 10
        $page = $request->get('page', 1);
        $search = $request->get('search', '');
        $status = $request->get('status', '');

        $query = peminjaman::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nomor_surat', 'like', "%$search%")
                ->orWhere('asal_surat', 'like', "%$search%")
                ->orWhere('nama_peminjam', 'like', "%$search%");
            });
        }

        if ($status && $status != 'Status : All') {
            $query->where('status', $status);
        }

        $query->orderBy('created_at', 'desc');

        $paginator = $query->paginate($perPage, ['*'], 'page', $page);
        $peminjamans = $paginator->items();

        Carbon::setLocale('id');
            foreach ($peminjamans as $p) {
                $decoded = json_decode($p->tanggal_peminjaman, true) ?? [];
                $formatted = collect($decoded)->map(function ($tgl) {
                    return Carbon::parse($tgl)->translatedFormat('l, d F Y');
                });
                $p->tanggal_formatted = $formatted;
                $p->lama_hari = count($decoded);
                $p->lampiran_url = $p->lampiran ? asset('storage/' . $p->lampiran) : null;
            }

        return response()->json([
            'status' => 'success',
            'data' => $peminjamans,
            'current_page' => $paginator->currentPage(),
            'last_page' => $paginator->lastPage(),
            'per_page' => $paginator->perPage(),
            'total' => $paginator->total(),
        ]);
    }


    public function cetak($id)
    {
        $data = peminjaman::findOrFail($id);
        return view('pdf/cetak-pdf', compact('data'));
    }

    public function delete_peminjaman($id)
    {
        try {
            $peminjaman = Peminjaman::findOrFail($id);
            $peminjaman->delete();

            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data'], 500);
        }
    }

    public function update_peminjaman(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $request->validate([
            'nomor_surat' => 'required|string|max:255|unique:peminjamen,nomor_surat,' . $peminjaman->id,
            'asal_surat' => 'required|string|max:255',
            'nama_peminjam' => 'required|string|max:255',
            'jumlah_hari' => 'required|integer|min:1',
            'tanggal_peminjaman' => 'required|array|min:1',
            'tanggal_peminjaman.*' => 'required|date',
            'jumlah_ruangan' => 'nullable|integer|min:0',
            'jumlah_pc' => 'nullable|integer|min:0',
            'lampiran' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        try {
            // Update field dasar
            $peminjaman->nomor_surat = $request->nomor_surat;
            $peminjaman->asal_surat = $request->asal_surat;
            $peminjaman->nama_peminjam = $request->nama_peminjam;
            $peminjaman->jumlah_hari = $request->jumlah_hari;
            $peminjaman->jumlah_ruangan = $request->jumlah_ruangan;
            $peminjaman->jumlah_pc = $request->jumlah_pc;

            // Simpan tanggal sebagai JSON
            $peminjaman->tanggal_peminjaman = json_encode($request->tanggal_peminjaman);

            // Handle file upload
            if ($request->hasFile('lampiran')) {
                if ($peminjaman->lampiran && Storage::disk('public')->exists($peminjaman->lampiran)) {
                    Storage::disk('public')->delete($peminjaman->lampiran);
                }
                $path = $request->file('lampiran')->store('lampiran-peminjaman', 'public');
                $peminjaman->lampiran = $path;
            }

            $peminjaman->save();

            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Peminjaman berhasil diperbarui.'
                ]);
            }

            return redirect()->route('admin.peminjaman-page')
                ->with('success', 'Peminjaman berhasil diperbarui.');

        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }


    public function tambah_peminjaman_page()
    {
        return view('admin.peminjaman.tambah-peminjaman');
    }

    public function buatSurat(Request $request)
    {
        $validated = $request->validate([
            'nomor-surat' => 'required|string|max:255|unique:peminjamen,nomor_surat',
            'asal-surat' => 'required|string|max:255',
            'nama-peminjam' => 'required|string|max:255',
            'jumlah-hari' => 'required|integer|min:1',
            'jumlah-ruangan' => 'nullable|integer|min:0',
            'jumlah-pc' => 'nullable|integer|min:0',
            'lampiran' => 'nullable|file|mimes:pdf|max:2048', // max dalam KB
            'tanggal_peminjaman' => 'required|array|min:1',
            'tanggal_peminjaman.*' => 'required|date',
        ]);

        $tanggalPeminjaman = [];
        for ($i = 1; $i <= $request->input('jumlah-hari'); $i++) {
            $tanggalKey = "tanggal-hari-$i";
            if ($request->has($tanggalKey)) {
                $tanggalPeminjaman[] = $request->input($tanggalKey);
            }
        }

        // Simpan file
        $lampiranPath = null;
        if ($request->hasFile('lampiran')) {
            $lampiranPath = $request->file('lampiran')->store('lampiran-peminjaman', 'public');
        }

        // Simpan ke database
        $peminjaman = new peminjaman();
        $peminjaman->nomor_surat = $request->input('nomor-surat');
        $peminjaman->asal_surat = $request->input('asal-surat');
        $peminjaman->nama_peminjam = $request->input('nama-peminjam');
        $peminjaman->jumlah_hari = $request->input('jumlah-hari');
        $tanggalPeminjaman = $request->input('tanggal_peminjaman'); // array otomatis
        $peminjaman->tanggal_peminjaman = json_encode($tanggalPeminjaman);
        $peminjaman->jumlah_ruangan = $request->input('jumlah-ruangan');
        $peminjaman->jumlah_pc = $request->input('jumlah-pc');
        $peminjaman->lampiran = $lampiranPath;
        $peminjaman->save();

        return redirect()->route('admin.peminjaman-page')->with('tambahPeminjamanSuccess', 'Data peminjaman berhasil disimpan.');
    }


            // Daftar Referensi//


    //Daftar Ruangan

    public function daftar_referensi_page()
    {
        $listFasilitas = Fasilitas::all();
        $ruangans = Ruangan::with('fasilitas')->get();
        return view('admin.daftar-referensi.daftar-referensi', compact("ruangans", "listFasilitas"));
    }

    public function ruangan_json(Request $request)
    {
        $query = Ruangan::with(['fasilitas' => function ($q) {
            $q->select('fasilitas.id', 'nama');
        }]);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                ->orWhere('nomor', 'like', "%{$search}%");
            });
        }

        $ruangans = $query->latest()->get();

        $data = $ruangans->map(function ($ruangan) {
            return [
                'id' => $ruangan->id,
                'nama' => $ruangan->nama,
                'nomor' => $ruangan->nomor,
                'kapasitas' => $ruangan->kapasitas,
                'gambar' => $ruangan->gambar ? asset('storage/' . $ruangan->gambar) : asset('/placeholder.svg'),
                'fasilitas' => $ruangan->fasilitas->map(function ($fasilitas) {
                    return [
                        'id' => $fasilitas->id,
                        'nama' => $fasilitas->nama,
                        'jumlah' => $fasilitas->pivot->jumlah ?? 1,
                    ];
                }),
            ];
        });

        return response()->json($data);
    }

    public function tambah_ruangan_page()
    {
        $fasilitas = Fasilitas::all();
        return view('admin.daftar-referensi.tambah-ruangan', compact('fasilitas'));
    }

    public function tambahRuangan(Request $request)
    {
        $request->validate([
            'nomor_ruangan' => 'required|unique:ruangans,nomor',
            'nama_ruangan'  => 'required',
            'kapasitas'     => 'required|integer|min:1',
            'gambar_ruangan'=> 'required|image|max:2048',
            'fasilitas'     => 'required|array',
            'jumlah'        => 'required|array',
        ]);
        $gambar = null;

        if ($request->hasFile('gambar_ruangan')) {
            $gambar = $request->file('gambar_ruangan')->store('ruangan', 'public');
        }

        $ruangan = Ruangan::create([
            'nomor'    => $request->nomor_ruangan,
            'nama'     => $request->nama_ruangan,
            'kapasitas'=> $request->kapasitas,
            'gambar'   => $gambar,
        ]);

        // Attach fasilitas beserta jumlah ke pivot
        foreach ($request->fasilitas as $i => $id_fasilitas) {
            $ruangan->fasilitas()->attach($id_fasilitas, [
                'jumlah' => $request->jumlah[$i] ?? 1,
            ]);
        }

        return redirect()->route('admin.daftar-referensi-page')->with('successTambahRuangan', 'Ruangan berhasil ditambahkan!');
    }

    public function updateRuangan(Request $request, $id)
    {
        $request->validate([
            'nomor_ruangan'   => 'required|unique:ruangans,nomor,' . $id,
            'nama_ruangan'    => 'required',
            'kapasitas'       => 'required|integer|min:1',
            'gambar_ruangan'  => 'nullable|image|max:2048',
            'fasilitas'       => 'required|array',
            'jumlah'          => 'required|array',
        ]);

        $ruangan = Ruangan::findOrFail($id);

        // Proses gambar baru jika ada
        if ($request->hasFile('gambar_ruangan')) {
            // Hapus gambar lama jika ada
            if ($ruangan->gambar) {
                Storage::disk('public')->delete($ruangan->gambar);
            }

            $ruangan->gambar = $request->file('gambar_ruangan')->store('ruangan', 'public');
        }

        // Update data ruangan
        $ruangan->update([
            'nomor'     => $request->nomor_ruangan,
            'nama'      => $request->nama_ruangan,
            'kapasitas' => $request->kapasitas,
            'gambar'    => $ruangan->gambar, // gambar bisa sudah diubah di atas
        ]);

        // Sinkronisasi fasilitas dan jumlah
        $pivotData = [];
        foreach ($request->fasilitas as $i => $id_fasilitas) {
            $pivotData[$id_fasilitas] = ['jumlah' => $request->jumlah[$i] ?? 1];
        }

        $ruangan->fasilitas()->sync($pivotData);

        return response()->json([
            'message' => 'Ruangan berhasil diperbarui.',
            'data' => $ruangan->load('fasilitas'),
        ]);
    }

    public function destroy($id)
    {
        Ruangan::findOrFail($id)->delete();
        return response()->json(['messageDeleteSuccess' => 'Ruangan berhasil dihapus.']);
    }


    //Daftar Fasilitas

    public function daftar_fasilitas_page()
    {
        $fasilitasList = Fasilitas::all();
        return view('admin.daftar-referensi.daftar-fasilitas' ,compact('fasilitasList'));
    }

    public function fasilitas_json(Request $request )
    {
        $query = $request->get('search', '');
        $sort = $request->get('sort', 'asc');

        $fasilitas = Fasilitas::query()
            ->when($query, fn($q) => $q->where('nama', 'like', "%{$query}%"))
            ->orderBy('nama', $sort)
            ->get(['id', 'nama']); // ambil kolom yang diperlukan saja

        return response()->json($fasilitas);
    }

    public function submit_fasilitas(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $fasilitas = Fasilitas::create([
            'nama' => $request->nama,
        ]);

        return response()->json([
            'message' => 'Fasilitas berhasil ditambahkan.',
            'data' => $fasilitas,
        ]);
    }

    public function delete_fasilitas($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        $fasilitas->delete();

        return response()->json([
            'message' => 'Fasilitas berhasil dihapus.'
        ]);
    }

    public function update_fasilitas(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Cari data fasilitas yang akan diupdate
        $fasilitas = Fasilitas::findOrFail($id);

        // Update data
        $fasilitas->nama = $request->nama;
        $fasilitas->save();

        // Redirect atau response
        // return redirect()->route('admin.daftar-fasilitas-page')->with('success', 'Fasilitas berhasil diupdate');
        return response()->json([
            'message' => 'Fasilitas berhasil diperbarui.',
            'data' => $fasilitas
        ]);
    }

}
