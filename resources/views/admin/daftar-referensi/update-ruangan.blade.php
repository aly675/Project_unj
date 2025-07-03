<form class="space-y-6" id="roomForm">
    @csrf
    <div>
        <label for="nomor-ruangan" class="block text-sm font-medium text-gray-700 mb-2">
            Nomor Ruangan
        </label>
        <input
            type="text"
            id="nomor-ruangan"
            name="nomor_ruangan"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pustikom-teal focus:border-transparent"
        >
    </div>

    <div>
        <label for="nama-ruangan" class="block text-sm font-medium text-gray-700 mb-2">
            Nama Ruangan
        </label>
        <input
            type="text"
            id="nama-ruangan"
            name="nama_ruangan"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pustikom-teal focus:border-transparent"
        >
    </div>

    <div>
        <label for="kapasitas" class="block text-sm font-medium text-gray-700 mb-2">
            Kapasitas Orang
        </label>
        <input
            type="number"
            id="kapasitas"
            name="kapasitas"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pustikom-teal focus:border-transparent"
        >
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            Pilih Fasilitas:
        </label>
        <div id="fasilitasContainer">
            <div class="fasilitas-item flex items-center space-x-3 mb-3">
                <select name="fasilitas[]" class="w-64 px-3 py-2 border border-gray-300 rounded-md">
                    @foreach ($listFasilitas as $fasilitas)
                        <option value="{{ $fasilitas->id }}">{{ $fasilitas->nama }}</option>
                    @endforeach
                </select>
                <div class="relative">
                    <input
                        type="number"
                        value="1"
                        min="1"
                        name="jumlah[]"
                        class="w-16 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pustikom-teal focus:border-transparent text-center"
                    >
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
            </div>
        </div>
        <button
            type="button"
            onclick="tambahFasilitas()"
            class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors"
        >
            Tambah Fasilitas
        </button>
    </div>

    <div>
        <label for="gambar-ruangan" class="block text-sm font-medium text-gray-700 mb-2">
            Gambar Ruangan
        </label>
        <div class="border-2 border-dashed border-gray-300 rounded-md p-4">
            <input
                type="file"
                id="gambar-ruangan"
                name="gambar_ruangan"
                accept=".jpeg,.jpg,.png"
                onchange="previewImage(this)"
                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100"
            >
        </div>
        <p class="text-xs text-gray-500 mt-2">
            Format file yang diperbolehkan: *.jpeg, *.jpg, *.png dengan ukuran maksimum 2 MB.
        </p>

        <div id="imagePreview" class="mt-4 hidden">
            <p class="text-sm font-medium text-gray-700 mb-2">Preview Gambar:</p>
            <div class="relative inline-block">
                <img id="previewImg" src="/placeholder.svg" alt="Preview" class="max-w-xs max-h-48 rounded-md border">
                <button
                    type="button"
                    onclick="removeImage()"
                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600"
                >
                    &times;
                </button>
            </div>
        </div>
    </div>

    <div class="flex justify-end space-x-3 pt-6">
        <button
            type="button"
            onclick="batalForm()"
            class="px-6 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors"
        >
            Batal
        </button>
        <button
            type="button"
            onclick="simpanForm()"
            class="px-6 py-2 bg-teal-600 hover:bg-teal-700 text-white rounded-md transition-colors"
        >
            Simpan
        </button>
    </div>
</form>

<script>
    // These functions need to be defined in the main script or accessible globally
    // if this partial is loaded dynamically.
    // Assuming 'listFasilitas' is passed from the parent view.
    const fasilitasList = @json($listFasilitas ?? []); // Ensure listFasilitas is available or default to empty array

    function simpanForm() {
        const form = document.getElementById('roomForm');
        const formData = new FormData(form);

        const nomorRuangan = document.getElementById('nomor-ruangan').value.trim();
        const namaRuangan = document.getElementById('nama-ruangan').value.trim();
        const kapasitas = document.getElementById('kapasitas').value.trim();

        if (!nomorRuangan || !namaRuangan || !kapasitas) {
            Swal.fire({
                toast: true,
                position: 'bottom-end',
                icon: 'warning',
                title: 'Mohon lengkapi semua field wajib!',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true
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


        const fasilitasItems = document.querySelectorAll('#fasilitasContainer .fasilitas-item');
        const selectedFacilities = [];
        const selectedQuantities = [];

        fasilitasItems.forEach(item => {
            const selectElement = item.querySelector('select');
            const inputElement = item.querySelector('input[type="number"]');
            if (selectElement && inputElement) {
                selectedFacilities.push(selectElement.value);
                selectedQuantities.push(inputElement.value);
            }
        });

        formData.delete('fasilitas[]');
        formData.delete('jumlah[]');
        selectedFacilities.forEach(value => formData.append('fasilitas[]', value));
        selectedQuantities.forEach(value => formData.append('jumlah[]', value));

        const url = formEditId
            ? `/admin/daftar-referensi/update/ruangan/${formEditId}`
            : '/admin/daftar-referensi/tambah-ruangan/submit';

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
        .then(response => response.json())
        .then(res => {
            const modal = document.getElementById('modalTambahRuangan');
            modal.classList.add('hidden');

            Swal.fire({
                toast: true,
                position: 'bottom-end',
                icon: 'success',
                title: res.message,
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true
            });

            fetchRuangans();

            // Reset form dan formEditId
            form.reset();
            removeImage();
            formEditId = null;
        })
        .catch(error => {
            Swal.fire({
                toast: true,
                position: 'bottom-end',
                icon: 'error',
                title: error.message || 'Terjadi kesalahan saat menyimpan data',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true
            });
        });
    }





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
        } else {
             removeImage();
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

                // Reset facilities to initial state (only 1 facility)
                const container = document.getElementById('fasilitasContainer');
                container.innerHTML = ''; // Clear all

                // Add back the default empty facility
                const div = document.createElement('div');
                div.className = 'fasilitas-item flex items-center space-x-3 mb-3';
                div.innerHTML = `
                    <select name="fasilitas[]" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pustikom-teal focus:border-transparent">
                        ${fasilitasList.map(fasilitas => `<option value="${fasilitas.id}">${fasilitas.nama}</option>`).join('')}
                    </select>
                    <div class="relative">
                        <input
                            type="number"
                            value="1"
                            min="1"
                            name="jumlah[]"
                            class="w-16 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pustikom-teal focus:border-transparent text-center"
                        >
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
                div.querySelector('select').selectedIndex = 0; // Set to the first option
                div.querySelector('input[type="number"]').value = 1;


                // Tutup modal dan notifikasi sukses
                const modal = document.getElementById('modalTambahRuangan');
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');

                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    icon: 'success',
                    title: 'Berhasil Membatalkan',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true
                });
            }
        });
    }
</script>
