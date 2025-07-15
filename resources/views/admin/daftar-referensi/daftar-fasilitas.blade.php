@extends('layouts.admin-layout')

@section('title', 'Daftar Fasilitas')

@section('style')

@endsection

@section('main')


           <h2 class="text-gray-900 font-semibold text-2xl mb-6">Daftar Fasilitas</h2>
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
             <div class="flex gap-3 flex-1 max-w-md">
                <!-- Search Input -->
                <div class="relative flex-1">
                <input
                    id="searchInput"
                    type="text"
                    placeholder="Search..."
                    class="w-full border border-gray-300 rounded-md py-2 pl-3 pr-10 text-sm text-gray-600 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-700 focus:border-transparent"
                />
                <i class="fas fa-search absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm pointer-events-none"></i>
                </div>

                <!-- Sort Select -->
                <div class="relative w-48">
                <select
                    id="sortSelect"
                    class="w-full border border-gray-300 rounded-md py-2 pl-3 pr-8 text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-teal-700 focus:border-transparent appearance-none"
                >
                    <option selected disabled>Pilih Urutan</option>
                    <option value="asc">A-Z</option>
                    <option value="desc">Z-A</option>
                    <option value="newest">Data Terbaru</option>
                    <option value="oldest">Data Terlama</option>
                </select>
                <!-- Custom Arrow -->
                <svg
                    class="w-4 h-4 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
                </div>
            </div>

            <!-- Tambah Fasilitas Button -->
            <button
                type="button"
                onclick="openModalTambahFasilitas()"
                class="bg-teal-800 text-white rounded-full px-6 py-2 text-sm font-semibold hover:bg-teal-900 transition-colors whitespace-nowrap"
            >
                Tambah Fasilitas
            </button>
            </div>

            <div class="overflow-x-auto max-w-full rounded-lg bg-white shadow">
            <table class="min-w-full table-fixed divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th class="py-3 px-6 whitespace-nowrap text-left text-sm font-semibold text-gray-400 uppercase tracking-wider">No</th>
                    <th class="py-3 px-6 whitespace-nowrap text-left text-sm font-semibold text-gray-400 uppercase tracking-wider">Nama Fasilitas</th>
                    <th class="py-3 px-6 whitespace-nowrap text-center text-sm font-semibold text-gray-400 uppercase tracking-wider">Aksi</th>
                </tr>
                </thead>
                <tbody id="fasilitasTableBody" class="divide-y divide-gray-200 text-sm">
                <!-- Data here -->
                </tbody>
            </table>
            </div>



            <!-- Modals -->
            <div id="modalOverlayTambahFasilitas" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 opacity-0 invisible transition-all duration-300 ease-out">
            @include('admin.daftar-referensi.tambah-fasilitas')
            </div>

            <div id="modalOverlayUpdateFasilitas" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 opacity-0 invisible transition-all duration-300 ease-out">
            @include('admin.daftar-referensi.update-fasilitas')
            </div>

@endsection

@section('js')
<script>

    function fetchFasilitas() {
        const keyword = document.getElementById('searchInput').value.trim();
        const sortDirection = document.getElementById('sortSelect').value; // 'asc' or 'desc'

        const url = new URL('{{ route('admin.fasilitas.json') }}', window.location.origin);
        url.searchParams.append('search', keyword);

        // Tentukan sort berdasarkan pilihan
        if (sortDirection === 'asc' || sortDirection === 'desc') {
            url.searchParams.append('sort', sortDirection);
        } else if (sortDirection === 'newest') {
            url.searchParams.append('sort', 'desc');
            url.searchParams.append('sortBy', 'created_at');
        } else if (sortDirection === 'oldest') {
            url.searchParams.append('sort', 'asc');
            url.searchParams.append('sortBy', 'created_at');
        }

        fetch(url)
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('fasilitasTableBody');
                tbody.innerHTML = '';
                if (data.length === 0) {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td colspan="3" class="text-center text-gray-500 py-6">
                            Tidak ada fasilitas yang ditemukan.
                        </td>
                    `;
                    tbody.appendChild(tr);
                } else {
                    data.forEach((fasilitas, index) => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td class="px-6 py-4 text-sm text-gray-700">${index + 1}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">${fasilitas.nama}</td>
                            <td class="py-3 px-6 text-center flex justify-center gap-4">
                                <button onclick="openModalUpdateFasilitas(${fasilitas.id}, '${fasilitas.nama}')">
                                    <img src="{{ asset('assets/images/icon/action-edit-icon.svg') }}" alt="Edit"/>
                                </button>
                                <button type="button" onclick="hapusFasilitas(${fasilitas.id})">
                                    <img src="{{ asset('assets/images/icon/action-delete-icon.svg') }}" alt="Delete"/>
                                </button>
                            </td>
                        `;
                        tbody.appendChild(tr);
                    });
                }
            });
    };

    // debounce untuk live search
    function debounce(func, delay) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    }


    document.getElementById('searchInput').addEventListener('input', () => {
        debounce(fetchFasilitas(), 3000);
    });

    document.getElementById('sortSelect').addEventListener('change', () => {
        fetchFasilitas();
    });

    // Muat pertama kali saat halaman dibuka
    fetchFasilitas();


    // Auto-refresh setiap 5 detik
    setInterval(fetchFasilitas, 5000);


    const modalOverlayTambahFasilitas = document.getElementById('modalOverlayTambahFasilitas');
    const modalOverlayUpdateFasilitas = document.getElementById('modalOverlayUpdateFasilitas');


    // TAMBAH FASILITAS MODAL FUNCTIONS
    function openModalTambahFasilitas() {
        // Tampilkan modal update
        const modal = document.querySelector('#modalOverlayTambahFasilitas .bg-white');
        modalOverlayTambahFasilitas.classList.remove('opacity-0', 'invisible');
        modalOverlayTambahFasilitas.classList.add('opacity-100', 'visible');

        setTimeout(() => {
            modal.classList.remove('scale-75', '-translate-y-12');
            modal.classList.add('scale-100', 'translate-y-0');
        }, 10);

        document.body.style.overflow = 'hidden';
    }

    // CLOSE TAMBAH FASILITAS MODAL FUNCTIONS
    function closeModalTambahFasilitas() {
        const modal = document.querySelector('#modalOverlayTambahFasilitas .bg-white');
        modal.classList.remove('scale-100', 'translate-y-0');
        modal.classList.add('scale-75', '-translate-y-12');

        setTimeout(() => {
            modalOverlayTambahFasilitas.classList.remove('opacity-100', 'visible');
            modalOverlayTambahFasilitas.classList.add('opacity-0', 'invisible');
        }, 200);

        document.body.style.overflow = 'auto';
        currentPeminjamanId = null;
    }

    function cancelledModalTambahFasilitas() {
        Swal.fire({
            title: 'Batalkan input?',
            text: 'Data yang sudah diisi akan hilang.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, batalkan',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const modal = document.querySelector('#modalOverlayTambahFasilitas .bg-white');
                modal.classList.remove('scale-100', 'translate-y-0');
                modal.classList.add('scale-75', '-translate-y-12');

                // Kosongkan input saat modal akan ditutup
                const inputNamaFasilitas = document.querySelector('#modalOverlayTambahFasilitas input[name="nama"]');
                if (inputNamaFasilitas) {
                    inputNamaFasilitas.value = '';
                }

                setTimeout(() => {
                    modalOverlayTambahFasilitas.classList.remove('opacity-100', 'visible');
                    modalOverlayTambahFasilitas.classList.add('opacity-0', 'invisible');
                }, 200);

                document.body.style.overflow = 'auto';
                currentPeminjamanId = null;

                // Optional: tambahkan toast notif dibatalkan
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    icon: 'success',
                    title: 'Berhasil Membatlkan',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                });
            }
        });
    }


    // UPDATE FASILITAS MODAL FUNCTIONS
    function openModalUpdateFasilitas(id, nama) {
        // Tampilkan modal update
        const modal = document.querySelector('#modalOverlayUpdateFasilitas .bg-white');
        const form = document.getElementById('formUpdateFasilitas');
        const inputNama = document.getElementById('inputNamaFasilitas');

        // Isi form action URL sesuai id fasilitas
        form.action = '/admin/daftar-referensi/fasilitas/update/' + id;

        // Isi input dengan data fasilitas yang dipilih
        inputNama.value = nama;

        modalOverlayUpdateFasilitas.classList.remove('opacity-0', 'invisible');
        modalOverlayUpdateFasilitas.classList.add('opacity-100', 'visible');

        setTimeout(() => {
            modal.classList.remove('scale-75', '-translate-y-12');
            modal.classList.add('scale-100', 'translate-y-0');
        }, 10);

        document.body.style.overflow = 'hidden';
    }

    // CLOSE TAMBAH FASILITAS MODAL FUNCTIONS
    function closeModalUpdateFasilitas() {
        const modal = document.querySelector('#modalOverlayUpdateFasilitas .bg-white');
        modal.classList.remove('scale-100', 'translate-y-0');
        modal.classList.add('scale-75', '-translate-y-12');

        setTimeout(() => {
            modalOverlayUpdateFasilitas.classList.remove('opacity-100', 'visible');
            modalOverlayUpdateFasilitas.classList.add('opacity-0', 'invisible');
        }, 200);

        document.body.style.overflow = 'auto';
        currentPeminjamanId = null;
    }



    modalOverlayTambahFasilitas?.addEventListener('click', function(e) {
        if (e.target === modalOverlayTambahFasilitas) {
            closeModalTambahFasilitas();
        }
    });

    modalOverlayUpdateFasilitas?.addEventListener('click', function(e) {
        if (e.target === modalOverlayUpdateFasilitas) {
            closeModalUpdateFasilitas();
        }
    });

    // Close modal dengan ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (modalOverlayTambahFasilitas?.classList.contains('visible')) {
                closeModalTambahFasilitas();
            }
            if (modalOverlayUpdateFasilitas?.classList.contains('visible')) {
                closeModalUpdateFasilitas();
            }
        }
    });

    function hapusFasilitas(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: 'Data fasilitas yang dihapus tidak dapat dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/daftar-referensi/fasilitas/delete/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(data => {
                            throw new Error(data.message || 'Gagal menghapus data.');
                        });
                    }
                    return response.json();
                })
                .then(res => {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-end',
                        icon: 'success',
                        title: res.message || 'Fasilitas berhasil dihapus.',
                        timer: 3000,
                        showConfirmButton: false,
                        timerProgressBar: true
                    });

                    fetchFasilitas(); // Panggil fungsi refresh tabel agar data real-time
                })
                .catch(err => {
                    Swal.fire({
                        icon: 'error',
                        title: err.message || 'Terjadi kesalahan.',
                    });
                });
            }
        });
    }

</script>
@endsection
