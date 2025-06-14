
                        <form class="space-y-6" id="roomForm">
                            <!-- Nomor Ruangan -->
                            <div>
                                <label for="nomor-ruangan" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nomor Ruangan
                                </label>
                                <input
                                    type="text"
                                    id="nomor-ruangan"
                                    name="nomor-ruangan"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pustikom-teal focus:border-transparent"
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
                                    name="nama-ruangan"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pustikom-teal focus:border-transparent"
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
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pustikom-teal focus:border-transparent"
                                >
                            </div>

                            <!-- Pilih Fasilitas -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Pilih Fasilitas:
                                </label>
                                <div id="fasilitasContainer">
                                    <!-- Fasilitas pertama (default) -->
                                    <div class="fasilitas-item flex items-center space-x-3 mb-3">
                                        <select class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pustikom-teal focus:border-transparent">
                                            <option>Screen Proyektor</option>
                                            <option>Whiteboard</option>
                                            <option>AC</option>
                                            <option>Sound System</option>
                                            <option>Komputer</option>
                                            <option>Meja</option>
                                            <option>Kursi</option>
                                        </select>
                                        <div class="relative">
                                            <input
                                                type="number"
                                                value="1"
                                                min="1"
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

                            <!-- Gambar Ruangan -->
                            <div>
                                <label for="gambar-ruangan" class="block text-sm font-medium text-gray-700 mb-2">
                                    Gambar Ruangan
                                </label>
                                <div class="border-2 border-dashed border-gray-300 rounded-md p-4">
                                    <input
                                        type="file"
                                        id="gambar-ruangan"
                                        name="gambar-ruangan"
                                        accept=".jpeg,.jpg,.png"
                                        onchange="previewImage(this)"
                                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100"
                                    >
                                </div>
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

                            <!-- Action Buttons -->
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

        // Tambah fasilitas baru
        function tambahFasilitas() {
            const container = document.getElementById('fasilitasContainer');
            const newFasilitas = document.createElement('div');
            newFasilitas.className = 'fasilitas-item flex items-center space-x-3 mb-3';
            newFasilitas.innerHTML = `
                <select class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pustikom-teal focus:border-transparent">
                    <option>Screen Proyektor</option>
                    <option>Whiteboard</option>
                    <option>AC</option>
                    <option>Sound System</option>
                    <option>Komputer</option>
                    <option>Meja</option>
                    <option>Kursi</option>
                </select>
                <div class="relative">
                    <input
                        type="number"
                        value="1"
                        min="1"
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
                <button
                    type="button"
                    onclick="hapusFasilitas(this)"
                    class="px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors"
                >
                    Hapus
                </button>
            `;
            container.appendChild(newFasilitas);
        }

        // Hapus fasilitas
        function hapusFasilitas(button) {
            const fasilitasItem = button.closest('.fasilitas-item');
            const container = document.getElementById('fasilitasContainer');

            // Pastikan minimal ada 1 fasilitas
            if (container.children.length > 1) {
                fasilitasItem.remove();
            } else {
                alert('Minimal harus ada 1 fasilitas!');
            }
        }

        // Increment quantity
        function incrementQuantity(button) {
            const input = button.closest('.relative').querySelector('input[type="number"]');
            input.value = parseInt(input.value) + 1;
        }

        // Decrement quantity
        function decrementQuantity(button) {
            const input = button.closest('.relative').querySelector('input[type="number"]');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }

        // Simpan form
        function simpanForm() {
            const form = document.getElementById('roomForm');
            const formData = new FormData(form);

            // Validasi form
            const nomorRuangan = document.getElementById('nomor-ruangan').value;
            const namaRuangan = document.getElementById('nama-ruangan').value;
            const kapasitas = document.getElementById('kapasitas').value;

            if (!nomorRuangan || !namaRuangan || !kapasitas) {
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

                // Tutup modal dan notifikasi sukses
                const modal = document.getElementById('modalTambahRuangan');
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');

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
