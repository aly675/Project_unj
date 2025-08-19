@extends('layouts.supkorla-layout')

@section('title', 'Dashboard')

@section('page', 'Dashboard')

@section('style')
    <style>

    </style>
@endsection

@section('main')
                <h1 class="text-2xl font-bold text-gray-900 mb-6">Ringkasan</h1>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                        <h3 class="text-sm font-medium text-gray-600 mb-2">Total Surat Masuk</h3>
                        <p id="total-surat" class="text-3xl font-bold text-gray-900">0</p>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                        <h3 class="text-sm font-medium text-gray-600 mb-2">Menunggu Persetujuan</h3>
                        <p id="menunggu-persetujuan" class="text-3xl font-bold text-gray-900">0</p>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                        <h3 class="text-sm font-medium text-gray-600 mb-2">Menunggu Verifikasi</h3>
                        <p id="menunggu-verifikasi" class="text-3xl font-bold text-gray-900">0</p>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                        <h3 class="text-sm font-medium text-gray-600 mb-2">Surat Diverifikasi</h3>
                        <p id="surat-diverifikasi" class="text-3xl font-bold text-gray-900">0</p>
                    </div>
                </div>

                <!-- Data Table -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900">Daftar Surat Masuk</h2>
                                <p class="text-sm text-teal-600 mt-1">Daftar Surat</p>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="relative">
                                    <input id="searchInput" type="text" placeholder="Search..."
                                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="text-xs text-gray-600">Sort by:</span>
                                    <select id="sortSelect" class="border border-gray-300 rounded px-3 py-2 text-xs">
                                        <option value="newest" selected>Newest</option>
                                        <option value="oldest">Oldest</option>
                                        <option value="a-z">A - Z</option>
                                        <option value="z-a">Z - A</option>
                                    </select>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="text-xs text-gray-600">Status :</span>
                                    <select id="statusSelect" class="border border-gray-300 rounded px-3 py-2 text-xs">
                                        <option value="all">All</option>
                                        <option value="menunggu persetujuan">Menunggu Persetujuan</option>
                                        <option value="menunggu verifikasi">Menunggu Verifikasi</option>
                                        <option value="disetujui">Sudah Diverifikasi</option>
                                        <option value="ditolak">Ditolak</option>
                                    </select>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <select id="perPageSelect" class="border border-gray-300 rounded px-3 py-2 text-xs">
                                        <option value="5">5</option>
                                        <option selected value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor Surat</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lama Peminjam</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Ruangan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody" class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td rowspan="2" colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">Memuat data ....</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <p id="paginationInfo" class="text-sm text-gray-500">Showing data 0 to 0 of 0 entries</p>
                            <div id="pagination" class="flex items-center space-x-2">

                            </div>
                        </div>
                    </div>
                </div>
@endsection

@section('js')
<script>

    document.addEventListener('DOMContentLoaded', () => {
        fetch('{{ route('supkorla.dashboard-summary-json') }}')
            .then(res => res.json())
            .then(data => {
                document.getElementById('total-surat').textContent = data.total;
                document.getElementById('menunggu-persetujuan').textContent = data.menungguPersetujuan;
                document.getElementById('menunggu-verifikasi').textContent = data.menungguVerifikasi;
                document.getElementById('surat-diverifikasi').textContent = data.diterima;
            })
            .catch(error => {
                console.error('Gagal ambil data summary:', error);
            });
    });

        async function fetchData() {
        const search = document.getElementById('searchInput').value;
        const sort = document.getElementById('sortSelect').value;
        const status = document.getElementById('statusSelect').value;
        const perPage = document.getElementById('perPageSelect').value;

        const url = `/supkorla/dashboard-data-table/json?search=${search}&sort=${sort}&status=${status}&per_page=${perPage}`;

        try {
            const res = await fetch(url);
            const result = await res.json();

            renderTable(result.data);
            renderInfo(result.meta);

        } catch (err) {
            console.error('Gagal mengambil data:', err);
        }
    }

    function renderTable(data) {
        const tbody = document.getElementById('tableBody');
        tbody.innerHTML = '';

        if (data.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="4" class="text-center py-4 text-gray-500">Tidak ada data ditemukan.</td>
                </tr>
            `;
            return;
        }

        data.forEach(item => {
            let badgeClass = '';

            switch (item.status.toLowerCase()) {
                case 'sudah diverifikasi':
                    badgeClass = 'bg-green-100 text-green-800';
                    break;
                case 'ditolak':
                    badgeClass = 'bg-red-100 text-red-800';
                    break;
                case 'menunggu verifikasi':
                    badgeClass = 'bg-yellow-100 text-yellow-800';
                    break;
                case 'menunggu persetujuan':
                    badgeClass = 'bg-blue-100 text-blue-800';
                    break;
                default:
                    badgeClass = 'bg-gray-100 text-gray-800';
            }

            const row = `
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.nomor_surat}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${item.lama_peminjaman}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${item.jumlah_ruangan}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 text-xs font-medium rounded-full ${badgeClass}">
                            ${capitalizeFirstLetter(item.status)}
                        </span>
                    </td>
                </tr>
            `;
            tbody.insertAdjacentHTML('beforeend', row);
        });
    }

    function renderInfo(meta) {
        const info = document.getElementById('paginationInfo');
        if (!meta || meta.total === 0) {
            info.textContent = 'Tidak ada data untuk ditampilkan.';
            return;
        }

        info.textContent = `Showing data ${meta.from} to ${meta.to} of ${meta.total} entries`;
    }

    function capitalizeFirstLetter(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }

    // Listener untuk filter dan perPage
    document.getElementById('searchInput').addEventListener('input', debounce(fetchData, 400));
    document.getElementById('sortSelect').addEventListener('change', fetchData);
    document.getElementById('statusSelect').addEventListener('change', fetchData);
    document.getElementById('perPageSelect').addEventListener('change', fetchData);

    // Debounce biar ga spam fetch pas ngetik
    function debounce(func, delay) {
        let timeout;
        return function () {
            clearTimeout(timeout);
            timeout = setTimeout(func, delay);
        };
    }

    function renderPagination(currentPage, totalPages) {
        const pagination = document.getElementById('pagination');
        pagination.innerHTML = ''; // reset isi pagination

        // Tombol << (halaman pertama)
        if (currentPage > 3) {
            const firstBtn = createButton('« 1', 1);
            pagination.appendChild(firstBtn);
        }

        // Tampilkan halaman sebelum current (maksimal 2)
        for (let i = currentPage - 2; i < currentPage; i++) {
            if (i > 0) {
                const prevBtn = createButton(i, i);
                pagination.appendChild(prevBtn);
            }
        }

        // Tampilkan current page
        const currentBtn = createButton(currentPage, currentPage, true);
        pagination.appendChild(currentBtn);

        // Tampilkan halaman setelah current (maksimal 2)
        for (let i = currentPage + 1; i <= currentPage + 2 && i <= totalPages; i++) {
            const nextBtn = createButton(i, i);
            pagination.appendChild(nextBtn);
        }

        // Tambahkan ... jika masih ada halaman di belakang
        if (currentPage + 2 < totalPages - 1) {
            const dot = document.createElement('span');
            dot.className = 'px-3 py-1 text-sm text-gray-500';
            dot.innerText = '...';
            pagination.appendChild(dot);
        }

        // Tombol ke halaman terakhir
        if (currentPage + 2 < totalPages) {
            const lastBtn = createButton(`${totalPages} »`, totalPages);
            pagination.appendChild(lastBtn);
        }
    }

    // Helper: Buat tombol page
    function createButton(label, pageNumber, isActive = false) {
        const button = document.createElement('button');
        button.innerText = label;
        button.className = `px-3 py-1 text-sm rounded ${
            isActive ? 'bg-teal-600 text-white' : 'text-gray-500 hover:text-gray-700'
        }`;

        if (!isActive) {
            button.addEventListener('click', () => {
                // Ganti halaman aktif
                fetchData(pageNumber); // fungsi ambil data baru
            });
        }

        return button;
    }

    // Initial load
    document.addEventListener('DOMContentLoaded', fetchData);



</script>
@endsection
