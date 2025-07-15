@extends('layouts.admin-layout')

@section('title', 'Dashboard')

@section('main')

     <h1 class="text-2xl font-semibold text-gray-900 mb-6">Ringkasan</h1>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Total Surat</h3>
                    <p id="total-surat-count" class="text-3xl font-bold text-gray-900">0</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Menunggu Persetujuan</h3>
                    <p id="menunggu-persetujuan-count" class="text-3xl font-bold text-gray-900">0</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Menunggu Verifikasi</h3>
                    <p id="menunggu-verifikasi-count" class="text-3xl font-bold text-gray-900">0</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Surat Ditolak</h3>
                    <p id="surat-ditolak-count" class="text-3xl font-bold text-gray-900">0</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Surat Diterima</h3>
                    <p id="surat-diterima-count" class="text-3xl font-bold text-gray-900">0</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Total Ruangan</h3>
                    <p id="ruangan-count" class="text-3xl font-bold text-gray-900">0</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Total Fasilitas</h3>
                    <p id="fasilitas-count" class="text-3xl font-bold text-gray-900">0</p>
                </div>
            </div>


           <!-- Wrapper -->
<div class="bg-white rounded-lg shadow-sm">
  <!-- Header -->
  <div class="p-6 border-b">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
      <div>
        <h2 class="text-lg font-semibold text-gray-900">Daftar Surat</h2>
        <p class="text-sm text-gray-500 mt-1">Pengajuan Surat</p>
      </div>
      <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-3">
        <!-- Search -->
        <div class="relative">
          <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
          <input
            type="text"
            placeholder="Search"
            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 appearance-none"
          />
        </div>

        <!-- Status Select -->
        <div class="relative">
          <select
            id="dashboard-status-filter"
            class="appearance-none px-4 pr-10 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-700 focus:border-transparent"
          >
            <option value="">Status: All</option>
            <option value="Diterima">Diterima</option>
            <option value="Menunggu Verifikasi">Menunggu Verifikasi</option>
            <option value="Menunggu Persetujuan">Menunggu Persetujuan</option>
            <option value="Ditolak">Ditolak</option>
          </select>
          <!-- Custom Arrow -->
          <svg
            class="w-4 h-4 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </div>

        <!-- Per Page Select -->
        <div class="relative">
          <select
            id="dashboard-per-page-select"
            class="appearance-none px-4 pr-10 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-700 focus:border-transparent"
          >
            <option value="5">5</option>
            <option value="10" selected>10</option>
            <option value="20">20</option>
            <option value="50">50</option>
          </select>
          <!-- Custom Arrow -->
          <svg
            class="w-4 h-4 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </div>
      </div>
    </div>
  </div>

  <!-- Table -->
  <div class="overflow-x-auto">
    <table class="w-full">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomer Surat</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Peminjam</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Asal Surat</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
        </tr>
      </thead>
      <tbody id="dashboard-table-body" class="bg-white divide-y divide-gray-200">
        <!-- Data rows will be inserted here -->
      </tbody>
      <tfoot class="bg-gray-50">
        <tr>
            <td colspan="4" class="px-6 py-4 border-t border-gray-200 rounded-b-lg">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
                <p id="dashboard-entries-info" class="text-sm text-gray-500">
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
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 <script src="{{asset('assets/js/admin/dashboard-admin-ringkasan.js')}}"></script>
 <script>

    function fetchDashboardData() {
        fetch('{{ route('admin.dashboard-summary-json') }}')
            .then(response => response.json())
            .then(data => {
                document.getElementById('total-surat-count').textContent = data.data.total_surat;
                document.getElementById('menunggu-persetujuan-count').textContent = data.data.menunggu_persetujuan;
                document.getElementById('menunggu-verifikasi-count').textContent = data.data.menunggu_verifikasi;
                document.getElementById('surat-ditolak-count').textContent = data.data.surat_ditolak;
                document.getElementById('surat-diterima-count').textContent = data.data.surat_disetujui;
                document.getElementById('ruangan-count').textContent = data.data.total_ruangan;
                document.getElementById('fasilitas-count').textContent = data.data.total_fasilitas;
            })
            .catch(error => console.error('Error fetching dashboard data:', error));
    }

    document.addEventListener('DOMContentLoaded', fetchDashboardData);

    const searchInput = document.querySelector('input[placeholder="Search"]');
    const statusSelect = document.querySelector('select#dashboard-status-filter');
    const perPageSelect = document.querySelector('select#dashboard-per-page-select');
    const tableBody = document.querySelector('tbody#dashboard-table-body');
    const paginationContainer = document.querySelector('#dashboard-pagination-container');
    const entriesInfo = document.querySelector('#dashboard-entries-info');

    let currentPage = 1;
    let perPage = 10;

    function getStatusBadge(status) {
        switch(status) {
            case 'Diterima':
                return `<span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Diterima</span>`;
            case 'Menunggu Verifikasi':
                return `<span class="px-3 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">Menunggu Verifikasi</span>`;
            case 'Menunggu Persetujuan':
                return `<span class="px-3 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Menunggu Persetujuan</span>`;
            case 'Ditolak':
                return `<span class="px-3 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Ditolak</span>`;
            default:
                return `<span class="px-3 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">${status}</span>`;
        }
    }

    function fetchDashboardTable() {
        const query = searchInput.value.trim();
        const selectedStatus = statusSelect ? statusSelect.value : '';
        const url = `{{ route('admin.dashboard-peminjaman-json') }}?page=${currentPage}&perPage=${perPage}&search=${encodeURIComponent(query)}&status=${encodeURIComponent(selectedStatus)}`;

        fetch(url)
        .then(response => response.json())
        .then(data => {
            tableBody.innerHTML = '';
            const peminjamans = data.data;
            if (peminjamans.length === 0) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="4" class="text-center py-6 text-gray-500">Data tidak tersedia.</td>
                    </tr>
                `;
            } else {
                peminjamans.forEach(peminjaman => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td class="px-6 py-4 text-sm text-gray-900">${peminjaman.nomor_surat}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">${peminjaman.nama_peminjam}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">${peminjaman.asal_surat}</td>
                        <td class="px-6 py-4">${getStatusBadge(peminjaman.status)}</td>
                    `;
                    tableBody.appendChild(tr);
                });
            }
            entriesInfo.textContent = `Showing data ${data.from} to ${data.to} of ${data.total} entries`;
            updatePagination(data.current_page, data.last_page);
        })
        .catch(error => console.error('Error fetching dashboard table:', error));
    }

  function updatePagination(current, last) {
    paginationContainer.innerHTML = '';

    const createBtn = (label, page, disabled = false, active = false) => {
        const btn = document.createElement('button');
        btn.textContent = label;
        btn.className = `px-3 py-1 text-sm rounded ${active ? 'bg-[#0d5c5c] text-white' : 'text-gray-500 hover:text-gray-700'} ${disabled ? 'cursor-not-allowed opacity-50' : ''}`;
        if (!disabled) {
            btn.addEventListener('click', () => {
                currentPage = page;
                fetchDashboardTable();
            });
        }
        return btn;
    };

    // Tombol Previous
    paginationContainer.appendChild(createBtn('<', current - 1, current === 1));

    // Selalu tampilkan halaman 1
    paginationContainer.appendChild(createBtn(1, 1, false, current === 1));

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
            paginationContainer.appendChild(createBtn(i, i, false, i === current));
        }
    }

    if (end < last - 1) {
        const dots = document.createElement('span');
        dots.textContent = '...';
        dots.className = 'px-2 text-gray-500';
        paginationContainer.appendChild(dots);
    }

    if (last > 1) {
        paginationContainer.appendChild(createBtn(last, last, false, current === last));
    }

    // Tombol Next
    paginationContainer.appendChild(createBtn('>', current + 1, current === last));
}


       // debounce untuk live search
    function debounce(func, delay) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    }

    searchInput.addEventListener('input', debounce(() => {
        currentPage = 1;
        fetchDashboardTable();
    }, 300));

    if (statusSelect) {
        statusSelect.addEventListener('change', () => {
            currentPage = 1;
            fetchDashboardTable();
        });
    }

    if (perPageSelect) {
        perPageSelect.addEventListener('change', () => {
            perPage = parseInt(perPageSelect.value);
            currentPage = 1;
            fetchDashboardTable();
        });
    }

    document.addEventListener('DOMContentLoaded', fetchDashboardTable);


 </script>
@endsection
