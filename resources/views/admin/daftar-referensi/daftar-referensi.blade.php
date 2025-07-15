@extends('layouts.admin-layout')

@section('title', 'Daftar Ruangan')

@section('style')
    <style>
        /* Modern scrollbar */
        .scrollbar-modern {
        scrollbar-width: thin;             /* Firefox */
        scrollbar-color: #94a3b8 #f1f5f9;  /* thumb color & track color */
        }

        /* Chrome, Edge, Safari */
        .scrollbar-modern::-webkit-scrollbar {
        width: 6px;                          /* scroll bar width */
        }

        .scrollbar-modern::-webkit-scrollbar-track {
        background: #f1f5f9;                 /* light gray */
        border-radius: 100px;
        }

        .scrollbar-modern::-webkit-scrollbar-thumb {
        background-color: #94a3b8;           /* slate-400 */
        border-radius: 100px;
        border: 2px solid transparent;       /* spacing */
        background-clip: content-box;
        }
    </style>
@endsection

@section('main')
<section class="flex-1">
    <h1 class="text-gray-900 font-semibold text-2xl mb-4">Daftar Ruangan</h1>
    <div class="flex flex-wrap items-center gap-3 mb-6 text-xl text-gray-400">
        {{-- Search & Add Button --}}
        <div class="flex items-center justify-between gap-4 w-full">
            <div class="relative w-full max-w-sm">
                <input
                    type="text"
                    name="search"
                    placeholder="Cari ruangan..."
                    class="w-full pl-10 pr-4 py-2 rounded-full border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:outline-none text-sm text-gray-700"
                >
                <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z"/>
                    </svg>
                </div>
            </div>

            <div class="ml-auto">
                <a href="{{ route('admin.tambah-ruangan-page') }}"
                class="bg-teal-800 text-white rounded-full px-6 py-2 text-[15px] font-semibold hover:bg-teal-900 transition-colors whitespace-nowrap">
                    Tambah Data
                </a>
            </div>
        </div>

    </div>

  <div id="ruanganContainer"></div>

</section>

<div id="modalTambahRuangan" class="fixed inset-0 z-50 flex hidden items-center justify-center bg-black/50 transition-all duration-300 ease-out">
  <div class="relative w-full max-w-3xl bg-white rounded-xl shadow-2xl transform transition-all duration-300 scale-95">

    <!-- Header -->
    <div class="bg-teal-800 text-white flex items-center justify-between px-6 py-4 rounded-t-lg">
      <h2 class="text-lg font-semibold">Form Edit Ruangan</h2>
      <button onclick="tutupModalRuangan()" class="p-1 rounded hover:bg-white hover:bg-opacity-10 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50 transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>

    <!-- Body -->
    <div class="px-6 pb-6 max-h-[80vh] overflow-y-auto scrollbar-modern">
     @include('admin.daftar-referensi.update-ruangan')
    </div>
  </div>
</div>


@endsection

@section('js')

<script>
    let formEditId = null;

    function fetchRuangans(search = '') {
        const url = `{{ route('admin.ruangan.json') }}?search=${encodeURIComponent(search)}`;
        fetch(url)
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('ruanganContainer');
                container.innerHTML = '';

                if (data.length === 0) {
                    container.innerHTML = `<div class="text-center text-gray-500 py-10">Belum ada data ruangan.</div>`;
                    return;
                }

                data.forEach(ruangan => {
                    let fasilitasRows = '';
                    if (ruangan.fasilitas.length > 0) {
                        ruangan.fasilitas.forEach((fasilitas, idx) => {
                            fasilitasRows += `
                                <tr>
                                    ${idx === 0 ? `
                                        <td class="pr-4 text-left align-top" rowspan="${ruangan.fasilitas.length}">Fasilitas</td>
                                        <td class="px-2 text-center align-top" rowspan="${ruangan.fasilitas.length}">:</td>
                                    ` : ''}
                                    <td class="text-left">
                                        ${fasilitas.nama}
                                        ${fasilitas.jumlah > 1 ? `(Jumlah: ${fasilitas.jumlah})` : ''}
                                    </td>
                                </tr>
                            `;
                        });
                    } else {
                        fasilitasRows = `
                            <tr>
                                <td class="pr-4 font-semibold text-right">Fasilitas</td>
                                <td class="px-2 text-center">:</td>
                                <td class="text-left"><em>Tidak ada fasilitas</em></td>
                            </tr>
                        `;
                    }

                    const card = document.createElement('div');
                    card.className = 'bg-white bg-opacity-30 shadow-xl rounded-xl p-10 max-w-9xl flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-8';
                    card.innerHTML = `
                        <div class="flex-1 overflow-x-10">
                            <table class="w-full text-sm text-gray-900 border-separate border-spacing-y-2">
                                <tbody>
                                    <tr>
                                        <td class="pr-4 text-left w-[150px]">Nama Ruangan</td>
                                        <td class="px-2 text-center w-2">:</td>
                                        <td class="text-left">${ruangan.nama}</td>
                                    </tr>
                                    <tr>
                                        <td class="pr-4 text-left">Nomor Ruangan</td>
                                        <td class="px-2 text-center">:</td>
                                        <td class="text-left">${ruangan.nomor}</td>
                                    </tr>
                                    <tr>
                                        <td class="pr-4 text-left">Kapasitas Orang</td>
                                        <td class="px-2 text-center">:</td>
                                        <td class="text-left">${ruangan.kapasitas}</td>
                                    </tr>
                                    ${fasilitasRows}
                                </tbody>
                            </table>
                        </div>
                        <div class="flex flex-col gap-4">
                            <img alt="Gambar Ruangan" class="rounded-lg object-cover w-[350px] h-[250px]" src="${ruangan.gambar}" />
                            <div class="flex justify-end gap-3">
                                <button
                                    class="btn-edit bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors text-sm rounded-lg px-4 py-3 flex items-center gap-2">
                                    <i class="fas fa-edit "></i> Edit
                                </button>
                                <button
                                    class="btn-delete bg-red-500 hover:bg-red-600 text-white text-sm rounded-lg transition-colors px-4 py-3 flex items-center gap-2">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </div>
                        </div>
                    `;
                const editButton = card.querySelector('.btn-edit');
                editButton.dataset.id = ruangan.id;
                editButton.dataset.nama = ruangan.nama;
                editButton.dataset.nomor = ruangan.nomor;
                editButton.dataset.kapasitas = ruangan.kapasitas;
                editButton.dataset.gambar = ruangan.gambar ?? '';
                editButton.dataset.fasilitas = JSON.stringify(ruangan.fasilitas);
                editButton.addEventListener('click', function() {
                    editRuangan(this);
                });

                 // Tambahkan event listener untuk delete
                const deleteButton = card.querySelector('.btn-delete');
                deleteButton.addEventListener('click', function() {
                    konfirmasiHapus(ruangan.id, ruangan.nama);
                });


                    container.appendChild(card);
                });
            });
    }

     // Panggil saat halaman load
    fetchRuangans();

    // Jika ingin auto-refresh setiap 5 detik (opsional)
    // setInterval(fetchRuangans, 5000);

    function debounce(func, delay) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    }

    document.querySelector('input[name="search"]').addEventListener('input', debounce(function() {
        const searchValue = this.value.trim();
        fetchRuangans(searchValue);
    }, 300));



    function editRuangan(button) {
        const id = button.dataset.id;
        const nama = button.dataset.nama;
        const nomor = button.dataset.nomor;
        const kapasitas = button.dataset.kapasitas;
        const gambar = button.dataset.gambar;
        const fasilitas = JSON.parse(button.dataset.fasilitas);

        document.getElementById('nomor-ruangan').value = nomor;
        document.getElementById('nama-ruangan').value = nama;
        document.getElementById('kapasitas').value = kapasitas;
        formEditId = id;

        const container = document.getElementById('fasilitasContainer');
        container.innerHTML = '';

        fasilitas.forEach(item => {
            const div = document.createElement('div');
            div.className = 'fasilitas-item flex items-center space-x-3 mb-3';

            let options = '';
            fasilitasList.forEach(fas => {
                options += `<option value="${fas.id}">${fas.nama}</option>`;
            });

            div.innerHTML = `
                <div class="relative w-64 inline-block">
                        <select name="fasilitas[]" class="w-full px-3 py-2 pr-8 border border-gray-300 rounded-md appearance-none focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                        ${options}
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                        </div>
                    </div>
                    <input type="number" value="${item.jumlah}" min="1" name="jumlah[]" class="w-16 px-3 py-2 border border-gray-300 rounded-md text-center focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
                <button type="button" onclick="hapusFasilitas(this)" class="px-3 py-2 bg-red-500 text-white rounded-md">Hapus</button>
            `;

            container.appendChild(div);

            // Set value yang sesuai
            div.querySelector('select').value = item.id;
        });

          // Gambar preview
        const preview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        if (gambar) {
            previewImg.src = gambar;
            preview.classList.remove('hidden');
        } else {
            removeImage(); // reset preview
        }

        bukaModalRuangan();
        // updateOptions();
        // attachSelectListeners();
    }

    function tambahFasilitas() {
        const container = document.getElementById('fasilitasContainer');
        const allSelects = container.querySelectorAll('select[name="fasilitas[]"]');

        const selectedValues = Array.from(allSelects)
            .map(s => s.value)
            .filter(v => v !== "");

        if (selectedValues.length >= fasilitasList.length) {
            Swal.fire({
                icon: 'warning',
                title: 'Tidak bisa menambah',
                text: 'Semua fasilitas sudah ditambahkan.',
            });
            return;
        }

        const div = document.createElement('div');
        div.className = 'fasilitas-item flex items-center space-x-3 mb-3';

        let options = '<option value="">Pilih Fasilitas</option>';
        fasilitasList.forEach(fas => {
            options += `<option value="${fas.id}">${fas.nama}</option>`;
        });

        div.innerHTML = `
            <select name="fasilitas[]" class="w-64 px-3 py-2 pr-8 border border-gray-300 rounded-md">
                ${options}
            </select>
            <input type="number" value="1" min="1" name="jumlah[]" class="w-16 px-3 py-2 border border-gray-300 rounded-md text-center" />
            <button type="button" onclick="hapusFasilitas(this)" class="px-3 py-2 bg-red-500 text-white rounded-md">Hapus</button>
        `;

        container.appendChild(div);
        updateOptions();
        attachSelectListeners();
    }


    function hapusFasilitas(button) {
        const container = document.getElementById('fasilitasContainer');
        const fasilitasItems = container.querySelectorAll('.fasilitas-item');

        if (fasilitasItems.length <= 1) {
            Swal.fire({
                icon: 'warning',
                title: 'Tidak bisa menghapus',
                text: 'Minimal harus ada satu fasilitas.',
            });
            return;
        }

        button.parentElement.remove();
        updateOptions();
    }


    function updateOptions() {
        const allSelects = document.querySelectorAll('select[name="fasilitas[]"]');
        const selectedValues = Array.from(allSelects)
            .map(s => s.value)
            .filter(v => v !== "");

        allSelects.forEach(select => {
            const currentValue = select.value;
            select.innerHTML = "";

            fasilitasList.forEach(fas => {
                // Jika belum dipilih oleh select lain atau sedang dipakai di select ini, tampilkan
                if (!selectedValues.includes(String(fas.id)) || String(fas.id) === currentValue) {
                    const option = document.createElement('option');
                    option.value = fas.id;
                    option.textContent = fas.nama;
                    if (String(fas.id) === currentValue) {
                        option.selected = true;
                    }
                    select.appendChild(option);
                }
            });
        });
    }

    function attachSelectListeners() {
        const allSelects = document.querySelectorAll('select[name="fasilitas[]"]');
        allSelects.forEach(select => {
            select.removeEventListener('change', updateOptions);
            select.addEventListener('change', updateOptions);
        });
    }



    function bukaModalRuangan() {
        const modal = document.getElementById('modalTambahRuangan');
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0', 'scale-95', 'bg-opacity-0');
            modal.classList.add('opacity-100', 'scale-100', 'bg-opacity-50', 'visible');
        }, 10);
    }

    function tutupModalRuangan() {
        const modal = document.getElementById('modalTambahRuangan');
        modal.classList.remove('opacity-100', 'scale-100', 'bg-opacity-50');
        modal.classList.add('opacity-0', 'scale-95', 'bg-opacity-0', 'visible');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300); // sesuai dengan durasi transition
    }

    function konfirmasiHapus(id, nama) {
        Swal.fire({
            title: `Hapus ruangan "${nama}"?`,
            text: 'Data ruangan yang dihapus tidak dapat dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/daftar-referensi/admin/ruangan/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Gagal menghapus ruangan.');
                    }
                    return response.json();
                })
                .then(data => {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-end',
                        icon: 'success',
                        title: data.messageDeleteSuccess || 'Ruangan berhasil dihapus.',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                    fetchRuangans(); // refresh data setelah hapus
                })
                .catch(err => {
                    Swal.fire('Error', err.message, 'error');
                });
            }
        });
    }

    modalTambahRuangan?.addEventListener('click', function(e) {
        if (e.target === modalTambahRuangan) {
            tutupModalRuangan();
        }
    });

// Close modal dengan ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (modalTambahRuangan?.classList.contains('visible')) {
                tutupModalRuangan();
            }
        }
    });

</script>

@if(session('successTambahRuangan'))
    <script>
    Swal.fire({
        toast: true,
        position: 'bottom-end',
        icon: 'success',
        title: '{{ session('successTambahRuangan') }}',
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true
    });
    </script>
@endif

@if(session('successBatal'))
    <script>
        Swal.fire({
            toast: true,
            position: 'bottom-end',
            icon: 'success',
            title: '{{ session('successBatal') }}',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
        });
    </script>
@endif




@endsection
