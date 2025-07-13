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
                            'bg-green-100 text-green-800' => $data->status === 'Menunggu Verifikasi',
                            'bg-red-100 text-red-800' => $data->status === 'Ditolak',
                            'bg-yellow-100 text-yellow-800' => !in_array($data->status, ['Menunggu Verifikasi', 'Ditolak']),
                        ])>
                            {{-- {{ $data->status === 'Menunggu Verifikasi' ? 'Disetujui' : $data->status }} --}}
                            @if($data->status === 'Ditolak')
                                Ditolak
                                @elseif ($data->status === 'Menunggu Persetujuan')
                                Menunggu Persetujuan
                                @else
                                disetujui
                            @endif
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

@include('kepalaUpt.pengajuan-surat.detail-surat')
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
