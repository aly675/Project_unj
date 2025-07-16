@extends('layouts.super-admin-layout')

@section('title', 'Manejemen Users')

@section('style')
    <style>
               /* Modern scrollbar */
        .scrollbar-modern {
        scrollbar-width: thin;              /* Firefox */
        scrollbar-color: #94a3b8 #f1f5f9;   /* thumb color & track color */
        }

        /* Chrome, Edge, Safari */
        .scrollbar-modern::-webkit-scrollbar {
        width: 6px;                         /* scroll bar width */
        }

        .scrollbar-modern::-webkit-scrollbar-track {
        background: #f1f5f9;                /* light gray */
        border-radius: 100px;
        }

        .scrollbar-modern::-webkit-scrollbar-thumb {
        background-color: #94a3b8;          /* slate-400 */
        border-radius: 100px;
        border: 2px solid transparent;      /* spacing */
        background-clip: content-box;
        }

    </style>
@endsection

@section('main')

                <h1 class="text-2xl font-bold text-gray-900 mb-4 sm:mb-0">Manajemen Pengguna</h1>

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                    <div class="flex gap-4">
                        <div class="relative">
                            <input type="text" placeholder="Search" class="pl-8 pr-4 py-2 border rounded-lg text-sm w-64">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 absolute left-2.5 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-gray-500">Sort by:</span>
                            <select class="border border-gray-300 rounded px-2 py-1 text-sm">
                                <option>10</option>
                                <option>25</option>
                                <option>50</option> 
                            </select>
                            <button class="flex items-center gap-1 text-sm">
                            Newest
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                            </button>
                        </div>
                    </div>
                    <a href="{{route('superadmin.tambah-user-page')}}" class="bg-teal-custom hover:bg-teal-800 bg-teal-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                        Tambah Data
                    </a>
                </div>

                <!-- Table Container -->
                <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                    <!-- Desktop Table -->
                    <div class="hidden lg:block overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b">
                                <tr>
                                    <th class="text-left py-4 px-6 font-medium text-gray-700 uppercase text-xs tracking-wider">Nama</th>
                                    <th class="text-left py-4 px-6 font-medium text-gray-700 uppercase text-xs tracking-wider">Email</th>
                                    <th class="text-left py-4 px-6 font-medium text-gray-700 uppercase text-xs tracking-wider">Role</th>
                                    <th class="text-left py-4 px-6 font-medium text-gray-700 uppercase text-xs tracking-wider">Status</th>
                                    <th class="text-left py-4 px-6 font-medium text-gray-700 uppercase text-xs tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody id="user-table-body"></tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="bg-white px-6 py-4 border-t flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex items-center space-x-2 mb-4 sm:mb-0">
                            <span class="text-sm text-gray-600">Showing</span>
                            <select class="border border-gray-300 rounded px-2 py-1 text-sm">
                                <option>10</option>
                                <option>25</option>
                                <option>50</option>
                            </select>
                            <span class="text-sm text-gray-600">of 50</span>
                        </div>

                        <div class="flex items-center space-x-1">
                            <button class="p-2 text-gray-400 hover:text-gray-600 disabled:opacity-50" disabled>
                                <i data-lucide="chevron-left" class="w-4 h-4"></i>
                            </button>
                            <button class="px-3 py-1 bg-teal-custom text-white rounded text-sm">1</button>
                            <button class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded text-sm">2</button>
                            <button class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded text-sm">3</button>
                            <button class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded text-sm">4</button>
                            <button class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded text-sm">5</button>
                            <button class="p-2 text-gray-600 hover:text-gray-800">
                                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                </div>


    <!-- Modal Tambah Ruangan -->
    <div id="modal-edit-user"
        class="fixed inset-0 z-50 flex hidden items-center justify-center bg-black bg-opacity-0 opacity-0 scale-95
                transition-all duration-300 ease-out">
        <div class="relative w-full max-w-xl bg-white rounded-lg shadow-xl scale-95 transition-transform duration-300">
            <!-- Header -->
            <div class="bg-teal-800 text-white px-6 py-4 rounded-t-lg flex justify-between items-center">
                <h1 class="text-xl font-semibold">Form Edit Ruangan</h1>
                <button onclick="tutupModalRuangan()" class="text-white text-2xl hover:text-gray-300">&times;</button>
            </div>

            <!-- Konten -->
            <div class="max-h-[100vh] overflow-y-auto scrollbar-modern p-2">
                <div class="bg-white rounded-lg border p-6">
                    @include('superadmin.manajemen-users.update-user')
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')
   <script>
        lucide.createIcons();

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

        const userTableBody = document.getElementById('user-table-body');
        const userJsonUrl = "{{ route('superadmin.users-json') }}";
        let currentPage = 1;
        let perPage = 10;

        function fetchUsers() {
            fetch(`${userJsonUrl}?page=${currentPage}&perPage=${perPage}`)
                .then(response => response.json())
                .then(data => {
                    userTableBody.innerHTML = '';
                    data.data.forEach(user => {
                        const tr = document.createElement('tr');
                        tr.className = 'hover:bg-gray-50';
                        tr.id = `user-row-${user.id}`;

                        tr.innerHTML = `
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-full overflow-hidden">
                                        <img src="${user.image ? '/storage/' + user.image : '/assets/images/icon/none-profile-icon.svg'}" alt="Foto Profil" class="object-cover w-full h-full">
                                    </div>
                                    <span class="font-medium text-gray-900">${user.name}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-gray-600">${user.email}</td>
                            <td class="py-4 px-6 text-gray-600">${user.role}</td>
                            <td class="py-4 px-6">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input
                                        type="checkbox"
                                        class="sr-only toggle-status peer"
                                        data-id="${user.id}"
                                        ${user.status === 'aktif' ? 'checked' : ''}
                                    >
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full
                                            peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                            after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-custom">
                                    </div>
                                    <span class="status-text ml-3 text-sm font-medium ${user.status === 'aktif' ? 'text-teal-custom' : 'text-red-500'}">
                                        ${user.status === 'aktif' ? 'ON' : 'OFF'}
                                    </span>
                                </label>
                            </td>
                            <td class="py-4 px-6">
                                <button onclick="bukaModalRuangan(this)"
                                    data-user='${JSON.stringify(user)}'
                                    class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg">
                                    <img src="/assets/images/icon/action-edit-icon.svg" alt="Edit action icon"/>
                                </button>
                                <button
                                    type="button"
                                    class="btn-delete-user p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                    data-id="${user.id}"
                                    data-url="/superadmin/manajemen-users/delete/user/${user.id}"
                                >
                                    <img src="/assets/images/icon/action-delete-icon.svg" alt="Delete action icon"/>
                                </button>
                            </td>
                        `;
                        userTableBody.appendChild(tr);
                    });
                    attachToggleStatusListeners();
                })
                .catch(error => console.error('Error fetching users:', error));
        }

        // Inisialisasi fetch saat halaman load
        document.addEventListener('DOMContentLoaded', fetchUsers);

        function attachToggleStatusListeners() {
            document.querySelectorAll('.toggle-status').forEach(checkbox => {
                checkbox.addEventListener('change', function (e) {
                    const userId = this.getAttribute('data-id');
                    const statusText = this.parentElement.querySelector('.status-text');
                    const isChecked = this.checked;

                    // Tahan perubahan UI dulu
                    this.checked = !isChecked;

                    Swal.fire({
                        title: 'Konfirmasi',
                        text: 'Apakah Anda yakin ingin mengubah status user ini?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, ubah!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch("{{ route('superadmin.toggle-status') }}", {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ id: userId })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    statusText.textContent = data.status;
                                    statusText.className = `status-text ml-3 text-sm font-medium ${data.class}`;
                                    this.checked = data.status === 'ON';
                                    showToast('success', 'Status user berhasil diubah');
                                } else {
                                    showToast('error', 'Gagal Mengubah Status');
                                }
                                })
                                .catch(() => {
                                    showToast('error', 'Terjadi kesalahan server');
                                });
                        }
                    });
                });
            });
        }

        // document.querySelectorAll('.btn-delete-user').forEach(button => {
        //     button.addEventListener('click', function () {
        //         const userId = this.getAttribute('data-id');
        //         const deleteUrl = this.getAttribute('data-url');
        //         const row = document.getElementById(`user-row-${userId}`);

        //         Swal.fire({
        //             title: 'Yakin mau hapus?',
        //             text: 'Data user akan dihapus permanen!',
        //             icon: 'warning',
        //             showCancelButton: true,
        //             confirmButtonColor: '#e3342f',
        //             cancelButtonColor: '#6c757d',
        //             confirmButtonText: 'Ya, hapus!',
        //             cancelButtonText: 'Batal'
        //         }).then((result) => {
        //             if (result.isConfirmed) {
        //                 fetch(deleteUrl, {
        //                     method: 'DELETE',
        //                     headers: {
        //                         'X-CSRF-TOKEN': '{{ csrf_token() }}',
        //                         'Content-Type': 'application/json'
        //                     }
        //                 })
        //                 .then(res => res.json())
        //                 .then(data => {
        //                     if (data.success) {
        //                         row.remove(); // Hapus baris user
        //                         Swal.fire('Dihapus!', 'User berhasil dihapus.', 'success');
        //                     } else {
        //                         Swal.fire('Gagal', 'Terjadi kesalahan saat menghapus.', 'error');
        //                     }
        //                 })
        //                 .catch(() => {
        //                     Swal.fire('Error', 'Server tidak merespons.', 'error');
        //                 });
        //             }
        //         });
        //     });
        // });

        document.addEventListener('click', function (e) {
            if (e.target.closest('.btn-delete-user')) {
                const button = e.target.closest('.btn-delete-user');
                const userId = button.getAttribute('data-id');
                const deleteUrl = button.getAttribute('data-url');
                const row = document.getElementById(`user-row-${userId}`);

                Swal.fire({
                    title: 'Yakin mau hapus?',
                    text: 'Data user akan dihapus permanen!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e3342f',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(deleteUrl, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                row.remove();
                                showToast('success', 'User Berhasil Dihapus');
                            } else {
                                showToast('error', 'Gagal Mengahapus User');
                            }
                        })
                        .catch(() => {
                            showToast('error', 'Server Tidak Merespons');
                        });
                    }
                });
            }
        });



    function bukaModalRuangan(button) {
        const modal = document.getElementById('modal-edit-user');
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.add('opacity-100', 'scale-100', 'bg-opacity-50');
            modal.classList.remove('opacity-0', 'scale-95', 'bg-opacity-0');
        }, 10); // delay kecil agar transisi berjalan

        const data = JSON.parse(button.getAttribute('data-user'));

        document.getElementById('nama').value = data.name;
        document.getElementById('email').value = data.email;
        document.getElementById('role').value = data.role;

        // Optional: Untuk menyimpan ID user yang akan diupdate
        document.getElementById('form-user').dataset.id = data.id;

        // Jika ada gambar, tampilkan
        if (data.image) {
            const preview = document.getElementById('imagePreview');
            const previewImg = document.getElementById('previewImg');
            previewImg.src = `/storage/${data.image}`; // sesuaikan path sesuai storage kamu
            preview.classList.remove('hidden');
        }

        // Tampilkan modal (gunakan plugin/modal toggle kalau pakai misalnya Alpine.js atau Tailwind UI)
        // contoh manual:
        document.getElementById('modal-edit-user').classList.remove('hidden');
    }
        function tutupModalRuangan() {
            const modal = document.getElementById('modal-edit-user');
            modal.classList.remove('opacity-100', 'scale-100', 'bg-opacity-50');
            modal.classList.add('opacity-0', 'scale-95', 'bg-opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300); // sesuai dengan durasi transition
        }


   </script>
@endsection
