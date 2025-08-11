<form id="roomForm">
    @csrf
    <div>
        <label for="nomor-ruangan" class="block text-sm font-medium text-gray-700 mb-1">
            Nomor Ruangan
        </label>
        <input
            type="text"
            id="nomor-ruangan"
            name="nomor_ruangan"
            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-600"
        >
    </div>

    <div class="mt-5">
        <label for="nama-ruangan" class="block text-sm font-medium text-gray-700 mb-1">
            Nama Ruangan
        </label>
        <input
            type="text"
            id="nama-ruangan"
            name="nama_ruangan"
            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-600"
        >
    </div>

    <div class="mt-5">
        <label for="kapasitas" class="block text-sm font-medium text-gray-700 mb-1">
            Kapasitas Orang
        </label>
        <input
            type="number"
            id="kapasitas"
            name="kapasitas"
            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-600"
        >
    </div>

    <div class="mt-5">
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Pilih Fasilitas:
        </label>
        <div id="fasilitasContainer">
            <div class="fasilitas-item flex items-center space-x-3 mb-3">
                <div class="relative w-64">
                <select
                    name="fasilitas[]"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-700"
                >
                    @foreach ($listFasilitas as $fasilitas)
                    <option value="{{ $fasilitas->id }}">{{ $fasilitas->nama }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
                </div>
                <div class="relative">
                    <input
                        type="number"
                        value="1"
                        min="1"
                        name="jumlah[]"
                        class="appearance-none w-16 px-3 py-2 border border-gray-300 rounded-md outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                    >
                    <div class="absolute right-1 top-1/2 transform -translate-y-1/2 flex flex-col">
                        <button type="button" onclick="incrementQuantity(this)" class="text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                        <button type="button" onclick="decrementQuantity(this)" class="text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
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

    <div class="mt-5">
        <label for="gambar-ruangan" class="block text-sm font-medium text-gray-700 mb-1">
            Gambar Ruangan
        </label>
            <input
                type="file"
                id="gambar-ruangan"
                name="gambar_ruangan"
                accept=".jpeg,.jpg,.png"
                onchange="previewImage(this)"
                class="w-full border border-gray-300 rounded-md px-3 py-2 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-teal-600"
            />
        <p class="text-xs text-gray-500 mt-1">
            Format file yang diperbolehkan: *.jpeg, *.jpg, *.png dengan ukuran maksimum 2 MB.
        </p>

        <div id="imagePreview" class="mt-4 hidden">
            <p class="text-sm font-medium text-gray-700 mb-1">Preview Gambar:</p>
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

    <div class="flex justify-end gap-3 pt-6">
        <button
            type="button"
            onclick="batalForm()"
            class="bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition-colors px-6 py-2 rounded-md"
        >
            Batal
        </button>
        <button
            type="button"
            onclick="simpanForm()"
            class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-md"
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
            title: 'Batalkan Perubahan?',
            text: "Semua perubahan yang sudah diisi akan hilang.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6c757d',   // Abu-abu → batal isi data
            cancelButtonColor: '#3085d6',    // Biru terang → kembali
            confirmButtonText: 'Ya, batalkan',
            cancelButtonText: 'Kembali',
            reverseButtons: true
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
                    icon: 'info',
                    title: 'Perubahan dibatalkan.',
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                    customClass: {
                    popup: 'swal-toast-fixed-width'
                }
                });
            }
        });
    }
</script>
