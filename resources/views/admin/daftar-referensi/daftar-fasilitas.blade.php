@extends('layouts.admin-layout')

@section('title', 'Daftar Fasilitas')

@section('style')

@endsection

@section('main')
           <div class="mb-6">
          <h1 class="text-2xl font-bold text-gray-900 mb-4">Daftar Fasilitas</h1>
          <div class="flex flex-wrap gap-4 items-center">
            <div class="relative w-1/3">
              <input id="searchInput" type="search" placeholder="Search..." class="w-full border border-gray-300 rounded-md pl-9 pr-3 py-2 focus:outline-none focus:border-teal-600 focus:ring-1 focus:ring-teal-600" />
              <svg class="w-5 h-5 text-gray-400 absolute left-2 top-2.5 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="7" />
                <line x1="21" y1="21" x2="16.65" y2="16.65" />
              </svg>
            </div>
            <!-- Sort select -->
            <select id="sortSelect" class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:border-teal-600 focus:ring-1 focus:ring-teal-600">
                <option value="oldest" selected disabled>Pilih Urutan</option>
                <option value="asc">A-Z</option>
                <option value="desc">Z-A</option>
                <option value="newest">Data Terbaru</option>
                <option value="oldest">Data Terlama</option>
            </select>
            <button type="button" onclick="openModalTambahFasilitas()" class="ml-auto bg-teal-800 hover:bg-teal-900 rounded-full px-5 py-2 text-white transition">Tambah Fasilitas</button>
          </div>
        </div>
        <!-- Table -->
        <div class="overflow-x-auto rounded-lg bg-white shadow">
          <table class="w-full table-auto text-left text-gray-800">
            <thead class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
              <tr>
                <th class="py-3 px-6">No</th>
                <th class="py-3 px-6">Nama Fasilitas</th>
                <th class="py-3 px-6 text-center">Aksi</th>
              </tr>
            </thead>
            <tbody id="fasilitasTableBody" class="divide-y divide-gray-100 text-sm">

            </tbody>
          </table>
        </div>

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
                    icon: 'info',
                    title: 'Input dibatalkan',
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
