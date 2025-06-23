@extends('layouts.kepala-upt-layout')

@section('title', 'Pengajuan Surat')

@section('page', 'Pengajuan Surat')

@section('style')
<script>
    tailwind.config = {
        theme: {
            extend: {
                animation: {
                    'modal-show': 'modal-show 0.3s cubic-bezier(0.34, 1.56, 0.64, 1)',
                    'fade-in': 'fade-in 0.3s ease-out',
                },
                keyframes: {
                    'modal-show': {
                        '0%': {
                            transform: 'scale(0.7) translateY(-50px)',
                            opacity: '0'
                        },
                        '100%': {
                            transform: 'scale(1) translateY(0)',
                            opacity: '1'
                        }
                    },
                    'fade-in': {
                        '0%': { opacity: '0' },
                        '100%': { opacity: '1' }
                    }
                }
            }
        }
    }
</script>
<style>
    .modal-enter {
        animation: modal-show 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
    }

    .modal-overlay-enter {
        animation: fade-in 0.3s ease-out forwards;
    }

    .date-scroll::-webkit-scrollbar {
        width: 6px;
    }

    .date-scroll::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 3px;
    }

    .date-scroll::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }

    .date-scroll::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>
@endsection

@section('main')
<h1 class="text-2xl font-semibold text-gray-900 mb-6">Pengajuan Surat</h1>

<!-- Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NO</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NOMOR SURAT</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NAMA PEMINJAM</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">STATUS</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">AKSI</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($peminjamans as $data)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$loop->iteration}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$data->nomor_surat}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$data->nama_peminjam}}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span @class([
                            'inline-flex px-2 py-1 text-xs font-medium rounded-full',
                            'bg-green-100 text-green-800' => $data->status === 'Diterima',
                            'bg-red-100 text-red-800' => $data->status === 'Ditolak',
                            'bg-yellow-100 text-yellow-800' => !in_array($data->status, ['Diterima', 'Ditolak'])
                        ])>
                            {{ $data->status }}
                        </span>

                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button onclick="openModal({{ $data->id }})" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm font-medium transition-colors">Detail</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Overlay - PERBAIKAN ID DISINI -->
<div
    id="modalOverlayDetail"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 opacity-0 invisible transition-all duration-300 ease-out"
>
    <!-- Modal Container -->
    <div
        id="modal"
        class="bg-white rounded-xl w-11/12 max-w-lg mx-4 overflow-hidden shadow-2xl transform scale-75 -translate-y-12 transition-all duration-300"
    >
        <!-- Modal Header -->
        <div class="bg-teal-800 text-white px-6 py-5 flex justify-between items-center">
            <h2 class="text-lg font-semibold">Detail Pengajuan Surat</h2>
            <button
                id="closeBtn"
                onclick="closeModalDetail()"
                class="text-white hover:bg-white hover:bg-opacity-10 rounded p-1 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="px-6 py-6 space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-start">
                <span class="font-medium text-gray-700 sm:min-w-[140px] sm:mr-4 mb-1 sm:mb-0">Nomor Surat</span>
                <span class="text-gray-900" id="modal_nomor_surat">: </span>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-start">
                <span class="font-medium text-gray-700 sm:min-w-[140px] sm:mr-4 mb-1 sm:mb-0">Asal Surat</span>
                <span class="text-gray-900" id="modal_asal_surat">: </span>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-start">
                <span class="font-medium text-gray-700 sm:min-w-[140px] sm:mr-4 mb-1 sm:mb-0">Nama Peminjam</span>
                <span class="text-gray-900" id="modal_nama_peminjam">: </span>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-start">
                <span class="font-medium text-gray-700 sm:min-w-[140px] sm:mr-4 mb-1 sm:mb-0">Lama Peminjam</span>
                <span class="text-gray-900" id="modal_lama_peminjam">: </span>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-start">
                <span class="font-medium text-gray-700 sm:min-w-[140px] sm:mr-4 mb-1 sm:mb-0">Status</span>
                <span id="modal_status" class="inline-flex px-2 py-1 text-sm font-medium rounded-full">Menunggu</span>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-start">
                <span class="font-medium text-gray-700 sm:min-w-[140px] sm:mr-4 mb-2 sm:mb-0">Tanggal Peminjam</span>
                <div class="flex-1">
                    <div class="relative">
                        <div class="date-scroll max-h-32 overflow-y-auto bg-gray-50 rounded-md p-3 pr-8 border border-gray-200">
                            <div class="space-y-1 text-sm text-gray-900" id="modal_tanggal_peminjam">
                                <!-- akan diisi JS -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="px-6 py-5 border-t border-gray-200 flex flex-col sm:flex-row justify-between items-center gap-3">
            <a
                href="#"
                id="suratBtn"
                target="_blank"
                class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2.5 px-5 rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 flex items-center justify-center gap-2"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Surat Pengajuan
            </a>
            <div class="flex gap-3">
                <button id="tolakBtn" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2.5 px-5 rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">Tolak</button>
                <button id="terimaBtn" class="bg-teal-700 hover:bg-teal-800 text-white font-medium py-2.5 px-5 rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2">Terima</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    // Data dari Laravel
    let selectedId = null;
    const peminjamanData = @json($peminjamans);

    console.log('Data peminjaman:', peminjamanData); // Debug: lihat data

    // Fungsi untuk membuka modal
    function openModal(id) {
        selectedId = id;
        console.log('openModal dipanggil dengan ID:', id);

        // Cek apakah modal overlay ada
        const modalOverlay = document.getElementById('modalOverlayDetail');
        console.log('Modal overlay ditemukan:', modalOverlay);

        if (!modalOverlay) {
            console.error('Modal overlay tidak ditemukan!');
            alert('Error: Modal overlay tidak ditemukan!');
            return;
        }

        // Cari data berdasarkan ID
        const data = peminjamanData.find(p => p.id === id);
        if (!data) {
            console.warn('Data tidak ditemukan untuk ID:', id);
            alert('Data tidak ditemukan untuk ID: ' + id);
            return;
        }

        console.log('Data ditemukan:', data);

        // Isi field di modal dengan pengecekan element
        const nomorSuratEl = document.getElementById('modal_nomor_surat');
        const asalSuratEl = document.getElementById('modal_asal_surat');
        const namaPeminjamEl = document.getElementById('modal_nama_peminjam');
        const lamaPeminjamEl = document.getElementById('modal_lama_peminjam');
        const statusEl = document.getElementById('modal_status');
        const tanggalEl = document.getElementById('modal_tanggal_peminjam');
        const suratBtn = document.getElementById('suratBtn');

        // Isi data dengan pengecekan
        if (nomorSuratEl) {
            nomorSuratEl.innerText = `: ${data.nomor_surat || 'Tidak tersedia'}`;
        }
        if (asalSuratEl) {
            asalSuratEl.innerText = `: ${data.asal_surat || 'Tidak tersedia'}`;
        }
        if (namaPeminjamEl) {
            namaPeminjamEl.innerText = `: ${data.nama_peminjam || 'Tidak tersedia'}`;
        }
        if (lamaPeminjamEl) {
            lamaPeminjamEl.innerText = `: ${data.lama_hari || 0} hari`;
        }

        // Status dengan warna dinamis
        if (statusEl) {
            statusEl.innerText = data.status || 'Menunggu';
            statusEl.className = 'inline-flex px-2 py-1 text-sm font-medium rounded-full';

            if (data.status === 'Disetujui') {
                statusEl.classList.add('bg-green-100', 'text-green-800');
            } else if (data.status === 'Ditolak') {
                statusEl.classList.add('bg-red-100', 'text-red-800');
            } else {
                statusEl.classList.add('bg-yellow-100', 'text-yellow-800');
            }
        }

        // Tanggal peminjaman
        if (tanggalEl) {
            tanggalEl.innerHTML = '';
            if (data.tanggal_formatted && Array.isArray(data.tanggal_formatted)) {
                data.tanggal_formatted.forEach(tgl => {
                    const div = document.createElement('div');
                    div.innerText = `- ${tgl}`;
                    tanggalEl.appendChild(div);
                });
            } else {
                const div = document.createElement('div');
                div.innerText = '- Tanggal tidak tersedia';
                tanggalEl.appendChild(div);
            }
        }

        // Tombol download lampiran
        if (suratBtn && data.lampiran) {
            suratBtn.href = `/storage/${data.lampiran}`;
        }

        // Tampilkan modal
        const modal = modalOverlay.querySelector('.bg-white');

        modalOverlay.classList.remove('opacity-0', 'invisible');
        modalOverlay.classList.add('opacity-100', 'visible');

        setTimeout(() => {
            if (modal) {
                modal.classList.remove('scale-75', '-translate-y-12');
                modal.classList.add('scale-100', 'translate-y-0');
            }
        }, 10);

        document.body.style.overflow = 'hidden';

        console.log('Modal berhasil ditampilkan');
    }

    // Fungsi untuk menutup modal
    function closeModalDetail() {
        console.log('closeModalDetail dipanggil');

        const modalOverlay = document.getElementById('modalOverlayDetail');
        const modal = modalOverlay ? modalOverlay.querySelector('.bg-white') : null;

        if (modal) {
            modal.classList.remove('scale-100', 'translate-y-0');
            modal.classList.add('scale-75', '-translate-y-12');
        }

        setTimeout(() => {
            if (modalOverlay) {
                modalOverlay.classList.remove('opacity-100', 'visible');
                modalOverlay.classList.add('opacity-0', 'invisible');
            }
        }, 200);

        document.body.style.overflow = 'auto';
    }

    // Tombol Terima
    document.addEventListener('DOMContentLoaded', function() {
        const terimaBtn = document.getElementById('terimaBtn');
        const tolakBtn = document.getElementById('tolakBtn');

            terimaBtn.addEventListener('click', function () {
                if (confirm('Apakah Anda yakin ingin menerima pengajuan ini?')) {
                    const originalText = this.textContent;
                    this.innerHTML = `...spinner...`;
                    this.disabled = true;

                            fetch(`/kepala-upt/pengajuan-surat/${selectedId}/terima`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                    'Content-Type': 'application/json',
                                },
                            })

                    .then(res => res.json())
                    .then(res => {
                        alert(res.message);
                        this.innerHTML = originalText;
                        this.disabled = false;
                        closeModalDetail();
                        location.reload(); // reload untuk update status di tabel
                    })
                    .catch(err => {
                        console.error(err);
                        alert('Gagal menyetujui pengajuan.');
                        this.innerHTML = originalText;
                        this.disabled = false;
                    });
                }
            });


        // Tombol Tolak
                tolakBtn.addEventListener('click', function () {
                    if (confirm('Apakah Anda yakin ingin menolak pengajuan ini?')) {
                        const originalText = this.textContent;
                        this.innerHTML = `...spinner...`;
                        this.disabled = true;

                            fetch(`/kepala-upt/pengajuan-surat/${selectedId}/tolak`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                    'Content-Type': 'application/json',
                                },
                            })

                        .then(res => res.json())
                        .then(res => {
                            alert(res.message);
                            this.innerHTML = originalText;
                            this.disabled = false;
                            closeModalDetail();
                            location.reload(); // reload halaman agar tabel update
                        })
                        .catch(err => {
                            console.error(err);
                            alert('Gagal menolak pengajuan.');
                            this.innerHTML = originalText;
                            this.disabled = false;
                        });
                    }
                });

    });

    // Tutup modal dengan klik luar
    document.addEventListener('click', function(e) {
        const modalOverlay = document.getElementById('modalOverlayDetail');
        if (e.target === modalOverlay) {
            closeModalDetail();
        }
    });

    // Tutup modal dengan ESC
    document.addEventListener('keydown', function (e) {
        const modalOverlay = document.getElementById('modalOverlayDetail');
        if (e.key === 'Escape' && modalOverlay && modalOverlay.classList.contains('visible')) {
            closeModalDetail();
        }
    });

    const statusEl = document.getElementById('modal_status');
statusEl.innerText = data.status || 'Menunggu';
statusEl.className = 'inline-flex px-2 py-1 text-sm font-medium rounded-full';

if (data.status === 'diterima') {
    statusEl.classList.add('bg-green-100', 'text-green-800');
} else if (data.status === 'ditolak') {
    statusEl.classList.add('bg-red-100', 'text-red-800');
} else {
    statusEl.classList.add('bg-yellow-100', 'text-yellow-800');
}
</script>
@endsection
