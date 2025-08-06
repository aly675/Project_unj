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

                <h1 class="text-2xl font-semibold text-gray-900 mb-6">Manajemen Pengguna</h1>

                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4 ">
                    <div class="flex gap-3 flex-1 max-w-md">
                        <div class="relative flex-1">
                            <input type="text" id="search-input" placeholder="Search..." class="w-full border border-gray-300 rounded-lg py-2 pl-3 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 focus:border-transparent">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <div class="relative">
                            <select id="sort-select" class="appearance-none px-4 pr-10 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm">
                                <option selected disabled>Pilih Urutan</option>
                                <option value="newest">Data Terbaru</option>
                                <option value="oldest">Data Terlama</option>
                                <option value="a-z">A - Z</option>
                                <option value="z-a">Z - A</option>
                            </select>
                            <svg class="w-4 h-4 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    <a href="{{route('superadmin.tambah-user-page')}}" class="bg-teal-800 text-white rounded-full px-6 py-2 text-sm hover:bg-teal-900 transition-colors whitespace-nowrap">
                        Tambah Data
                    </a>
                </div>

                <!-- Table Container -->
                <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                    <!-- Desktop Table -->
                    <div class="overflow-x-auto max-w-full bg-white rounded-lg shadow">
                        <table class="min-w-full table-fixed divide-gray-200">
                            <thead class="bg-gray-50 border-b">
                                <tr>
                                    <th class="pl-6 py-4 text-left text-sm text-gray-400 uppercase tracking-wider w-1/5" scope="col">Nama</th>
                                    <th class="px-4 py-4 text-left text-sm text-gray-400 uppercase tracking-wider w-1/4" scope="col">Email</th>
                                    <th class="px-4 py-4 text-left text-sm text-gray-400 uppercase tracking-wider w-1/5" scope="col">Role</th>
                                    <th class="px-4 py-4 text-left text-sm text-gray-400 uppercase tracking-wider w-1/5" scope="col">Status</th>
                                    <th class="px-4 py-4 text-left text-sm text-gray-400 uppercase tracking-wider w-1/5" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="user-table-body" class="divide-y divide-gray-200"></tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between text-sm text-gray-500 px-7 pb-5 pt-4 border-t border-gray-200 font-light">
                        <div class="mb-3 md:mb-0 flex items-center gap-1">
                            <span>Showing</span>
                            <div class="relative">
                            <select id="perPage-select" class="appearance-none border border-gray-200 rounded px-2 pr-8 py-1 text-sm text-gray-500 focus:outline-none focus:ring-2 focus:ring-teal-700 focus:border-transparent">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                            <svg
                            class="w-4 h-4 text-gray-400 absolute right-2 top-1/2 -translate-y-1/2 pointer-events-none"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                            </div>
                            <span class="text-sm text-gray-600">of {{$userCount}}</span>
                        </div>
                        <nav
                        id="pagination-container"
                        class="flex items-center gap-1 select-none"
                        role="navigation"
                        aria-label="Pagination Navigation"
                        ></nav>
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
        const searchInput = document.getElementById('search-input');
        const sortSelect = document.getElementById('sort-select');
        const perPageSelect = document.getElementById('perPage-select');
        const paginationContainer = document.getElementById('pagination-container');
        let currentPage = 1;
        let perPage = 10;

        function fetchUsers() {
            const search = searchInput.value;
            const sort = sortSelect.value;
            const perPage = perPageSelect.value;

            const params = new URLSearchParams({
                page: currentPage,
                search,
                sort,
                perPage
            });

            fetch(`${userJsonUrl}?${params.toString()}`)
                .then(response => response.json())
                .then(data => {
                    userTableBody.innerHTML = '';
                    data.data.forEach(user => {
                        const tr = document.createElement('tr');
                        tr.className = 'hover:bg-gray-50';
                        tr.id = `user-row-${user.id}`;

                        tr.innerHTML = `
                            <td class="pl-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 rounded-full overflow-hidden">
                                        <img src="${user.image ? '/storage/' + user.image : '/assets/images/icon/none-profile-icon.svg'}" alt="Foto Profil" class="object-cover w-full h-full">
                                    </div>
                                    <span class="py-4 text-sm text-gray-700 font-normal">${user.name}</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-700 font-normal">${user.email}</td>
                            <td class="px-4 py-4 text-sm text-gray-700 font-normal">${user.role}</td>
                            <td class="py-4 px-4">
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
                            <td class="py-4 px-4">
                                <button onclick="bukaModalRuangan(this)"
                                    data-user='${JSON.stringify(user)}'
                                    class="text-blue-600 hover:bg-blue-50 rounded-lg">
                                    <img src="/assets/images/icon/action-edit-icon.svg" alt="Edit action icon"/>
                                </button>
                                <button
                                    type="button"
                                    class="btn-delete-user p-1 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
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
                    renderPagination(data); // panggil di sini
                    attachDeleteListeners(); // tambahkan jika perlu delete listener

                })
                .catch(error => console.error('Error fetching users:', error));
        }

        function renderPagination(data) {
            const paginationContainer = document.getElementById('pagination-container');
            paginationContainer.innerHTML = '';

            const current = data.current_page;
            const last = data.last_page;

            const createButton = (label, page, disabled = false, active = false) => {
                const button = document.createElement('button');
                button.textContent = label;
                button.className = `border border-gray-200 rounded px-2 py-1 text-sm
                    ${active ? 'bg-[#0d5c5c] text-white' : 'hover:bg-gray-100'}
                    ${disabled ? 'text-gray-400 cursor-not-allowed' : ''}`;
                button.disabled = disabled;
                if (!disabled) {
                    button.addEventListener('click', () => {
                        currentPage = page;
                        fetchUsers();
                    });
                }
                return button;
            };

            // Previous
            paginationContainer.appendChild(createButton('<', current - 1, current === 1));

            // Selalu tampilkan halaman 1
            paginationContainer.appendChild(createButton(1, 1, false, current === 1));

            let start = current - 2;
            let end = current + 2;

            if (start <= 2) {
                start = 2;
                end = 5;
            }
            if (end >= last - 1) {
                end = last - 1;
                start = last - 4;
                if (start < 2) start = 2;
            }

            if (start > 2) {
                const dots = document.createElement('span');
                dots.textContent = '...';
                dots.className = 'px-2 text-gray-500';
                paginationContainer.appendChild(dots);
            }

            for (let i = start; i <= end; i++) {
                if (i > 1 && i < last) {
                    paginationContainer.appendChild(createButton(i, i, false, i === current));
                }
            }

            if (end < last - 1) {
                const dots = document.createElement('span');
                dots.textContent = '...';
                dots.className = 'px-2 text-gray-500';
                paginationContainer.appendChild(dots);
            }

            // Selalu tampilkan halaman terakhir jika last > 1
            if (last > 1) {
                paginationContainer.appendChild(createButton(last, last, false, current === last));
            }

            // Next
            paginationContainer.appendChild(createButton('>', current + 1, current === last));
        }


        searchInput.addEventListener('input', debounce(() => {
            currentPage = 1;
            fetchUsers();
        }, 300));

        sortSelect.addEventListener('change', () => {
            currentPage = 1;
            fetchUsers();
        });

        perPageSelect.addEventListener('change', () => {
            currentPage = 1;
            fetchUsers();
        });

        // Inisialisasi fetch saat halaman load
        document.addEventListener('DOMContentLoaded', fetchUsers);

        function debounce(func, delay) {
            let timeoutId;
            return function(...args) {
                clearTimeout(timeoutId);
                timeoutId = setTimeout(() => {
                    func.apply(this, args);
                }, delay);
            };
        }

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

@if(session('batal'))
    <script>
        Swal.fire({
            toast: true,
            position: 'bottom-end',
            icon: 'info',
            title: '{{ session('batal') }}',
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true
        });
        </script>
    @endif
@endsection
