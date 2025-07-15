@extends('layouts.admin-layout')

@section('title', 'Tambah Ruangan')

@section('main')
<div class="max-w mx-auto">
  <h1 class="text-xl font-semibold text-gray-800 mb-4">
    Form Input Ruangan
  </h1>

  <div class="bg-white rounded-lg shadow-sm border pt-1 px-6 pb-6">
    <form
      id="roomForm"
      action="{{ route('tambah.ruangan') }}"
      method="POST"
      enctype="multipart/form-data"
      class="space-y-5"
    >
      @csrf

      <!-- Nomor Ruangan -->
      <div>
        <label for="nomor-ruangan" class="block text-sm font-medium text-gray-700 mb-1">
          Nomor Ruangan
        </label>
        <input
          type="text"
          id="nomor-ruangan"
          name="nomor_ruangan"
          value="{{ old('nomor_ruangan') }}"
          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
        >
      </div>

      <!-- Nama Ruangan -->
      <div>
        <label for="nama-ruangan" class="block text-sm font-medium text-gray-700 mb-1">
          Nama Ruangan
        </label>
        <input
          type="text"
          id="nama-ruangan"
          name="nama_ruangan"
          value="{{ old('nama_ruangan') }}"
          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
        >
      </div>

      <!-- Kapasitas Orang -->
      <div>
        <label for="kapasitas" class="block text-sm font-medium text-gray-700 mb-1">
          Kapasitas Orang
        </label>
        <input
          type="number"
          id="kapasitas"
          name="kapasitas"
          value="{{ old('kapasitas') }}"
          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
        >
      </div>

      <!-- Pilih Fasilitas -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
          Pilih Fasilitas:
        </label>
        <div id="fasilitasContainer">
  <div class="fasilitas-item flex items-center space-x-3 mb-2">
    <div class="relative w-64">
      <select
        name="fasilitas[]"
        class="appearance-none truncate px-3 py-2 pr-10 border border-gray-300 rounded-md w-full
               focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
        @foreach($fasilitas as $item)
          <option value="{{ $item->id }}">{{ $item->nama }}</option>
        @endforeach
      </select>
      <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
        <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </div>
    </div>

    <input
      type="number"
      name="jumlah[]"
      value="1"
      min="1"
      class="w-16 px-3 py-2 border border-gray-300 rounded-md text-center
             focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
    />

    <button
      type="button"
      onclick="hapusFasilitas(this)"
      class="px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors"
    >
      Hapus
    </button>
  </div>
</div>

        <button
          type="button"
          onclick="tambahFasilitas()"
          class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors"
        >
          Tambah Fasilitas
        </button>
      </div>

      <!-- Gambar Ruangan -->
      <div>
        <label for="gambar-ruangan" class="block text-sm font-medium text-gray-700 mb-1">
          Gambar Ruangan
        </label>
        <input
        type="file"
        id="gambar-ruangan"
        name="gambar_ruangan"
        accept=".jpeg,.jpg,.png"
        onchange="previewImage(this)"
        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500
                file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100"
        />
        <p class="text-xs text-gray-500 mt-1">
        Format file: *.jpeg, *.jpg, *.png (maks 2 MB)
        </p>


        <!-- Preview Image Container -->
        <div id="imagePreview" class="mt-4 hidden">
          <p class="text-sm font-medium text-gray-700 mb-1">Preview Gambar:</p>
          <div class="relative inline-block">
            <img
              id="previewImg"
              src="/placeholder.svg"
              alt="Preview"
              class="max-w-xs max-h-48 rounded-md border"
            >
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

      <!-- Action Buttons -->
      <div class="flex justify-end space-x-3 pt-5">
        <button
          type="button"
          onclick="batalForm()"
          class="px-6 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition-colors"
        >
          Batal
        </button>
        <button
          type="submit"
          class="px-6 py-2 bg-teal-600 hover:bg-teal-700 text-white rounded-md transition-colors"
        >
          Simpan
        </button>
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

             // ✅ Cek semua jumlah fasilitas harus >= 1
            const jumlahInputs = document.querySelectorAll('input[name="jumlah[]"]');
            for (let input of jumlahInputs) {
                if (parseInt(input.value) < 1 || isNaN(parseInt(input.value))) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Jumlah Fasilitas Tidak Valid!',
                        text: 'Jumlah fasilitas tidak boleh kurang dari 1.'
                    });
                    return;
                }
            }

            document.addEventListener('input', function(e) {
                if (e.target.matches('input[name="jumlah[]"]')) {
                    if (e.target.value === '' || parseInt(e.target.value) < 1) {
                        e.target.value = 1;
                    }
                }
            });


            this.submit(); // ini submit default baru dipanggil setelah validasi
        });

        const fasilitasList = @json($fasilitas);

    // Tambah fasilitas baru
    function tambahFasilitas() {
        const container = document.getElementById('fasilitasContainer');

        // Ambil semua fasilitas yang sudah dipilih
        const selectedValues = Array.from(document.querySelectorAll('select[name="fasilitas[]"]'))
            .map(select => select.value);

        // Filter fasilitas yang belum dipakai
        const availableOptions = fasilitasList.filter(item => !selectedValues.includes(String(item.id)));

        // Cegah tambah jika sudah habis
        if (availableOptions.length === 0) {
            Swal.fire({
                icon: 'info',
                title: 'Semua fasilitas sudah dipilih!',
                text: 'Tidak ada lagi fasilitas yang bisa ditambahkan.',
                confirmButtonColor: '#3085d6'
            });
            return;
        }

        // Bangun opsi <option>
        let options = '';
        availableOptions.forEach(item => {
            options += `<option value="${item.id}">${item.nama}</option>`;
        });

        // Buat elemen baru
        const newFasilitas = document.createElement('div');
        newFasilitas.className = 'fasilitas-item flex items-center space-x-3 mb-3';
        newFasilitas.innerHTML = `
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
            <input type="number" name="jumlah[]" value="1" min="1" class="w-16 px-3 py-2 border border-gray-300 rounded-md text-center" />
            <button type="button" onclick="hapusFasilitas(this)" class="px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors">Hapus</button>
        `;
        container.appendChild(newFasilitas);
        updateOptions(); // supaya opsi lainnya juga update
    }

    function hapusFasilitas(button) {
        const container = document.getElementById('fasilitasContainer');
        const fasilitasItems = container.querySelectorAll('.fasilitas-item');

        if (fasilitasItems.length > 1) {
            button.closest('.fasilitas-item').remove();
            updateOptions(); // update semua dropdown setelah hapus
        } else {
            Swal.fire({
            icon: 'warning',
            title: 'Minimal 1 fasilitas diperlukan!',
            text: 'Setidaknya harus ada satu fasilitas yang dipilih.',
            confirmButtonColor: '#3085d6'
            });
        }
    }


    function updateOptions() {
        const allSelects = document.querySelectorAll('select[name="fasilitas[]"]');
        const selectedValues = Array.from(allSelects).map(select => select.value);

        allSelects.forEach(currentSelect => {
            const currentValue = currentSelect.value;
            currentSelect.innerHTML = '';

            fasilitasList.forEach(item => {
                if (!selectedValues.includes(String(item.id)) || item.id == currentValue) {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.textContent = item.nama;
                    if (item.id == currentValue) option.selected = true;
                    currentSelect.appendChild(option);
                }
            });
        });
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
            confirmButtonText: 'Ya, batalkan',
            cancelButtonText: 'Kembali',
            reverseButtons: true
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

                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Form telah dibatalkan.',
                        icon: 'success',
                        timer: 1500, // lama animasi, bisa disesuaikan
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = "{{ route('admin.daftar-referensi-page') }}";
                    });
            }
        });
    }

</script>
@endsection
