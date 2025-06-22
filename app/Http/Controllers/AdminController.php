<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Fasilitas;
use App\Models\peminjaman;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard_page()
    {
        $ruangan = Ruangan::count();
        return view('admin.dashboard', compact("ruangan"));
    }

     public function daftar_referensi_page()
    {
        $listFasilitas = Fasilitas::all();
        $ruangans = Ruangan::with('fasilitas')->get();
        return view('admin.daftar-referensi.daftar-referensi', compact("ruangans", "listFasilitas"));
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

    public function deletePinjamanRuangan($id)
    {
        $ruangan = peminjaman::findOrFail($id);
        $ruangan->delete();
        return redirect()->route("admin.peminjaman-page");
    }

    public function update_peminjaman(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $request->validate([
            'nomor_surat' => 'required|string|max:255|unique:peminjamen,nomor_surat,'.$peminjaman->id.'',
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
            $peminjaman = Peminjaman::findOrFail($id);
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
                // Hapus file lama jika ada
                if ($peminjaman->lampiran && Storage::disk('public')->exists($peminjaman->lampiran)) {
                    Storage::disk('public')->delete($peminjaman->lampiran);
                }

                $path = $request->file('lampiran')->store('lampiran-peminjaman', 'public');
                $peminjaman->lampiran = $path;
            }

            $peminjaman->save();

            return redirect()->route('admin.peminjaman-page')
                            ->with('success', 'Peminjaman berhasil diperbarui.');

        } catch (\Exception $e) {
            return redirect()->back()
                            ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                            ->withInput();
        }
    }



    public function tambah_peminjaman_page()
    {
        return view('admin.peminjaman.tambah-peminjaman');
    }

    public function detail_peminjaman_page()
    {
        return view('admin.peminjaman.detail-peminjaman');
    }
    public function update_peminjaman_page()
    {
        return view('admin.peminjaman.update-peminjaman');
    }

    public function tambah_ruangan_page()
    {
        $fasilitas = Fasilitas::all();
        return view('admin.daftar-referensi.tambah-ruangan', compact('fasilitas'));
    }

    public function update_ruangan_page()
    {
        $fasilitas = Fasilitas::all();
        return view('admin.daftar-referensi.update-ruangan', compact('fasilitas'));
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

        return redirect()->route('admin.daftar-referensi-page')->with('success', 'Ruangan berhasil ditambahkan!');
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
        return redirect()->route('admin.daftar-referensi-page')->with('success','Ruangan berhasil dihapus.');
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

        return redirect()->route('admin.tambah-peminjaman-page')->with('success', 'Data peminjaman berhasil disimpan.');
    }

    public function daftar_fasilitas_page()
    {
        $fasilitasList = Fasilitas::all();
        return view('admin.daftar-referensi.daftar-fasilitas' ,compact('fasilitasList'));
    }

    public function submit_fasilitas(Request $request)
    {
        $validated = $request->validate(['nama' => 'required']);

        Fasilitas::create(['nama' => $validated['nama']]);

        return redirect()->route('admin.daftar-fasilitas-page')->with('success', 'Fasilitas Berhasil Ditambahkan');
    }

    public function delete_fasilitas($id)
    {
        Fasilitas::findOrfail($id)->delete();
        return redirect()->route('admin.daftar-fasilitas-page')->with('deleteSuccess', 'Berhasil Menghapues Fasilitas');
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
        return redirect()->route('admin.daftar-fasilitas-page')->with('success', 'Fasilitas berhasil diupdate');
    }

}
