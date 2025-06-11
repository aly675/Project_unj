<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Fasilitas.php
class Fasilitas extends Model
{
    protected $fillable = ['nama'];

    public function ruangans()
    {
        return $this->belongsToMany(Ruangan::class, 'fasilitas_ruangan')
                    ->withPivot('jumlah')
                    ->withTimestamps();
    }
}
