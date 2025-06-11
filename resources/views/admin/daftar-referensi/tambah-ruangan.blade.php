@extends('layouts.admin-layout')

@section('title', 'Tambah Ruangan')

@section('main')
<div class="max-w-5xl">
    <h1 class="text-2xl font-semibold text-gray-900 mb-6">Form Input Ruangan</h1>

    <div class="bg-white rounded-lg shadow-sm border p-6">
        <form class="space-y-6" id="roomForm" action="{{ route('tambah.ruangan') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Nomor Ruangan -->
            <div>
                <label for="nomor-ruangan" class="block text-sm font-medium text-gray-700 mb-2">
                    Nomor Ruangan
                </label>
                <input
                    type="text"
                    id="nomor-ruangan"
                    name="nomor_ruangan"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md"
                    value="{{ old('nomor_ruangan') }}"
                >
            </div>

            <!-- Nama Ruangan -->
            <div>
                <label for="nama-ruangan" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Ruangan
                </label>
                <input
                    type="text"
                    id="nama-ruangan"
                    name="nama_ruangan"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md"
                    value="{{ old('nama_ruangan') }}"
                >
            </div>

            <!-- Kapasitas Orang -->
            <div>
                <label for="kapasitas" class="block text-sm font-medium text-gray-700 mb-2">
                    Kapasitas Orang
                </label>
                <input
                    type="number"
                    id="kapasitas"
                    name="kapasitas"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md"
                    value="{{ old('kapasitas') }}"
                >
            </div>

            <!-- Pilih Fasilitas -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Pilih Fasilitas:
                </label>
                <div id="fasilitasContainer">
                    <div class="fasilitas-item flex items-center space-x-3 mb-3">
                        <select name="fasilitas[]" class="px-3 py-2 border border-gray-300 rounded-md">
                            @foreach($fasilitas as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="jumlah[]" value="1" min="1" class="w-16 px-3 py-2 border border-gray-300 rounded-md text-center" />
                        <button type="button" onclick="hapusFasilitas(this)" class="px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors">Hapus</button>
                    </div>
                </div>
                <button type="button" onclick="tambahFasilitas()" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors">
                    Tambah Fasilitas
                </button>
            </div>

            <!-- Gambar Ruangan -->
            <div>
                <label for="gambar-ruangan" class="block text-sm font-medium text-gray-700 mb-2">
                    Gambar Ruangan
                </label>
                <input
                    type="file"
                    id="gambar-ruangan"
                    name="gambar_ruangan"
                    accept=".jpeg,.jpg,.png"
                    class="w-full text-sm text-gray-500"
                >
                <p class="text-xs text-gray-500 mt-2">
                    Format file yang diperbolehkan: *.jpeg, *.jpg, *.png dengan ukuran maksimum 2 MB.
                </p>
            </div>

            <div class="flex justify-end space-x-3 pt-6">
                <a href="{{ route('admin.daftar-referensi-page') }}" class="px-6 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors">Batal</a>
                <button type="submit" class="px-6 py-2 bg-teal-600 hover:bg-teal-700 text-white rounded-md transition-colors">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    // Tambah fasilitas baru
    function tambahFasilitas() {
        const container = document.getElementById('fasilitasContainer');
        const fasilitasList = @json($fasilitas);
        let options = '';
        fasilitasList.forEach(function(item) {
            options += `<option value="${item.id}">${item.nama}</option>`;
        });

        const newFasilitas = document.createElement('div');
        newFasilitas.className = 'fasilitas-item flex items-center space-x-3 mb-3';
        newFasilitas.innerHTML = `
            <select name="fasilitas[]" class="px-3 py-2 border border-gray-300 rounded-md">${options}</select>
            <input type="number" name="jumlah[]" value="1" min="1" class="w-16 px-3 py-2 border border-gray-300 rounded-md text-center" />
            <button type="button" onclick="hapusFasilitas(this)" class="px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors">Hapus</button>
        `;
        container.appendChild(newFasilitas);
    }

    // Hapus fasilitas
    function hapusFasilitas(button) {
        const fasilitasItem = button.closest('.fasilitas-item');
        const container = document.getElementById('fasilitasContainer');
        if (container.children.length > 1) {
            fasilitasItem.remove();
        } else {
            alert('Minimal harus ada 1 fasilitas!');
        }
    }
</script>
@endsection
