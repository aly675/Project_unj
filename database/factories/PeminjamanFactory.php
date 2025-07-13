<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Peminjaman;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Peminjaman>
 */
class PeminjamanFactory extends Factory
{
    public function definition(): array
    {
        $statuses = ['Menunggu Persetujuan', 'Menunggu Verifikasi', 'Diterima', 'Ditolak'];
        $tanggal = [
            now()->setYear(2026)->subDays(rand(1, 10))->format('Y-m-d'),
            now()->setYear(2026)->subDays(rand(11, 20))->format('Y-m-d'),
            now()->setYear(2026)->subDays(rand(21, 30))->format('Y-m-d'),
        ];

        // Hitung jumlah Peminjaman untuk nomor surat auto increment
        $count = Peminjaman::count() + 1;
        $nomorSurat = str_pad($count, 4, '0', STR_PAD_LEFT) . '/UNJ/PUSTIKOM/2025';

        return [
            'nomor_surat' => $nomorSurat,
            'asal_surat' => $this->faker->company(),
            'nama_peminjam' => $this->faker->name(),
            'jumlah_hari' => rand(1, 5),
            'tanggal_peminjaman' => json_encode([$tanggal[array_rand($tanggal)]]),
            'jumlah_ruangan' => rand(1, 3),
            'jumlah_pc' => rand(5, 25),
            'lampiran' => 'dummy.pdf',
            'status' => $statuses[array_rand($statuses)],
        ];
    }
}
