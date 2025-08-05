<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        'alesan'
    ];

    // Otomatis konversi kolom JSON jadi array saat diakses
    protected $casts = [
        'tanggal_peminjaman' => 'array',
    ];

    public function verifikasiRuangans()
    {
        return $this->hasMany(VerifikasiRuangan::class, 'peminjamen_id');
    }

    public function formatTanggal()
    {
        $value = $this->attributes['tanggal_peminjaman'] ?? null;
        $dates = null;

        // Coba dekode. Loop ini untuk menangani kemungkinan double-encoding.
        while (is_string($value)) {
            $decoded = json_decode($value, true);
            // Jika tidak bisa di-dekode lagi, hentikan loop.
            if (json_last_error() !== JSON_ERROR_NONE) {
                break;
            }
            $value = $decoded;
        }

        $dates = $value;

        // Pengecekan terakhir: jika hasil akhirnya bukan array
        // (misal: string tanggal biasa atau null), tangani di sini.
        if (!is_array($dates)) {
            return !empty($dates)
                ? Carbon::parse($dates)->translatedFormat('d F Y')
                : '';
        }

        // Dari sini, kita yakin $dates adalah array yang bersih.
        // Logika lama kita sekarang aman.
        if (count($dates) === 0) {
            return '';
        }

        if (count($dates) === 1) {
            return Carbon::parse($dates[0])->translatedFormat('d F Y');
        }

        $tanggalAwal = Carbon::parse($dates[0])->translatedFormat('d F Y');
        $tanggalAkhir = Carbon::parse(end($dates))->translatedFormat('d F Y');

        return $tanggalAwal . ' - ' . $tanggalAkhir;
    }

}
