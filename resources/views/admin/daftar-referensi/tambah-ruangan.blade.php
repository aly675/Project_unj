@extends('layouts.admin-layout')

@section('title', 'Tambah Ruangan')

@section('main')
<div class="max-w">
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
                    onchange="previewImage(this)"
                    class="w-full text-sm text-gray-500"
                >
                <p class="text-xs text-gray-500 mt-2">
                    Format file yang diperbolehkan: *.jpeg, *.jpg, *.png dengan ukuran maksimum 2 MB.
                </p>
                  <!-- Preview Image Container -->
                <div id="imagePreview" class="mt-4 hidden">
                    <p class="text-sm font-medium text-gray-700 mb-2">Preview Gambar:</p>
                    <div class="relative inline-block">
                        <img id="previewImg" src="/placeholder.svg" alt="Preview" class="max-w-xs max-h-48 rounded-md border">
                        <button
                            type="button"
                            onclick="removeImage()"
                            class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600"
                        >
                            ×
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-3 pt-6">
                <a href="{{ route('admin.daftar-referensi-page') }}" class="px-6 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors">Batal</a>
                <button type="submit" onclick="simpanForm()" class="px-6 py-2 bg-teal-600 hover:bg-teal-700 text-white rounded-md transition-colors">Simpan</button>
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

       // Preview gambar ketika file dipilih
        function previewImage(input) {
            const file = input.files[0];
            const preview = document.getElementById('imagePreview');
            const previewImg = document.getElementById('previewImg');

            if (file) {
                // Validasi ukuran file (2MB = 2 * 1024 * 1024 bytes)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar! Maksimum 2MB.');
                    input.value = '';
                    return;
                }

                // Validasi tipe file
                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Format file tidak didukung! Gunakan JPEG, JPG, atau PNG.');
                    input.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        }

        // Hapus preview gambar
        function removeImage() {
            document.getElementById('gambar-ruangan').value = '';
            document.getElementById('imagePreview').classList.add('hidden');
            document.getElementById('previewImg').src = '';
        }

          function simpanForm() {
            const form = document.getElementById('roomForm');
            const formData = new FormData(form);

            // Validasi form
            const nomorRuangan = document.getElementById('nomor-ruangan').value;
            const namaRuangan = document.getElementById('nama-ruangan').value;
            const kapasitas = document.getElementById('kapasitas').value;
            const gambarRuangan = document.getElementById('gambar-ruangan').value;

            if (!nomorRuangan || !namaRuangan || !kapasitas || !gambarRuangan) {
                alert('Mohon lengkapi semua field yang wajib diisi!');
                return;
            }

            // Kumpulkan data fasilitas
            const fasilitasItems = document.querySelectorAll('.fasilitas-item');
            const fasilitas = [];

            fasilitasItems.forEach(item => {
                const select = item.querySelector('select');
                const quantity = item.querySelector('input[type="number"]');
                fasilitas.push({
                    nama: select.value,
                    jumlah: quantity.value
                });
            });

            // Simulasi penyimpanan data
            console.log('Data yang akan disimpan:', {
                nomorRuangan: nomorRuangan,
                namaRuangan: namaRuangan,
                kapasitas: kapasitas,
                fasilitas: fasilitas,
                gambar: document.getElementById('gambar-ruangan').files[0]
            });

            alert('Data ruangan berhasil disimpan!');
        }
</script>
@endsection
