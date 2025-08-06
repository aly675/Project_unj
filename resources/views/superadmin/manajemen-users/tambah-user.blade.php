@extends('layouts.super-admin-layout')

@section('title', 'Tambah User')

@section('main')

          <h1 class="text-xl font-semibold text-gray-800 mb-4">Form Pendaftaran Pengguna</h1>

      <!-- Form Card -->
      <div class="bg-white rounded-lg shadow-sm border pt-1 px-6 pb-6">
        <form method="post" action="{{route("superadmin.user-submit")}}" enctype="multipart/form-data" class="space-y-5">
            @csrf
          <!-- Nama -->
          <div>
            <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
            <input type="text" id="nama" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
          </div>

          <!-- Password -->
          <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" id="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
          </div>

          <!-- Email -->
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" id="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
          </div>

          <!-- Role -->
          <div>
            <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
            <div class="relative">
              <select id="role" name="role" class="appearance-none w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
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
          <div>
                <label for="gambar-ruangan" class="block text-sm font-medium text-gray-700 mb-1">
                    Gambar Profil
                </label>
                <input
                    type="file"
                    id="gambar-ruangan"
                    name="image"
                    accept=".jpeg,.jpg,.png"
                    onchange="previewImage(this)"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500
                file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100"
                >
                <p class="text-xs text-gray-500 mt-1">
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


          <!-- Buttons -->
          <div class="flex justify-end space-x-3 pt-5">
            <button type="button" onclick="confirmCancel()" class="px-6 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition-colors">
              Batal
            </button>
            <button type="submit" class="px-6 py-2 bg-teal-600 hover:bg-teal-700 text-white rounded-md transition-colors">
              Simpan
            </button>
          </div>
        </form>
      </div>

@endsection

@section('js')
<script>
        function confirmCancel() {
                    Swal.fire({
                        title: 'Batalkan Form?',
                        text: "Data yang sudah diisi akan hilang.",
                        icon: 'warning',
                        showCancelButton: true,
                        showCancelButton: true,
                        confirmButtonColor: '#6c757d', // Tombol batal: abu-abu
                        cancelButtonColor: '#3085d6',  // Tombol kembali: biru muda
                        confirmButtonText: 'Ya, batalkan',
                        cancelButtonText: 'Kembali',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('superadmin.manajemen-pengguna-batal') }}";
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
</script>
@endsection
