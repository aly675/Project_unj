@extends('layouts.admin-layout')

@section('title', 'Daftar Fasilitas')

@section('style')

@endsection

@section('main')
           <div class="mb-6">
          <h1 class="text-2xl font-bold text-gray-900 mb-4">Daftar Fasilitas</h1>
          <div class="flex flex-wrap gap-4 items-center">
            <div class="relative w-60">
              <input type="search" placeholder="Search..." class="w-full border border-gray-300 rounded-md pl-9 pr-3 py-2 focus:outline-none focus:border-teal-600 focus:ring-1 focus:ring-teal-600" />
              <svg class="w-5 h-5 text-gray-400 absolute left-2 top-2.5 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="7" />
                <line x1="21" y1="21" x2="16.65" y2="16.65" />
              </svg>
            </div>
            <select class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:ring-1 focus:ring-teal-600 focus:border-teal-600">
              <option>Status : All</option>
              <option>Active</option>
              <option>Inactive</option>
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
            <tbody class="divide-y divide-gray-100 text-sm">
                @foreach ($fasilitasList as $fasilitas )
                <tr>
                    <td class="py-3 px-6">{{ $loop->iteration }}</td>
                    <td class="py-3 px-6">{{ $fasilitas->nama }}</td>
                    <td class="py-3 px-6 text-center flex justify-center gap-4">
                        <button onclick="openModalUpdateFasilitas({{ $fasilitas->id }}, '{{ $fasilitas->nama }}')" type="button">
                            <img src="{{ asset('assets/images/icon/action-edit-icon.svg') }}" alt="Edit action icon"/>
                        </button>
                        <form action="{{route('admin.delete-fasilitas', $fasilitas->id)}}" class="mb-0" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit">
                                <img src="{{ asset('assets/images/icon/action-delete-icon.svg') }}" alt="Delete action icon"/>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
              <tr>
                <td class="py-3 px-6">3</td>
                <td class="py-3 px-6">Stopkontak</td>
                <td class="py-3 px-6 text-center flex justify-center gap-4">
                    <button onclick="openModalUpdateFasilitas()" type="button">
                        <img src="{{ asset('assets/images/icon/action-edit-icon.svg') }}" alt="Edit action icon"/>
                    </button>
                    <button type="submit">
                        <img src="{{ asset('assets/images/icon/action-delete-icon.svg') }}" alt="Delete action icon"/>
                    </button>
                </td>
              </tr>
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
        const confirmCancel = confirm("Apakah Anda yakin ingin membatalkan? Data yang sudah diisi akan hilang!");

        if (!confirmCancel) {
            return; // Jika user klik Cancel, maka tidak melakukan apa-apa
        }

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


</script>
@endsection
