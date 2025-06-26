<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifikasiRuangan extends Model
{
    use HasFactory;

    protected $table = 'verifikasi_ruangans';

    protected $fillable = [
        'ruangan_id',
        'peminjamen_id',
    ];

    /**
     * Relasi ke model Ruangan
     */
public function peminjaman()
{
    return $this->belongsTo(Peminjaman::class, 'peminjamen_id');
}



        public function ruangan()
        {
            return $this->belongsTo(Ruangan::class, 'ruangan_id');
        }

}
