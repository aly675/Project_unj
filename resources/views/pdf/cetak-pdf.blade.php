<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Balasan - {{$data->asal_surat}}</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            position: relative;
        }

        header,
        footer,
        main {
            width: 80%;
            margin: 0 auto;
        }

        main {
            margin-bottom: 20px;
        }

        footer {
            text-align: right;
        }

        footer p {
            margin: 5px 0;
        }

        .logo-kiri {
            width: 120px;
            height: auto;
            position: absolute;
            top: 20px;
            left: 0px;
        }

        .watermark {
            position: fixed;
            top: 20%;
            left: 10%;
            width: 85%;
            opacity: 0.1;
            z-index: -1;
        }
    </style>
</head>
<body>

    <!-- Watermark -->
    <img src="{{ public_path('assets/images/final-logo-terbaru.png') }}" alt="Logo UNJ" class="watermark">

    <header style="display: flex; align-items: center; justify-content: center; position: relative; width: 100%;">
        <div style="text-align: center; margin: 0%;">
            <img src="{{ public_path('assets/images/final-logo-terbaru.png') }}" alt="Logo UNJ" class="logo-kiri">
            <h1>Universitas Negeri Jakarta</h1>
            <p>KEPALA PUSTIKOM</p>
            <p>Jalan R.Mangun Muka Raya No.11 RT.11 RW.14, Rawamangun <br> Kec.Pulogadung, Jakarta 13220</p>
        </div>
    </header>
    <hr>
    <main>
        <p style="text-align: right">Jakarta, 30 Juni 2025</p>
        <p>Kepada Mahasiswa/Peminjam,</p>
        <p>{{$data->nama_peminjam}}</p>
        <p><strong>Perihal:</strong> Konfirmasi Permohonan Penggunaan Ruang</p>
        <p>Dengan hormat,</p>
        <p>Kami mengucapkan terima kasih atas permohonan Anda untuk menggunakan ruang-ruang di PUSTIKOM. Setelah mempertimbangkan dengan seksama, kami ingin memberikan konfirmasi sebagai berikut:</p>
        <p>Detail Surat yang diajukan :</p>
        <ul>
            <li>Nomor Surat: {{$data->nomor_surat}}</li>
            <li>Asal Surat: {{$data->asal_surat}}</li>
            <li>Jumlah Ruang: {{$data->jumlah_ruangan}}</li>
            <li>Jumlah PC: {{$data->jumlah_pc}}</li>
        </ul>
        @if ($data->status === 'Diterima')
            <p>Surat Anda telah <strong>DITERIMA</strong>. Anda telah diberikan izin untuk menggunakan ruang-ruang di UPT TIK.</p>
            <p>Selanjutnya, berikut rincian tanggal yang telah disetujui untuk penggunaan:</p>
        @elseif ($data->status === 'Ditolak')
            <p>Surat Anda telah <strong>DITOLAK</strong>.</p>
            <p>Alasan penolakan: <strong>{{ $data->alesan ?? 'Tidak ada alasan yang diberikan.' }}</strong></p>
            <p>Selanjutnya, berikut rincian tanggal yang telah ditolak untuk penggunaan:</p>
        @endif
        <ul>
            <li>{{ $tanggalFormatted }}</li>
        </ul>
        <p>Demikianlah konfirmasi dari kami. Jika Anda memiliki pertanyaan lebih lanjut atau membutuhkan bantuan, jangan ragu untuk menghubungi kami melalui nomor kontak yang tertera di bawah.</p>
    </main>
    <footer>
        <p>Hormat kami,</p>
        <br><br><br><br>
        <p><strong>Kepala PUSTIKOM</strong></p>
        <p>Universitas Negeri Jakarta</p>
    </footer>
</body>
</html>
