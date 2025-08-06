@extends('layouts.supkorla-layout')

@section('title', 'Daftar Pengajuan Surat')
@section('page', 'Daftar Pengajuan Surat')

@section('style')
<style>
    .scroll-hide::-webkit-scrollbar { display: none; }
    .scroll-hide { -ms-overflow-style: none; scrollbar-width: none; }

    .scrollbar-modern { scrollbar-width: thin; scrollbar-color: #94a3b8 #f1f5f9; }
    .scrollbar-modern::-webkit-scrollbar { width: 6px; }
    .scrollbar-modern::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 100px; }
    .scrollbar-modern::-webkit-scrollbar-thumb {
        background-color: #94a3b8;
        border-radius: 100px;
        border: 2px solid transparent;
        background-clip: content-box;
    }
</style>
@endsection

@section('main')
<h1 class="text-3xl font-bold mb-6 text-[#004B50]">Pengajuan Masuk - Supkorla</h1>

<div class="bg-white rounded-2xl shadow-lg ring-1 ring-black/5 p-6">
    <table class="w-full table-auto text-sm">
        <thead class="bg-[#F5F7FA] text-[#004B50]">
            <tr>
                <th class="p-3 text-left">Nomor Surat</th>
                <th class="p-3 text-left">Nama</th>
                <th class="p-3 text-left">Tanggal</th>
                <th class="p-3 text-left">Status</th>
                <th class="p-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach ($pengajuans as $pengajuan)
                @php
                    $statusClasses = [
                        'Menunggu Verifikasi' => 'bg-yellow-100 text-yellow-700',
                        'Ditolak' => 'bg-red-100 text-red-700',
                        'Sudah Diverifikasi' => 'bg-green-100 text-green-700',
                    ];
                    $badgeClass = $statusClasses[$pengajuan->status] ?? 'bg-gray-100 text-gray-700';
                @endphp
                <tr class="hover:bg-gray-50">
                    <td class="p-3">{{ $pengajuan->nomor_surat }}</td>
                    <td class="p-3">{{ $pengajuan->nama_peminjam }}</td>
                    <td class="p-3">{{ \Carbon\Carbon::parse($pengajuan->tanggal)->translatedFormat('d F Y') }}</td>
                    <td class="p-3">
                        <span class="{{ $badgeClass }} px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">
                            {{ $pengajuan->status }}
                        </span>
                    </td>
                    <td class="p-3 text-center">
                        @php
                            $tanggalArray = json_decode($pengajuan->tanggal_peminjaman, true);
                            $tanggalMulai = \Carbon\Carbon::parse($tanggalArray[0])->translatedFormat('d F Y');
                            $tanggalAkhir = \Carbon\Carbon::parse(end($tanggalArray))->translatedFormat('d F Y');
                        @endphp
                        <button
                            onclick="openModalVerifikasi(this)"
                            data-id="{{ $pengajuan->id }}"
                            data-nomor="{{ $pengajuan->nomor_surat }}"
                            data-nama="{{ $pengajuan->nama_peminjam }}"
                            data-tanggal='@json(json_decode($pengajuan->tanggal_peminjaman))'
                            data-tanggal-teks="{{ $tanggalMulai === $tanggalAkhir ? $tanggalMulai : $tanggalMulai . ' - ' . $tanggalAkhir }}"
                           data-lama="{{ count(json_decode($pengajuan->tanggal_peminjaman, true)) }} Hari"
                            data-jumlah-ruangan="{{ $pengajuan->jumlah_ruangan }}"
                            data-jumlah-pc="{{ $pengajuan->jumlah_pc }}"
                            class="bg-[#007D6E] hover:bg-[#00685D] text-white px-4 py-1 rounded-md text-sm shadow-sm"
                        >
                            Verifikasi
                        </button>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@include('supkorla.daftar-pengajuan.verifikasi-pengajuan')

@endsection

@section('js')
<script>
    const ruangans = @json($ruangans);
    const ruanganDipakaiPerTanggal = @json($ruanganDipakaiPerTanggal);
    const modalOverlayVerifikasi = document.getElementById('modalOverlayVerifikasi');
    console.log(ruangans);

    let maxTerpilih = 1;

    document.addEventListener("change", function () {
        const selected = document.querySelectorAll("input[name='ruangan_id[]']:checked");
        if (selected.length > maxTerpilih) {
            alert("Maksimal pilih " + maxTerpilih + " ruangan.");
            selected[selected.length - 1].checked = false;
        }
    });

function openModalVerifikasi(button) {
    const peminjamenId = button.getAttribute('data-id');
    const nomorSurat = button.getAttribute('data-nomor');
    const namaPeminjam = button.getAttribute('data-nama');
    const tanggalText = button.getAttribute('data-tanggal-teks');
    const lama = button.getAttribute('data-lama');
    const jumlahRuangan = parseInt(button.getAttribute('data-jumlah-ruangan'));
    const jumlahPC = button.getAttribute('data-jumlah-pc');
    const tanggalPeminjaman = JSON.parse(button.getAttribute('data-tanggal'));

    maxTerpilih = jumlahRuangan;
    document.getElementById('peminjamen_id_input').value = peminjamenId;

    // ISI DATA DINAMIS DI MODAL
    document.querySelector("#modalOverlayVerifikasi .grid").innerHTML = `
        <div><strong>Nomor Surat:</strong> ${nomorSurat}</div>
        <div><strong>Nama Peminjam:</strong> ${namaPeminjam}</div>
        <div><strong>Tanggal Peminjaman:</strong> ${tanggalText}</div>
        <div><strong>Lama Peminjaman:</strong> ${lama}</div>
        <div><strong>Jumlah Ruang Dipinjam:</strong> ${jumlahRuangan} Ruangan</div>
        <div><strong>Jumlah PC Dipinjam:</strong> ${jumlahPC} PC</div>
    `;

    // MODAL ANIMASI
    const modal = modalOverlayVerifikasi.querySelector('.bg-white');
    modalOverlayVerifikasi.classList.remove('opacity-0', 'invisible');
    modalOverlayVerifikasi.classList.add('opacity-100', 'visible');
    setTimeout(() => {
        modal.classList.remove('scale-75', '-translate-y-12');
        modal.classList.add('scale-100', 'translate-y-0');
    }, 10);
    document.body.style.overflow = 'hidden';

    // RUANGAN
    const container = document.getElementById("ruangan-list");
    container.innerHTML = '';
    const ruanganTerpakai = new Set();

    tanggalPeminjaman.forEach(tgl => {
        if (ruanganDipakaiPerTanggal[tgl]) {
            ruanganDipakaiPerTanggal[tgl].forEach(id => ruanganTerpakai.add(id));
        }
    });

    ruangans.forEach((r) => {
        const sedangDipakai = ruanganTerpakai.has(r.id);
        const label = document.createElement("label");
        label.className = "relative flex flex-col justify-between border rounded-xl p-5 bg-white shadow-sm transition-all " +
            (!sedangDipakai ? "cursor-pointer hover:shadow-md hover:border-[#007D6E]" : "opacity-60 cursor-not-allowed bg-gray-100");

        const checkbox = document.createElement("input");
           // --- TAMBAHKAN LOGIKA INI ---
        // 1. Cari fasilitas dengan nama "PC" di dalam ruangan 'r'
        const fasilitasPC = r.fasilitas.find(f => f.nama === 'PC');

        // 2. Ambil jumlahnya. Jika tidak ada fasilitas PC, anggap jumlahnya 0.
        const jumlah_pc = fasilitasPC ? fasilitasPC.pivot.jumlah : 0;

        checkbox.type = "checkbox";
        checkbox.name = "ruangan_id[]";
        checkbox.value = r.id;
        checkbox.disabled = sedangDipakai;
        checkbox.className = "mt-1";

        label.innerHTML = `
            <div class="flex items-start gap-4">
                <div class="mt-1"></div>
                <div class="flex-1">
                    <h3 class="text-base font-semibold mb-2 ${!sedangDipakai ? "text-gray-800" : "text-gray-500"}">${r.nama}</h3>
                    <ul class="text-sm ${!sedangDipakai ? "text-gray-600" : "text-gray-400"} list-disc list-inside leading-relaxed">
                        <li>${jumlah_pc} PC</li>
                    </ul>
                </div>
            </div>
            <div class="flex justify-between items-center mt-4">
                ${sedangDipakai
                    ? `<div class="bg-red-500 text-white text-xs px-2 py-1 rounded-full font-medium">Sedang Digunakan</div>`
                    : `<span class="text-xs text-green-600 font-medium">Tersedia</span>`}
            </div>
        `;

        label.querySelector(".mt-1").replaceWith(checkbox);
        container.appendChild(label);
    });
}


    function closeModalVerifikasi() {
        const modal = modalOverlayVerifikasi.querySelector('.bg-white');
        modal.classList.remove('scale-100', 'translate-y-0');
        modal.classList.add('scale-75', '-translate-y-12');

        setTimeout(() => {
            modalOverlayVerifikasi.classList.remove('opacity-100', 'visible');
            modalOverlayVerifikasi.classList.add('opacity-0', 'invisible');
        }, 200);
        document.body.style.overflow = 'auto';
    }
</script>
@endsection
