<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->string('asal_surat');
            $table->string('nama_peminjam');
            $table->integer('jumlah_hari');
            $table->json('tanggal_peminjaman');
            $table->integer('jumlah_ruangan')->nullable();
            $table->integer('jumlah_pc')->nullable();
            $table->string('lampiran')->nullable();
            $table->enum("status", ["Menunggu Persetujuan", "Menunggu Verifikasi", "Diterima", "Ditolak"])->default("Menunggu Persetujuan");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
