<form id="form-user" enctype="multipart/form-data" method="POST">
  @csrf
          <!-- Nama -->
          <div>
            <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
            <input type="text" id="nama" name="name" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-600">
          </div>

          <!-- Password -->
          <div class="mt-5">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" id="password" name="password" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-600">
          </div>

          <!-- Email -->
          <div class="mt-5">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-600">
          </div>

          <!-- Role -->
          <div class="mt-5">
            <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
            <div class="relative">
              <select id="role" name="role" class="appearance-none w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-600">
                <option value="admin">Admin</option>
                <option value="superadmin">Super Admin</option>
                <option value="kepalaupt">Kepala UPT</option>
                <option value="supkorla">SUP-Korla</option>
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
              </div>
            </div>
          </div>

          <!-- Gambar Profil -->
          <div class="mt-5">
                <label for="gambar-ruangan" class="block text-sm font-medium text-gray-700 mb-1">
                    Gambar Profil
                </label>
                <input
                    type="file"
                    id="gambar-ruangan"
                    name="image"
                    accept=".jpeg,.jpg,.png"
                    onchange="previewImage(this)"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-teal-600"
                >
                <p class="text-xs text-gray-500 mt-1">
                    Format file yang diperbolehkan: *.jpeg, *.jpg, *.png dengan ukuran maksimum 2 MB.
                </p>
                  <!-- Preview Image Container -->
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

          <!-- Buttons -->
          <div class="flex justify-end gap-3 pt-6">
           <button type="button"
                    onclick="confirmCancel()"
                    class="bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition-colors px-6 py-2 rounded-md">
                Batal
            </button>
            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-md">
              Simpan
            </button>
          </div>
        </form>


        <script>

                // Reusable toast
                function showToast(icon, title) {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-end',
                        icon: icon,
                        title: title,
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                }

                function confirmCancel() {
                    Swal.fire({
                        title: 'Batalkan Perubahan?',
                        text: "Semua perubahan yang sudah diisi akan hilang.",
                        icon: 'warning',
                        confirmButtonColor: '#6c757d', // Tombol batal: abu-abu
                        cancelButtonColor: '#3085d6',  // Tombol kembali: biru muda
                        showCancelButton: true,
                        confirmButtonText: 'Ya, batalkan',
                        cancelButtonText: 'Kembali',
                        reverseButtons:true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            tutupModalRuangan();
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

                document.getElementById('form-user').addEventListener('submit', function (e) {
                    e.preventDefault();

                    const form = e.target;
                    const id = form.dataset.id;
                    const formData = new FormData(form);

                    const updateUrl = `{{ route('superadmin.update-submit', ':id') }}`.replace(':id', id);

                    fetch(updateUrl, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        }
                    })
                    .then(async response => {
                        if (!response.ok) {
                            const text = await response.text();
                            try {
                                const error = JSON.parse(text);
                                console.error('Gagal update:', error);
                                showToast('error', error.message || 'Gagal update user');
                            } catch (e) {
                                console.error('Gagal parsing JSON:', text);
                                showToast('error', 'Response server bukan JSON');
                            }
                        } else {
                            const data = await response.json();
                            showToast('success', data.message || 'User berhasil diperbarui');

                            // Jika kamu ingin langsung update row di tabel secara live,
                            // fetch ulang data JSON dan re-render tabel,
                            // atau ubah langsung baris user yang sedang diedit jika ingin real-time update.
                            tutupModalRuangan();
                            fetchUsers(); // Pastikan fetchUsers() sudah kamu buat untuk load ulang tabel
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        showToast('error', 'Terjadi kesalahan koneksi');
                    });
                });


</script>
