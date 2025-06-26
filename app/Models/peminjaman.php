<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamen'; // karena nama tabel bukan jamak default

    protected $fillable = [
        'nomor_surat',
        'asal_surat',
        'nama_peminjam',
        'jumlah_hari',
        'tanggal_peminjaman',
        'jumlah_ruangan',
        'jumlah_pc',
        'lampiran',
        'status', // jika kamu nanti tambah status seperti Pending / Approved
    ];

    // Otomatis konversi kolom JSON jadi array saat diakses
    protected $casts = [
        'tanggal_peminjaman' => 'array',
    ];

    public function verifikasiRuangans()
{
    return $this->hasMany(VerifikasiRuangan::class, 'peminjamen_id');
}

}
