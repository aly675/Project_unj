<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Ruangan.php
class Ruangan extends Model
{

    protected $table = 'ruangans';

    protected $fillable = ['nomor', 'nama', 'kapasitas', 'gambar'];

    public function fasilitas()
    {
        return $this->belongsToMany(Fasilitas::class, 'fasilitas_ruangan')
                    ->withPivot('jumlah')
                    ->withTimestamps();
    }
}
