<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard_page()
    {
        return view('admin.dashboard');
    }

     public function daftar_referensi_page()
    {
        $ruangans = Ruangan::with('fasilitas')->get();
        return view('admin.daftar-referensi.daftar-referensi', compact("ruangans"));
    }

    public function peminjaman_page()
    {
        return view('admin.peminjaman.peminjaman');
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

    public function destroy($id)
            {
                Ruangan::findOrFail($id)->delete();
                return redirect()->route('admin.daftar-referensi-page')->with('success','Ruangan berhasil dihapus.');
            }



}
