<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Peminjaman;
use Faker\Factory as Faker;

class PeminjamanSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $statuses = ['Menunggu Persetujuan', 'Menunggu Verifikasi', 'Diterima', 'Ditolak'];

        for ($i = 1; $i <= 250; $i++) {
            $nomorSurat = str_pad($i, 4, '0', STR_PAD_LEFT) . '/UNJ/PUSTIKOM/2025';
            $tanggal = now()->setYear(2026)->subDays(rand(1, 60))->format('Y-m-d');

            Peminjaman::create([
                'nomor_surat' => $nomorSurat,
                'asal_surat' => $faker->company(),
                'nama_peminjam' => $faker->name(),
                'jumlah_hari' => rand(1, 5),
                'tanggal_peminjaman' => json_encode([$tanggal]),
                'jumlah_ruangan' => rand(1, 3),
                'jumlah_pc' => rand(5, 25),
                'lampiran' => 'dummy.pdf',
                'status' => $statuses[array_rand($statuses)],
            ]);
        }
    }
}
