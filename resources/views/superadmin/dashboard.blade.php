@extends('layouts.super-admin-layout')

@section('title', 'Dashboard')

@section('main')

        <h1 class="text-2xl font-semibold text-gray-900 mb-6">Ringkasan</h1>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Total Role</h3>
                <p class="text-3xl font-bold text-gray-900" id="total-roles">0</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
              <h3 class="text-sm font-medium text-gray-500 mb-2">Total User</h3>
              <p class="text-3xl font-bold text-gray-900" id="total-users">0</p>
            </div>
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-sm font-medium text-gray-500 mb-2">Pengguna Aktif</h3>
            <p class="text-3xl font-bold text-gray-900" id="active-users">0</p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-sm font-medium text-gray-500 mb-2">Pengguna Nonaktif</h3>
            <p class="text-3xl font-bold text-gray-900" id="nonactive-users">0</p>
          </div>
        </div>

        <!-- User Table -->
        <div class="bg-white rounded-lg shadow-sm">
            <div class="p-6">
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
            <div>
              <h2 class="text-lg font-semibold text-gray-900">Daftar Pengguna</h2>
              <div class="text-sm text-green-500 mt-1">Pengguna Aktif</div>
            </div>

            <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-3">
              <div class="relative">
                <input type="text" id="dashboard-search-input" placeholder="Search" class="pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 appearance-none text-sm w-64 mt-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 absolute left-2.5 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
              </div>


            <!-- Sort Select -->
            <div class="relative">
                <select id="dashboard-sort-select"
                class="appearance-none px-4 pr-10 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm">
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

            <!-- Status Select -->
            <div class="relative">
                <select id="dashboard-status-select"
                class="appearance-none px-4 pr-10 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm">
                <option value="all">Status: All</option>
                <option value="aktif">Aktif</option>
                <option value="non-aktif">Non-aktif</option>
                </select>
                <svg class="w-4 h-4 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>

            <!-- Per Page Select -->
            <div class="relative">
                <select id="dashboard-per-page-select"
                class="appearance-none px-4 pr-10 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm">
                <option value="5">5</option>
                <option value="10" selected>10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                </select>
                <svg class="w-4 h-4 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </div>
            </div>
           </div>
          </div>

          <div class="overflow-x-auto">
            <table class="w-full">
              <thead">
                <tr class="border-b">
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
              </thead>
              <tbody id="dashboard-users-table-body" class="bg-white divide-y divide-gray-200">
              </tbody>
              <tfoot class="bg-gray-50">
                <tr>
                    <td colspan="4" class="px-6 py-4 border-t border-gray-200 rounded-b-lg">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
                        <p id="dashboard-showing-data" class="text-sm text-gray-500">
                        Showing data 0 to 0 of 0 entries
                        </p>
                        <div id="dashboard-pagination-container" class="flex items-center space-x-2">
                        <!-- Pagination buttons -->
                        </div>
                    </div>
                    </td>
                </tr>
            </tfoot>
            </table>
          </div>
        </div>
@endsection

@section('js')

    <script>
        const dashboardUsersTableBody = document.getElementById('dashboard-users-table-body');
        const dashboardSearchInput = document.getElementById('dashboard-search-input');
        const dashboardSortSelect = document.getElementById('dashboard-sort-select');
        const dashboardStatusSelect = document.getElementById('dashboard-status-select');
        const dashboardPaginationContainer = document.getElementById('dashboard-pagination-container');
        const dashboardShowingData = document.getElementById('dashboard-showing-data');
        const dashboardPerPageSelect = document.getElementById('dashboard-per-page-select');

        const dashboardUserJsonUrl = "{{ route('superadmin.dashboard-users-json') }}";
        let dashboardCurrentPage = 1;
        let dashboardPerPage = 10;
        let dashboardSearchTerm = '';
        let dashboardStatusFilter = 'all';
        let dashboardSortBy = 'newest';

        document.addEventListener('DOMContentLoaded', () => {
            fetch("{{ route('superadmin.stats-json') }}")
                .then(response => response.json())
                .then(data => {
                    document.getElementById('total-roles').textContent = data.totalRoles;
                    document.getElementById('total-users').textContent = data.totalUsers;
                    document.getElementById('active-users').textContent = data.activeUsers;
                    document.getElementById('nonactive-users').textContent = data.nonActiveUsers;
                })
                .catch(error => console.error('Error fetching dashboard stats:', error));
        });

        function fetchDashboardUsers() {
            let url = `${dashboardUserJsonUrl}?page=${dashboardCurrentPage}&perPage=${dashboardPerPage}&search=${dashboardSearchTerm}&sortBy=${dashboardSortBy}&status=${dashboardStatusFilter}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // console.log(data);
                    renderDashboardUsers(data);
                    renderDashboardPagination(data);
                    renderDashboardShowingData(data);
                })
                .catch(error => console.error('Error fetching dashboard users:', error));
        }


        function renderDashboardUsers(data) {
            dashboardUsersTableBody.innerHTML = '';
            data.data.forEach(user => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td class="px-6 py-4 text-sm text-gray-900">${user.name}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">${user.role}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">${user.email}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 ${user.status === 'aktif' ? 'text-green-800 bg-green-100' : 'text-red-800 bg-red-100'} font-medium rounded-full text-xs">${user.status.charAt(0).toUpperCase() + user.status.slice(1)}</span>
                    </td>
                `;
                dashboardUsersTableBody.appendChild(tr);
            });
        }

        dashboardPerPageSelect.addEventListener('change', () => {
            dashboardPerPage = dashboardPerPageSelect.value;
            dashboardCurrentPage = 1; // reset ke halaman 1 saat perPage berubah
            fetchDashboardUsers();
        });

        function renderDashboardShowingData(data) {
            dashboardShowingData.textContent = `Showing data ${data.from} to ${data.to} of ${data.total} entries`;
        }

        function renderDashboardPagination(data) {
            dashboardPaginationContainer.innerHTML = '';

            const current = data.current_page;
            const last = data.last_page;

            const createButton = (label, page, disabled = false, active = false) => {
                const button = document.createElement('button');
                button.textContent = label;
                button.className = `rounded px-3 py-1 text-sm
                    ${active ? 'bg-[#0d5c5c] text-white' : 'text-gray-500 hover:text-gray-700'}
                    ${disabled ? 'cursor-not-allowed opacity-50' : ''}`;
                button.disabled = disabled;
                if (!disabled) {
                    button.addEventListener('click', () => {
                        dashboardCurrentPage = page;
                        fetchDashboardUsers();
                    });
                }
                return button;
            };

            // Previous
            dashboardPaginationContainer.appendChild(createButton('<', current - 1, current === 1));

            // Always show page 1
            dashboardPaginationContainer.appendChild(createButton(1, 1, false, current === 1));

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
                dashboardPaginationContainer.appendChild(dots);
            }

            for (let i = start; i <= end; i++) {
                if (i > 1 && i < last) {
                    dashboardPaginationContainer.appendChild(createButton(i, i, false, i === current));
                }
            }

            if (end < last - 1) {
                const dots = document.createElement('span');
                dots.textContent = '...';
                dots.className = 'px-2 text-gray-500';
                dashboardPaginationContainer.appendChild(dots);
            }

            // Always show last page if last > 1
            if (last > 1) {
                dashboardPaginationContainer.appendChild(createButton(last, last, false, current === last));
            }

            // Next
            dashboardPaginationContainer.appendChild(createButton('>', current + 1, current === last));
        }


        function debounce(func, delay) {
            let timeoutId;
            return (...args) => {
                clearTimeout(timeoutId);
                timeoutId = setTimeout(() => {
                    func.apply(null, args);
                }, delay);
            };
        }

        const debouncedSearch = debounce(() => {
            dashboardCurrentPage = 1; // reset page saat search
            dashboardSearchTerm = dashboardSearchInput.value.trim();
            fetchDashboardUsers();
        }, 300);

        dashboardSearchInput.addEventListener('input', debouncedSearch);

        dashboardSortSelect.addEventListener('change', () => {
            dashboardSortBy = dashboardSortSelect.value;
            dashboardCurrentPage = 1;
            fetchDashboardUsers();
        });

        dashboardStatusSelect.addEventListener('change', () => {
            dashboardStatusFilter = dashboardStatusSelect.value;
            dashboardCurrentPage = 1;
            fetchDashboardUsers();
        });

        document.addEventListener('DOMContentLoaded', () => {
            fetchDashboardUsers();
        });



    </script>

@endsection
