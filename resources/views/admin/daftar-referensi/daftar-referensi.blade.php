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
    <h1 class="text-gray-900 font-extrabold text-2xl mb-4">Daftar Ruangan</h1>
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

    @foreach($ruangans as $ruangan)
        <div class="bg-white bg-opacity-30 shadow-xl rounded-xl p-10 max-w-9xl flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-8">
            <div class="flex-1 overflow-x-10">
                <table class="w-full text-sm text-gray-900 font-normal">
                    <tbody>
                        <tr>
                            <td class="pr-4 font-semibold text-right w-[150px]">Nama Ruangan</td>
                            <td class="px-2 text-center w-2">:</td>
                            <td class="text-left">{{ $ruangan->nama }}</td>
                        </tr>
                        <tr>
                            <td class="pr-4 font-semibold text-right">Nomor Ruangan</td>
                            <td class="px-2 text-center">:</td>
                            <td class="text-left">{{ $ruangan->nomor }}</td>
                        </tr>
                        <tr>
                            <td class="pr-4 font-semibold text-right">Kapasitas Orang</td>
                            <td class="px-2 text-center">:</td>
                            <td class="text-left">{{ $ruangan->kapasitas }}</td>
                        </tr>
                        <tr>
                            <td class="pr-4 font-semibold text-right align-top" rowspan="{{ max(1, $ruangan->fasilitas->count()) }}">Fasilitas</td>
                            <td class="px-2 text-center align-top" rowspan="{{ max(1, $ruangan->fasilitas->count()) }}">:</td>
                            <td class="text-left">
                                @if($ruangan->fasilitas->count())
                                    {{ $ruangan->fasilitas[0]->nama }}
                                    @if($ruangan->fasilitas[0]->pivot->jumlah > 1)
                                        (Jumlah Fasilitas : {{ $ruangan->fasilitas[0]->pivot->jumlah }})
                                    @endif
                                @else
                                    <em>Tidak ada fasilitas</em>
                                @endif
                            </td>
                        </tr>
                        @foreach($ruangan->fasilitas->slice(1) as $fasilitas)
                            <tr>
                                <td class="text-left">
                                    {{ $fasilitas->nama }}
                                    @if($fasilitas->pivot->jumlah > 1)
                                        (Jumlah Fasilitas : {{ $fasilitas->pivot->jumlah }})
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex flex-col items-center gap-4">
                <img alt="Gambar Ruangan" class="rounded-lg object-cover w-[300px] h-[220px]"
                    src="{{ $ruangan->gambar ? asset('storage/'.$ruangan->gambar) : asset('/placeholder.svg') }}" width="200" height="120"/>
                <div class="flex gap-2">
                    <button
                        onclick="editRuangan(this)"
                        class="bg-blue-600 hover:bg-blue-700 text-white text-xs rounded mb-[15px] px-5 py-2 flex items-center gap-1"
                        data-id="{{ $ruangan->id }}"
                        data-nama="{{ $ruangan->nama }}"
                        data-nomor="{{ $ruangan->nomor }}"
                        data-kapasitas="{{ $ruangan->kapasitas }}"
                        data-gambar="{{ $ruangan->gambar }}"
                        data-fasilitas='@json($ruangan->fasilitas->map(fn($f) => [
                            "id" => $f->id,
                            "nama" => $f->nama,
                            "jumlah" => $f->pivot->jumlah
                        ]))'
                    >
                        <i class="fas fa-edit"></i> Edit
                    </button>

                    <form id="form-hapus-{{ $ruangan->id }}" method="POST" action="{{ route('admin.delete-ruangan', $ruangan->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="button"
                                onclick="konfirmasiHapus({{ $ruangan->id }})"
                                class="bg-red-600 hover:bg-red-700 text-white text-xs rounded px-4 py-2 flex items-center gap-1">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    </form>

                </div>
            </div>
        </div>
    @endforeach

    @if($ruangans->isEmpty())
        <div class="text-center text-gray-500 py-10">Belum ada data ruangan.</div>
    @endif
</section>

<div id="modalTambahRuangan"
     class="fixed inset-0 z-50 flex hidden items-center justify-center bg-black bg-opacity-0 opacity-0 scale-95
            transition-all duration-300 ease-out">
    <div class="relative w-full max-w-3xl bg-white rounded-lg shadow-xl scale-95 transition-transform duration-300">
        <div class="bg-teal-800 text-white px-6 py-4 rounded-t-lg flex justify-between items-center">
            <h1 class="text-xl font-semibold">Form Edit Ruangan</h1>
            <button onclick="tutupModalRuangan()" class="text-white text-2xl hover:text-gray-300">&times;</button>
        </div>

        <div class="max-h-[90vh] overflow-y-auto scrollbar-modern p-2">
            <div class="bg-white rounded-lg border p-6">
                @include('admin.daftar-referensi.update-ruangan')
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    let formEditId = null;

    function editRuangan(button) {
        // Ambil data dari attribute
        const id = button.dataset.id;
        const nama = button.dataset.nama;
        const nomor = button.dataset.nomor;
        const kapasitas = button.dataset.kapasitas;
        const gambar = button.dataset.gambar;
        const fasilitas = JSON.parse(button.dataset.fasilitas);

        // Isi form
        document.getElementById('nomor-ruangan').value = nomor;
        document.getElementById('nama-ruangan').value = nama;
        document.getElementById('kapasitas').value = kapasitas;

        // Simpan ID edit untuk endpoint update
        formEditId = button.dataset.id;

        // Reset fasilitas
        const container = document.getElementById('fasilitasContainer');
        container.innerHTML = ''; // Clear existing facilities

        // Populate facilities based on data-fasilitas
        fasilitas.forEach(item => {
            const div = document.createElement('div');
            div.className = 'fasilitas-item flex items-center space-x-3 mb-3';
            div.innerHTML = `
                <select name="fasilitas[]" class="px-3 py-2 border rounded-md">
                    @foreach ($listFasilitas as $listFas)
                        <option value="{{ $listFas->id }}">{{ $listFas->nama }}</option>
                    @endforeach
                </select>
                <div class="relative">
                    <input type="number" value="${item.jumlah}" min="1" name="jumlah[]" class="w-16 px-3 py-2 border rounded-md text-center" />
                    <div class="absolute right-1 top-1/2 transform -translate-y-1/2 flex flex-col">
                        <button type="button" onclick="incrementQuantity(this)" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                        <button type="button" onclick="decrementQuantity(this)" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <button type="button" onclick="hapusFasilitas(this)" class="px-3 py-2 bg-red-500 text-white rounded-md">Hapus</button>
            `;
            container.appendChild(div);
            // Select the correct option
            div.querySelector('select').value = item.id;
        });


        // Gambar preview
        const preview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        if (gambar) {
            previewImg.src = `/storage/${gambar}`;
            preview.classList.remove('hidden');
        } else {
            removeImage(); // reset preview
        }

        // Tampilkan modal
        bukaModalRuangan();
    }

    function bukaModalRuangan() {
        const modal = document.getElementById('modalTambahRuangan');
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0', 'scale-95', 'bg-opacity-0');
            modal.classList.add('opacity-100', 'scale-100', 'bg-opacity-50');
        }, 10);
    }

    function tutupModalRuangan() {
        const modal = document.getElementById('modalTambahRuangan');
        modal.classList.remove('opacity-100', 'scale-100', 'bg-opacity-50');
        modal.classList.add('opacity-0', 'scale-95', 'bg-opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300); // sesuai dengan durasi transition
    }

    function konfirmasiHapus(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: 'Data ruangan yang dihapus tidak dapat dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-hapus-' + id).submit();
            }
        });
    }
</script>
@endsection
