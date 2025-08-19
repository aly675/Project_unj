@extends('layouts.admin-layout')

@section('title', 'Peminjaman')

@section('style')
    <style>
        .print-out-button {
            background-color: #a7f3d0;
            color: #065f46;
            padding: 8px 16px;
            border: 1px solid #6ee7b7;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .print-out-button:hover {
            background-color: #86efac;
            border-color: #4ade80;
        }

        .print-out-button:active {
            background-color: #6ee7b7;
            transform: translateY(1px);
        }
    </style>
@endsection

@section('main')


    <h1 class="text-2xl font-semibold text-gray-900 mb-6">Peminjaman</h1>
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
      <div class="flex gap-3 flex-1 max-w-md">
        <div class="relative flex-1">
            <input
            class="w-full border border-gray-300 rounded-lg py-2 pl-3 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 focus:border-transparent"
            placeholder="Search..."
            type="text"
            />
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
         </svg>
        </div>

        <div class="relative">
            <select
            class="appearance-none px-4 pr-10 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 focus:border-transparent text-sm"
            >
            <option>Status : All</option>
            <option>Menunggu Persetujuan</option>
            <option>Menunggu Verifikasi</option>
            <option>Diterima</option>
            <option>Ditolak</option>
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
      <a
        href="{{route('admin.tambah-peminjaman-page')}}"
        class="bg-teal-800 text-white rounded-full px-6 py-2 text-sm hover:bg-teal-900 transition-colors whitespace-nowrap">
        Tambah Data
      </a>
    </div>
    <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
     <div class="overflow-x-auto max-w-full bg-white rounded-lg shadow">
      <table class="min-w-full table-fixed divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th
              class="px-6 py-3 text-left text-sm font-semibold text-gray-400 uppercase tracking-wider"
              scope="col"
            >
              NO
            </th>
            <th
              class="px-6 py-3 text-left text-sm text-gray-400 uppercase tracking-wider"
              scope="col"
            >
              NOMOR SURAT
            </th>
            <th
              class="px-6 py-3 text-left text-sm text-gray-400 uppercase tracking-wider"
              scope="col"
            >
              ASAL SURAT
            </th>
            <th
              class="px-6 py-3 text-left text-sm text-gray-400 uppercase tracking-wider"
              scope="col"
            >
              NAMA PEMINJAM
            </th>
            <th
              class="px-6 py-3 text-left text-sm text-gray-400 uppercase tracking-wider"
              scope="col"
            >
              LAMA PEMINJAM
            </th>
            <th
              class="px-6 py-3 text-left text-sm text-gray-400 uppercase tracking-wider"
              scope="col"
            >
              STATUS
            </th>
            <th
              class="px-6 py-3 text-left text-sm text-gray-400 uppercase tracking-wider"
              scope="col"
            >
              ACTION
            </th>
          </tr>
        </thead>

    <tbody id="peminjaman-table-body" class="divide-y divide-gray-200">
        <!-- Akan diisi otomatis oleh JS -->
    </tbody>

      </table>
      <div class="flex flex-col md:flex-row md:items-center md:justify-between text-sm text-gray-500 px-7 pb-5 pt-4 border-t border-gray-200 font-light">
        <div class="mb-3 md:mb-0 flex items-center gap-1">
        <span>Showing</span>
         <div class="relative">
            <select
            id="per-page-select"
            class="appearance-none border border-gray-200 rounded px-2 pr-8 py-1 text-sm text-gray-500 focus:outline-none focus:ring-2 focus:ring-teal-700 focus:border-transparent"
            >
            <option value="10">10</option>
            <option value="20">20</option>
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
         <span id="total-data-text">of 0</span>
        </div>
        <nav
        id="pagination-container"
        class="flex items-center gap-1 select-none"
        role="navigation"
        aria-label="Pagination Navigation"
        ></nav>
      </div>
    </div>
 </div>

    <div id="modalOverlayDetail" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 opacity-0 invisible transition-all duration-300 ease-out">
        @include('admin.peminjaman.detail-peminjaman')
    </div>

    <div id="modalOverlayUpdate" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 opacity-0 invisible transition-all duration-300 ease-out">
        @include('admin.peminjaman.update-peminjaman')
    </div>

@endsection

@section('js')

   <script>

    const searchInput = document.querySelector('input[placeholder="Search..."]');
    const statusSelect = document.querySelector('select');
    let currentPage = 1;
    let perPage = 10;

    const fetchPeminjamanData = () => {
        const query = searchInput.value.trim().toLowerCase();
        const selectedStatus = statusSelect.value;
        const peminjamanJsonUrl = "{{ route('admin.peminjaman-json') }}";

        fetch(`${peminjamanJsonUrl}?page=${currentPage}&perPage=${perPage}&search=${encodeURIComponent(query)}&status=${encodeURIComponent(selectedStatus)}`)
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('peminjaman-table-body');
                tbody.innerHTML = '';

                const peminjamans = data.data;

                if (peminjamans.length === 0) {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td colspan="7" class="text-center py-6 text-gray-500">
                            Data tidak tersedia.
                        </td>
                    `;
                    tbody.appendChild(tr);
                } else {
                    peminjamans.forEach((peminjaman, index) => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-700 font-normal">${index + 1}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-normal">${peminjaman.nomor_surat}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 font-normal">${peminjaman.asal_surat}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 font-normal">${peminjaman.nama_peminjam}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-normal">${peminjaman.lama_hari} Hari</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold">
                                ${getStatusBadge(peminjaman.status)}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 font-normal cursor-pointer">
                                ${getActionButtons(peminjaman)}
                            </td>
                        `;
                        tbody.appendChild(tr);
                    });
                }

                updatePagination(data.current_page, data.last_page);
                document.getElementById('total-data-text').textContent = `of ${data.total}`;
            })

            .catch(error => {
                console.error('Error fetching data:', error);
            });
    };

    function updatePagination(current, last) {
        const paginationContainer = document.getElementById('pagination-container');
        paginationContainer.innerHTML = '';

        const createButton = (label, page, disabled = false, active = false) => {
            const button = document.createElement('button');
            button.textContent = label;
            button.className = `border border-gray-200 rounded px-2 py-1 ${active ? 'bg-[#0d5c5c] text-white' : 'hover:bg-gray-100'} ${disabled ? 'text-gray-400 cursor-not-allowed' : ''}`;
            if (!disabled) {
                button.addEventListener('click', () => {
                    currentPage = page;
                    fetchPeminjamanData();
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


    // Event listeners
    searchInput.addEventListener('input', debounce(() => {
        currentPage = 1;
        fetchPeminjamanData();
    }, 300));

    statusSelect.addEventListener('change', () => {
        currentPage = 1;
        fetchPeminjamanData();
    });

    document.getElementById('per-page-select').addEventListener('change', (e) => {
        perPage = parseInt(e.target.value);
        currentPage = 1;
        fetchPeminjamanData();
    });

    // Initial fetch
    fetchPeminjamanData();

    // // jalankan pertama kali saat halaman load
    // document.addEventListener('DOMContentLoaded', fetchPeminjamanData);


    function getStatusBadge(status) {
        let color, text;
        switch (status) {
            case 'Menunggu Persetujuan':
                color = 'bg-yellow-100 text-yellow-600';
                break;
            case 'Menunggu Verifikasi':
                color = 'bg-blue-100 text-blue-600';
                break;
            case 'Diterima':
                color = 'bg-green-100 text-green-600';
                break;
            case 'Ditolak':
                color = 'bg-red-100 text-red-600';
                break;
            default:
                color = 'bg-gray-100 text-gray-600';
        }
        return `<span class="${color} px-3 py-1 rounded-full">${status}</span>`;
    }

    // debounce untuk live search
    function debounce(func, delay) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    }

    function getActionButtons(peminjaman) {
        if (peminjaman.status === 'Diterima' || peminjaman.status === 'Ditolak') {
            return `<a href="/admin/peminjaman/cetak-pdf-balasan/${peminjaman.id}"
                    target="_blank"
                    class="print-out-button block w-full text-center text-sm"
                    >Cetak</a>`;
        } else {
            return `
                <div class="flex items-center gap-x-2">
                    <button onclick="openModalDetail(${peminjaman.id})">
                        <img src="/assets/images/icon/action-view-icon.svg" alt="View" />
                    </button>
                    <button onclick="openModalUpdate(${peminjaman.id})">
                        <img src="/assets/images/icon/action-edit-icon.svg" alt="Edit action icon"/>
                    </button>
                    <button
                        type="button"
                        onclick="deletePeminjaman(${peminjaman.id})"
                    >
                        <img src="/assets/images/icon/action-delete-icon.svg" alt="Delete action icon"/>
                    </button>

                </div>
            `;
        }
    }

    // Jalankan saat halaman ready
    document.addEventListener('DOMContentLoaded', fetchPeminjamanData);

    setInterval(fetchPeminjamanData, 30000);


    // Get DOM elements
    const modalOverlayDetail = document.getElementById('modalOverlayDetail');
    const modalOverlayUpdate = document.getElementById('modalOverlayUpdate');

    // Variable untuk menyimpan ID peminjaman yang sedang diedit
    let currentPeminjamanId = null;

    // Get CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    // Data peminjaman dari server
    const peminjamanData = @json($peminjamans);

    function getStatusClasses(status) {
        switch (status) {
            case 'Menunggu Persetujuan':
                return 'bg-yellow-100 text-yellow-600';
            case 'Menunggu Verifikasi':
                return 'bg-blue-100 text-blue-600';
            case 'Diterima':
                return 'bg-green-100 text-green-600';
            case 'Ditolak':
                return 'bg-red-100 text-red-600';
            default:
                return 'bg-gray-100 text-gray-600';
        }
    }

    // DETAIL MODAL FUNCTIONS
    // function openModalDetail(id) {
    //     const data = peminjamanData.find(p => p.id === id);
    //     if (!data) return;

    //     document.getElementById('modal_nomor_surat').innerText = `: ${data.nomor_surat}`;
    //     document.getElementById('modal_asal_surat').innerText = `: ${data.asal_surat}`;
    //     document.getElementById('modal_nama_peminjam').innerText = `: ${data.nama_peminjam}`;
    //     document.getElementById('modal_jumlah_ruangan').innerText = `: ${data.jumlah_ruangan}`;
    //     document.getElementById('modal_jumlah_pc').innerText = `: ${data.jumlah_pc}`;
    //     document.getElementById('modal_lama_peminjam').innerText = `: ${data.lama_hari} hari`;
    //     const statusElement = document.getElementById('modal_status');
    //     statusElement.innerText = data.status ?? 'Menunggu';
    //     // Reset semua class warna sebelumnya
    //     statusElement.className = 'inline-flex px-2 py-1 text-sm font-medium rounded-full ' + getStatusClasses(data.status);
    //     const lampiranLink = document.getElementById('modal_lampiran_link');
    //     if (data.lampiran) {
    //         lampiranLink.href = `/storage/lampiran-peminjaman/${data.lampiran}`;
    //         lampiranLink.classList.remove('hidden');
    //     } else {
    //         lampiranLink.href = `/storage/lampiran-peminjaman/`;
    //     }

    //     // Render tanggal
    //     const container = document.getElementById('modal_tanggal_peminjam');
    //     container.innerHTML = '';
    //     data.tanggal_formatted.forEach(tgl => {
    //         const div = document.createElement('div');
    //         div.innerText = `- ${tgl}`;
    //         container.appendChild(div);
    //     });

    //     // Tampilkan modal detail
    //     const modal = document.querySelector('#modalOverlayDetail .bg-white');
    //     modalOverlayDetail.classList.remove('opacity-0', 'invisible');
    //     modalOverlayDetail.classList.add('opacity-100', 'visible');

    //     setTimeout(() => {
    //         modal.classList.remove('scale-75', '-translate-y-12');
    //         modal.classList.add('scale-100', 'translate-y-0');
    //     }, 10);

    //     document.body.style.overflow = 'hidden';
    // }

    async function openModalDetail(id) {
        try {
            // Panggil endpoint DETAIL yang BENAR (tidak pakai query ?id=... di list JSON)
            const response = await fetch(`/admin/peminjaman/json/${id}`);
            const json = await response.json();

            if (json.status !== 'success' || !json.data) {
                alert('Data tidak ditemukan!');
                return;
            }

            const data = json.data;

            // Isi elemen detail
            document.getElementById('modal_nomor_surat').innerText = `: ${data.nomor_surat || '-'}`;
            document.getElementById('modal_asal_surat').innerText = `: ${data.asal_surat || '-'}`;
            document.getElementById('modal_nama_peminjam').innerText = `: ${data.nama_peminjam || '-'}`;
            document.getElementById('modal_jumlah_ruangan').innerText = `: ${data.jumlah_ruangan || '-'}`;
            document.getElementById('modal_jumlah_pc').innerText = `: ${data.jumlah_pc || '-'}`;
            document.getElementById('modal_lama_peminjam').innerText = `: ${data.lama_hari || 0} hari`;

            // Status & kelas warna
            const statusElement = document.getElementById('modal_status');
            statusElement.innerText = data.status || 'Menunggu';
            statusElement.className = `inline-flex px-2 py-1 text-sm font-medium rounded-full ${getStatusClasses(data.status)}`;

            // Lampiran link
            const lampiranLink = document.getElementById('modal_lampiran_link');
            if (data.lampiran_url) {
                lampiranLink.href = data.lampiran_url;
                lampiranLink.classList.remove('hidden');
            } else {
                lampiranLink.href = '#';
                lampiranLink.classList.add('hidden');
            }

            // Render tanggal
            const container = document.getElementById('modal_tanggal_peminjam');
            container.innerHTML = '';
            if (data.tanggal_formatted && data.tanggal_formatted.length > 0) {
                data.tanggal_formatted.forEach(tgl => {
                    const div = document.createElement('div');
                    div.innerText = `- ${tgl}`;
                    container.appendChild(div);
                });
            } else {
                container.innerHTML = '<div>-</div>';
            }

            // Tampilkan modal
            const modalOverlayDetail = document.getElementById('modalOverlayDetail');
            const modal = modalOverlayDetail.querySelector('.bg-white');

            modalOverlayDetail.classList.remove('opacity-0', 'invisible');
            modalOverlayDetail.classList.add('opacity-100', 'visible');

            setTimeout(() => {
                modal.classList.remove('scale-75', '-translate-y-12');
                modal.classList.add('scale-100', 'translate-y-0');
            }, 10);

            document.body.style.overflow = 'hidden';

        } catch (error) {
            console.error('Gagal mengambil data detail:', error);
            alert('Terjadi kesalahan mengambil data.');
        }
    }


    function closeModalDetail() {
        const modal = document.querySelector('#modalOverlayDetail .bg-white');
        modal.classList.remove('scale-100', 'translate-y-0');
        modal.classList.add('scale-75', '-translate-y-12');

        setTimeout(() => {
            modalOverlayDetail.classList.remove('opacity-100', 'visible');
            modalOverlayDetail.classList.add('opacity-0', 'invisible');
        }, 200);

        document.body.style.overflow = 'auto';
    }

    // UPDATE MODAL FUNCTIONS
    function openModalUpdate(id) {
        const data = peminjamanData.find(p => p.id === id);
        if (!data) return;

        // Set current ID untuk keperluan update
        currentPeminjamanId = id;

        // Prefill form dengan data yang ada
        document.getElementById('nomor-surat').value = data.nomor_surat;
        document.getElementById('asal-surat').value = data.asal_surat;
        document.getElementById('nama-peminjam').value = data.nama_peminjam;
        document.getElementById('jumlah-hari').value = data.lama_hari;
        document.getElementById('jumlah-ruangan').value = data.jumlah_ruangan ?? '';
        document.getElementById('jumlah-pc').value = data.jumlah_pc ?? '';

        // Render tanggal inputs dengan data yang ada
        const tanggalArray = JSON.parse(data.tanggal_peminjaman || '[]');
        renderTanggalInputsWithPrefill(tanggalArray);

        // Update form action URL
        const form = document.querySelector('#modalOverlayUpdate form');
        form.action = `/admin/peminjaman/update/${id}`;

        // Tampilkan modal update
        const modal = document.querySelector('#modalOverlayUpdate .bg-white');
        modalOverlayUpdate.classList.remove('opacity-0', 'invisible');
        modalOverlayUpdate.classList.add('opacity-100', 'visible');

        setTimeout(() => {
            modal.classList.remove('scale-75', '-translate-y-12');
            modal.classList.add('scale-100', 'translate-y-0');
        }, 10);

        document.body.style.overflow = 'hidden';
    }

    function closeModalUpdate() {
        const modal = document.querySelector('#modalOverlayUpdate .bg-white');
        modal.classList.remove('scale-100', 'translate-y-0');
        modal.classList.add('scale-75', '-translate-y-12');

        setTimeout(() => {
            modalOverlayUpdate.classList.remove('opacity-100', 'visible');
            modalOverlayUpdate.classList.add('opacity-0', 'invisible');
        }, 200);

        document.body.style.overflow = 'auto';
        currentPeminjamanId = null;
    }

    // TANGGAL INPUT FUNCTIONS
    function renderTanggalInputs() {
        const container = document.getElementById("tanggal-peminjaman-container");
        const jumlahHari = parseInt(document.getElementById("jumlah-hari").value) || 1;

        container.innerHTML = "";

        for (let i = 0; i < jumlahHari; i++) {
            const wrapper = document.createElement("div");
            wrapper.classList.add("flex", "space-x-2", "items-center", "mb-2");

            const label = document.createElement("label");
            label.innerText = `Hari ke-${i + 1}:`;
            label.classList.add("w-24", "text-sm", "text-gray-700");

            const input = document.createElement("input");
            input.type = "date";
            input.className = "flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500";
            input.name = `tanggal_peminjaman[${i}]`;
            input.required = true;

            const btn = document.createElement("button");
            btn.type = "button";
            btn.className = "bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-md transition-colors";
            btn.innerText = "Hapus";
            btn.onclick = function () {
                if (container.children.length <= 1) {
                    alert("Minimal harus ada 1 hari.");
                    return;
                }

                wrapper.remove();
                document.getElementById("jumlah-hari").value = container.children.length;

                // Reindex labels
                Array.from(container.children).forEach((child, index) => {
                    const label = child.querySelector("label");
                    const input = child.querySelector("input");
                    if (label) label.innerText = `Hari ke-${index + 1}:`;
                    if (input) input.name = `tanggal_peminjaman[${index}]`;
                });
            };

            wrapper.appendChild(label);
            wrapper.appendChild(input);
            wrapper.appendChild(btn);
            container.appendChild(wrapper);
        }
    }

    function renderTanggalInputsWithPrefill(dates = []) {
        const container = document.getElementById("tanggal-peminjaman-container");
        const jumlahHari = parseInt(document.getElementById("jumlah-hari").value) || 1;

        container.innerHTML = "";

        for (let i = 0; i < jumlahHari; i++) {
            const wrapper = document.createElement("div");
            wrapper.classList.add("flex", "space-x-2", "items-center", "mb-2");

            const label = document.createElement("label");
            label.innerText = `Hari ke-${i + 1}:`;
            label.classList.add("w-24", "text-sm", "text-gray-700");

            const input = document.createElement("input");
            input.type = "date";
            input.className = "flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500";
            input.name = `tanggal_peminjaman[${i}]`;
            input.value = dates[i] || "";
            input.required = true;

               // Atur minimal tanggal besok
            const today = new Date();
            today.setDate(today.getDate() + 1);
            input.min = today.toISOString().split('T')[0];

            input.addEventListener('change', validateTanggalUrutan);

            const btn = document.createElement("button");
            btn.type = "button";
            btn.className = "bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-md transition-colors";
            btn.innerText = "Hapus";
            btn.onclick = function () {
                if (container.children.length <= 1) {
                    alert("Minimal harus ada 1 hari.");
                    return;
                }

                wrapper.remove();
                document.getElementById("jumlah-hari").value = container.children.length;

                // Reindex labels
                Array.from(container.children).forEach((child, index) => {
                    const label = child.querySelector("label");
                    const input = child.querySelector("input");
                    if (label) label.innerText = `Hari ke-${index + 1}:`;
                    if (input) input.name = `tanggal_peminjaman[${index}]`;
                });
            };

            wrapper.appendChild(label);
            wrapper.appendChild(input);
            wrapper.appendChild(btn);
            container.appendChild(wrapper);
        }
    }


    function tambahTanggalInput() {
        const container = document.getElementById("tanggal-peminjaman-container");

        const wrapper = document.createElement("div");
        wrapper.classList.add("flex", "space-x-2", "items-center");

        const label = document.createElement("label");
        label.innerText = `Hari ke-${container.children.length + 1}:`;
        label.classList.add("w-24", "text-sm", "text-gray-700");

        const input = document.createElement("input");
        input.type = "date";
        input.name = "tanggal_peminjaman[]";
        input.required = true;
        input.className = "flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500";

        // Atur minimal tanggal adalah besok
        const today = new Date();
        today.setDate(today.getDate() + 1);
        const minDate = today.toISOString().split('T')[0];
        input.min = minDate;

        input.addEventListener('change', validateTanggalUrutan);

        const btn = document.createElement("button");
        btn.type = "button";
        btn.className = "bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-md transition-colors";
        btn.innerText = "Hapus";
        btn.onclick = function () {
            if (container.children.length <= 1) {
                alert("Minimal satu hari peminjaman.");
                return;
            }
            wrapper.remove();
            updateLabelTanggal();
        };

        wrapper.appendChild(label);
        wrapper.appendChild(input);
        wrapper.appendChild(btn);
        container.appendChild(wrapper);

        updateLabelTanggal();
    }

    // Update label & jumlah hari
    function updateLabelTanggal() {
        const container = document.getElementById("tanggal-peminjaman-container");
        const children = container.children;
        for (let i = 0; i < children.length; i++) {
            const label = children[i].querySelector("label");
            label.innerText = `Hari ke-${i + 1}:`;
        }
        document.getElementById("jumlah-hari").value = children.length;
    }


    function updateLabelTanggal() {
        const container = document.getElementById("tanggal-peminjaman-container");
        const children = container.children;
        for (let i = 0; i < children.length; i++) {
            const label = children[i].querySelector("label");
            label.innerText = `Hari ke-${i + 1}:`;
        }
        document.getElementById("jumlah-hari").value = children.length;
    }

    function validateTanggalUrutan() {
        const container = document.getElementById("tanggal-peminjaman-container");
        const inputs = container.querySelectorAll('input[type="date"]');
        for (let i = 1; i < inputs.length; i++) {
            const prevDate = new Date(inputs[i - 1].value);
            const currentDate = new Date(inputs[i].value);
            if (inputs[i].value && inputs[i - 1].value && currentDate <= prevDate) {
                alert(`Tanggal pada Hari ke-${i + 1} tidak boleh sebelum atau sama dengan Hari ke-${i}. Harap pilih ulang.`);
                inputs[i].value = "";
                inputs[i].focus();
                return false;
            }
        }
        return true;
    }

    async function handleSubmit(event) {
        event.preventDefault();

        if (!validateTanggalUrutan()) {
            Swal.fire({
                icon: 'warning',
                title: 'Tanggal tidak valid!',
                toast: true,
                position: 'bottom-end',
                timer: 3000,
                showConfirmButton: false
            });
            return;
        }

        const form = document.getElementById('updatePeminjamanForm');
        const url = form.action; // pastikan action sudah di-set dengan benar
        const formData = new FormData(form);

        try {
            const response = await fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            });

            if (!response.ok) {
                const errorData = await response.json();
                console.error(errorData);
                throw new Error('Gagal memperbarui data');
            }

            const result = await response.json();

            Swal.fire({
                icon: 'success',
                title: 'Data berhasil diperbarui.',
                toast: true,
                position: 'bottom-end',
                timer: 3000,
                showConfirmButton: false
            });

            closeModalUpdate(); // jika ingin modal langsung tertutup
            fetchPeminjamanData(); // jika ingin table auto refresh

        } catch (error) {
            console.error(error);
            Swal.fire({
                icon: 'error',
                title: 'Gagal memperbarui data',
                text: error.message,
                toast: true,
                position: 'bottom-end',
                timer: 3000,
                showConfirmButton: false
            });
        }
    }

    function batalUpdate() {
    Swal.fire({
        title: 'Batalkan Perubahan?',
        text: "Semua perubahan yang sudah diisi akan hilang.",
        icon: 'warning',
        confirmButtonColor: '#6c757d', // Tombol batal: abu-abu
        cancelButtonColor: '#3085d6',  // Tombol kembali: biru muda
        showCancelButton: true,
        confirmButtonText: 'Ya, batalkan',
        cancelButtonText: 'Kembali',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
        closeModalUpdate(); // Panggil function tutup modal di sini
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


    function deletePeminjaman(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data yang dihapus tidak dapat dikembalikan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e3342f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/peminjaman/delete/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Gagal menghapus data');
                    }
                    return response.json();
                })
                .then(data => {
                    // Hapus baris tabel tanpa reload
                    const row = document.querySelector(`button[onclick="deletePeminjaman(${id})"]`).closest('tr');
                    row.remove();
                    fetchPeminjamanData()

                    // Tampilkan toast sukses SweetAlert
                    Swal.fire({
                        toast: true,
                        position: 'bottom-end',
                        icon: 'success',
                        title: 'Data berhasil dihapus.',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    });
                })
                .catch(error => {
                    console.error(error);

                    Swal.fire({
                        toast: true,
                        position: 'bottom-end',
                        icon: 'error',
                        title: 'Gagal menghapus data',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    });
                });
            }
        });
    }




    // EVENT LISTENERS
    // Close modal saat click overlay
    modalOverlayDetail?.addEventListener('click', function(e) {
        if (e.target === modalOverlayDetail) {
            closeModalDetail();
        }
    });

    modalOverlayUpdate?.addEventListener('click', function(e) {
        if (e.target === modalOverlayUpdate) {
            closeModalUpdate();
        }
    });

    // Close modal dengan ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (modalOverlayDetail?.classList.contains('visible')) {
                closeModalDetail();
            }
            if (modalOverlayUpdate?.classList.contains('visible')) {
                closeModalUpdate();
            }
        }
    });

    // Initial render saat page load
    document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById("tanggal-peminjaman-container")) {
            renderTanggalInputsWithPrefill();
        }
    });


    </script>

@if(session('tambahPeminjamanSuccess'))
    <script>
    Swal.fire({
        toast: true,
        position: 'bottom-end',
        icon: 'success',
        title: '{{ session('tambahPeminjamanSuccess') }}',
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true
    });
    </script>
@endif

@if(session('batalSuccess'))
    <script>
        Swal.fire({
            toast: true,
            position: 'bottom-end',
            icon: 'info',
            title: '{{ session('batalSuccess') }}',
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true
        });
        </script>
    @endif
@endsection
