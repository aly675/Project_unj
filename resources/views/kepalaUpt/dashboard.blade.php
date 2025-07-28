@extends('layouts.kepala-upt-layout')

@section('title', 'Dashboard')

@section('page', 'Dashboard')

@section('main')
      <h1 class="text-2xl font-semibold text-gray-800 mt-6">Ringkasan</h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-6 mb-10">
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Total Surat</h3>
                    <p id="total-surat" class="text-3xl font-bold text-gray-900">0</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Menunggu Persetujuan</h3>
                    <p id="surat-menunggu" class="text-3xl font-bold text-gray-900">0</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Surat Diterima</h3>
                    <p id="surat-diterima" class="text-3xl font-bold text-gray-900">0</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Surat Ditolak</h3>
                    <p id="surat-ditolak" class="text-3xl font-bold text-gray-900">0</p>
                </div>
            </div>

        <!-- Table -->
        <div class="bg-white rounded-xl p-6 shadow-md max-w-full overflow-x-auto">
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-5 gap-4">
            <div>
              <h2 class="text-lg font-semibold leading-tight select-none">Daftar Surat Masuk</h2>
              <a href="#" class="text-sm text-teal-600 select-none">Daftar Surat</a>
            </div>

            <div class="flex items-center gap-3">
              <label for="searchInput" class="sr-only">Search</label>
              <input
                id="searchInput"
                type="search"
                placeholder="Search"
                class="rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
              />
              <select
                id="sortBySelect"
                aria-label="Sort by"
                class="rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
              >
                <option>Sort by : Newest</option>
                <option>Sort by : Oldest</option>
                <option>Sort by : A-Z</option>
                <option>Sort by : Z-A</option>
              </select>
              <select
                id="statusFilterSelect"
                aria-label="Sort by status"
                class="rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
              >
                <option>Status : All</option>
                <option>Status : Menunggu Persetujuan</option>
                <option>Status : Ditolak</option>
                <option>Status : Diterima</option>
              </select>
                <select id="perPageSelect" class="rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"> <!-- optional buat batas tampil -->
                    <option value="5">5</option>
                    <option value="10" selected>10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                </select>
            </div>
          </div>

            <table class="w-full text-left text-sm text-gray-700 border-collapse">
                <thead class="border-b border-gray-300">
                <tr>
                    <th class="px-4 py-2 font-semibold text-gray-400 select-none">Nomor Surat</th>
                    <th class="px-4 py-2 font-semibold text-gray-400 select-none">Nama Peminjam</th>
                    <th class="px-4 py-2 font-semibold text-gray-400 select-none">Asal Surat</th>
                    <th class="px-4 py-2 font-semibold text-gray-400 select-none">Status</th>
                </tr>
                </thead>
                <tbody id="surat-table-body"></tbody>
            </table>
            <div id="pagination-info" class="mt-4 text-xs text-gray-400 select-none"></div>
            <nav id="pagination-nav" class="mt-2 flex justify-center gap-2 text-gray-600 select-none"></nav>
        </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            fetch('{{ route('kepalaupt.dashboard-summary-json') }}')
                .then(res => res.json())
                .then(data => {
                    document.getElementById('total-surat').textContent = data.total;
                    document.getElementById('surat-menunggu').textContent = data.menunggu;
                    document.getElementById('surat-diterima').textContent = data.diterima;
                    document.getElementById('surat-ditolak').textContent = data.ditolak;
                })
                .catch(error => {
                    console.error('Gagal ambil data summary:', error);
                });
        });

        let currentPage = 1;

        function fetchSuratList() {
            const searchQuery = document.getElementById("searchInput").value;
            const sortBy = document.getElementById("sortBySelect").value.toLowerCase().replace('sort by : ', '');
            const status = document.getElementById("statusFilterSelect").value.toLowerCase().replace('status : ', '');
            const perPage = document.getElementById("perPageSelect").value;

            const params = new URLSearchParams({
                search: searchQuery,
                sort_by: sortBy,
                status: status === 'all' ? '' : capitalizeWords(status),
                page: currentPage,
                per_page: perPage,
            });

            const url = `{{ route('kepalaupt.dashboard-surat-peminjaman-json') }}?${params.toString()}`

            fetch(url)
                .then(res => res.json())
                // .then(res => {
                //     console.log(res);
                //     return res.json();
                // })
                .then(data => {
                    if (!data || !data.data) throw new Error("Data kosong atau tidak valid");
                    renderSuratTable(data.data);
                    renderPagination(data);
                    renderPaginationInfo(data);
                })
                .catch(err => console.error("Gagal ambil data surat:", err));
        }

        function capitalizeWords(str) {
            return str.replace(/\b\w/g, char => char.toUpperCase());
        }

        function renderSuratTable(data) {
            const tbody = document.getElementById("surat-table-body");
            tbody.innerHTML = "";

            if (data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="4" class="text-center px-4 py-3 text-sm text-gray-400">Tidak ada data</td></tr>`;
                return;
            }

            data.forEach(item => {
                const statusClass = {
                    'Diterima': 'bg-teal-200 text-teal-800',
                    'Ditolak': 'bg-red-200 text-red-800',
                    'Menunggu Persetujuan': 'bg-yellow-200 text-yellow-800'
                }[item.status] || 'bg-gray-200 text-gray-800';

                const tr = document.createElement("tr");
                tr.className = "border-b border-gray-100";
                tr.innerHTML = `
                    <td class="px-4 py-3">${item.nomor_surat}</td>
                    <td class="px-4 py-3">${item.nama_peminjam}</td>
                    <td class="px-4 py-3">${item.asal_surat}</td>
                    <td class="px-4 py-3">
                        <span class="inline-block px-3 py-1 rounded-md text-xs ${statusClass}">
                            ${item.status === 'Diterima' || item.status === 'Menunggu Verifikasi' ? 'Disetujui' : item.status}
                        </span>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        }

        function renderPagination(data) {
            const nav = document.getElementById("pagination-nav");
            nav.innerHTML = "";

            const createButton = (label, page, disabled = false, active = false) => {
                const btn = document.createElement("button");
                btn.textContent = label;
                btn.className = `p-2 rounded ${active ? 'bg-teal-700 text-white' : 'hover:bg-gray-200'} ${disabled ? 'text-gray-400 cursor-not-allowed' : ''}`;
                btn.disabled = disabled;
                if (!disabled) {
                    btn.addEventListener('click', () => {
                        currentPage = page;
                        fetchSuratList();
                    });
                }
                return btn;
            };

            nav.appendChild(createButton("<", data.current_page - 1, data.current_page === 1));

            for (let i = 1; i <= data.last_page; i++) {
                if (i === 1 || i === data.last_page || Math.abs(i - data.current_page) <= 2) {
                    nav.appendChild(createButton(i, i, false, i === data.current_page));
                } else if (i === data.current_page - 3 || i === data.current_page + 3) {
                    const span = document.createElement("span");
                    span.textContent = "...";
                    span.className = "p-2";
                    nav.appendChild(span);
                }
            }

            nav.appendChild(createButton(">", data.current_page + 1, data.current_page === data.last_page));
        }

        function renderPaginationInfo(data) {
            const info = document.getElementById("pagination-info");
            const from = data.from || 0;
            const to = data.to || 0;
            const total = data.total;
            info.textContent = `Showing data ${from} to ${to} of ${total} entries`;
        }

        function debounce(func, delay) {
            let timeout;
            return (...args) => {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), delay);
            };
        }

        document.addEventListener('DOMContentLoaded', () => {
            fetchSuratList();

            const searchInput = document.getElementById("searchInput");

            searchInput.addEventListener('input', debounce(() => {
                currentPage = 1;
                fetchSuratList();
            }, 500)); // ← delay 300ms, bisa kamu ubah

            document.getElementById("sortBySelect").addEventListener('change', () => {
                currentPage = 1;
                fetchSuratList();
            });

            document.getElementById("statusFilterSelect").addEventListener('change', () => {
                currentPage = 1;
                fetchSuratList();
            });

            document.getElementById("perPageSelect").addEventListener('change', () => {
                currentPage = 1;
                fetchSuratList();
            });
        });


    </script>
@endsection
