<?php

// database/seeders/FasilitasSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fasilitas;

class FasilitasSeeder extends Seeder
{
    public function run()
    {
        $fasilitas = ['AC', 'Proyektor', 'PC', 'Kursi', 'Meja', 'Whiteboard'];
        foreach ($fasilitas as $nama) {
            Fasilitas::create(['nama' => $nama]);
        }
    }
}

