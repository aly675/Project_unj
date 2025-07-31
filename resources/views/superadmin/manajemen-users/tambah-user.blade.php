@extends('layouts.super-admin-layout')

@section('title', 'Tambah User')

@section('main')

          <h1 class="text-xl font-semibold text-gray-800 mb-4">Form Pendaftaran Pengguna</h1>

      <!-- Form Card -->
      <div class="bg-white rounded-lg shadow-sm p-6">
        <form method="post" action="{{route("superadmin.user-submit")}}" enctype="multipart/form-data">
            @csrf
          <!-- Nama -->
          <div class="mb-4">
            <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
            <input type="text" id="nama" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
          </div>

          <!-- Password -->
          <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" id="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
          </div>

          <!-- Email -->
          <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" id="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
          </div>

          <!-- Role -->
          <div class="mb-4">
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
          <div class="mb-6">
                <label for="gambar-ruangan" class="block text-sm font-medium text-gray-700 mb-2">
                    Gambar Ruangan
                </label>
                <input
                    type="file"
                    id="gambar-ruangan"
                    name="image"
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


          <!-- Buttons -->
          <div class="flex justify-end space-x-3">
            <button type="button" onclick="confirmCancel()" class="px-6 py-2 bg-red-600 text-white font-medium rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
              Batal
            </button>
            <button type="submit" class="px-6 py-2 bg-teal-700 text-white font-medium rounded-md hover:bg-teal-800 focus:outline-none focus:ring-2 focus:ring-teal-500">
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
                        title: 'Yakin ingin membatalkan?',
                        text: "Perubahan yang belum disimpan akan hilang.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, batalkan',
                        cancelButtonText: 'Kembali'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Contoh aksi: redirect atau reset form
                            // window.location.href = '/admin/dashboard-page'; // redirect
                            // atau reset form tertentu:
                            // document.getElementById('form-id').reset();
                            window.location.href = "{{ route('superadmin.manejemen-users-page') }}";

                            // Jika hanya ingin notifikasi saja:
                            Swal.fire({
                                icon: 'success',
                                title: 'Dibatalkan',
                                text: 'Aksi berhasil dibatalkan',
                                timer: 2000,
                                showConfirmButton: false
                            });

                            // Contoh redirect setelah sukses
                            setTimeout(() => {
                                window.history.back(); // atau ubah ke route tujuan
                            }, 1500);
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
