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
                <button type="button" onclick="batalForm()" class="px-6 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors">Batal</button>
                <button type="submit" class="px-6 py-2 bg-teal-600 hover:bg-teal-700 text-white rounded-md transition-colors">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>

    document.getElementById('roomForm').addEventListener('submit', function(e) {
            e.preventDefault();  // Ini kuncinya: cegah submit bawaan

            const nomorRuangan = document.getElementById('nomor-ruangan').value.trim();
            const namaRuangan = document.getElementById('nama-ruangan').value.trim();
            const kapasitas = document.getElementById('kapasitas').value.trim();
            const gambarRuangan = document.getElementById('gambar-ruangan').value;

            if (!nomorRuangan || !namaRuangan || !kapasitas || !gambarRuangan) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Belum Lengkap!',
                    text: 'Mohon lengkapi semua field yang wajib diisi!'
                });
                return;
            }

            // Kalau validasi lolos
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data berhasil disimpan!',
                timer: 2000,
                showConfirmButton: false
            });

            // Setelah validasi lolos, baru submit form ke server (manual)
            // Pilihan 1: submit manual pakai AJAX
            // Pilihan 2: submit manual pakai native form submit
            this.submit(); // ini submit default baru dipanggil setelah validasi
        });

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

              // Batal form
    function batalForm() {
        Swal.fire({
            title: 'Yakin ingin membatalkan?',
            text: "Semua data yang telah diisi akan hilang.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, batalkan',
            cancelButtonText: 'Kembali'
        }).then((result) => {
            if (result.isConfirmed) {
                // Reset form
                document.getElementById('roomForm').reset();

                // Reset preview gambar
                removeImage();

                // Reset fasilitas ke kondisi awal (hanya 1 fasilitas)
                const container = document.getElementById('fasilitasContainer');
                const fasilitasItems = container.querySelectorAll('.fasilitas-item');

                // Hapus semua fasilitas kecuali yang pertama
                for (let i = 1; i < fasilitasItems.length; i++) {
                    fasilitasItems[i].remove();
                }

                // Reset nilai fasilitas pertama
                const firstFasilitas = container.querySelector('.fasilitas-item');
                firstFasilitas.querySelector('select').selectedIndex = 0;
                firstFasilitas.querySelector('input[type="number"]').value = 1;

                    window.location.href = "{{ route('admin.daftar-referensi-page') }}";

                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Form telah dibatalkan.',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        });
    }

</script>
@endsection
