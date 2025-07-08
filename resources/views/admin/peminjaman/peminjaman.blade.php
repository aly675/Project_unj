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
            font-weight: 500;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
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


    <h2 class="text-gray-900 font-extrabold text-2xl mb-6">Peminjaman</h2>
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
      <div class="flex gap-3 flex-1 max-w-md">
        <div class="relative flex-1">
          <input
            class="w-full border border-gray-300 rounded-md py-2 pl-3 pr-10 text-sm text-gray-600 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-700 focus:border-transparent"
            placeholder="Search..."
            type="text"
          />
          <i
            class="fas fa-search absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm pointer-events-none"
          ></i>
        </div>
        <select
          title="t"
          name=""
          id=""
          class="border border-gray-300 rounded-md py-2 px-3 text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-teal-700 focus:border-transparent"
        >
          <option>Status : All</option>
          <option>Pending</option>
          <option>Completed</option>
          <option>Cancelled</option>
        </select>
      </div>
      <a
        href="{{route('admin.tambah-peminjaman-page')}}"
        class="bg-teal-800 text-white rounded-full px-6 py-2 text-sm font-semibold hover:bg-teal-900 transition-colors whitespace-nowrap">
        Tambah Data
      </a>
    </div>
    <div class="overflow-x-auto bg-white rounded-lg shadow">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th
              class="px-6 py-3 text-left text-sm font-semibold text-gray-400 uppercase tracking-wider"
              scope="col"
            >
              NO
            </th>
            <th
              class="px-6 py-3 text-left text-sm font-semibold text-gray-400 uppercase tracking-wider"
              scope="col"
            >
              NOMOR SURAT
            </th>
            <th
              class="px-6 py-3 text-left text-sm font-semibold text-gray-400 uppercase tracking-wider"
              scope="col"
            >
              ASAL SURAT
            </th>
            <th
              class="px-6 py-3 text-left text-sm font-semibold text-gray-400 uppercase tracking-wider"
              scope="col"
            >
              NAMA PEMINJAM
            </th>
            <th
              class="px-6 py-3 text-left text-sm font-semibold text-gray-400 uppercase tracking-wider"
              scope="col"
            >
              LAMA PEMINJAM
            </th>
            <th
              class="px-6 py-3 text-left text-sm font-semibold text-gray-400 uppercase tracking-wider"
              scope="col"
            >
              STATUS
            </th>
            <th
              class="px-6 py-3 text-left text-sm font-semibold text-gray-400 uppercase tracking-wider"
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
      <div
        class="mt-6 flex flex-col md:flex-row md:items-center md:justify-between text-sm text-gray-500 px-7 pb-5 font-light"
      >
        <div class="mb-3 md:mb-0 flex items-center gap-1">
          <span>Showing</span>
          <select
            title="p"
            class="border border-gray-200 rounded px-2 py-1 text-sm text-gray-500 focus:outline-none focus:ring-1 focus:ring-[#0d5c5c]"
          >
            <option>10</option>
            <option>20</option>
            <option>50</option>
          </select>
          <span>of 50</span>
        </div>
        <nav
          class="flex items-center gap-1 select-none"
          role="navigation"
          aria-label="Pagination Navigation"
        >
          <button
            aria-label="Previous page"
            class="border border-gray-200 rounded px-2 py-1 text-gray-400 cursor-not-allowed"
            disabled
            tabindex="-1"
          >
            &lt;
          </button>
          <button
            aria-current="page"
            class="border border-gray-200 rounded px-2 py-1 bg-[#0d5c5c] text-white"
            tabindex="0"
          >
            1
          </button>
          <button
            class="border border-gray-200 rounded px-2 py-1 hover:bg-gray-100"
            tabindex="0"
          >
            2
          </button>
          <button
            class="border border-gray-200 rounded px-2 py-1 hover:bg-gray-100"
            tabindex="0"
          >
            3
          </button>
          <button
            class="border border-gray-200 rounded px-2 py-1 hover:bg-gray-100"
            tabindex="0"
          >
            4
          </button>
          <button
            class="border border-gray-200 rounded px-2 py-1 hover:bg-gray-100"
            tabindex="0"
          >
            5
          </button>
          <button
            aria-label="Next page"
            class="border border-gray-200 rounded px-2 py-1 text-gray-400 hover:bg-gray-100"
            tabindex="0"
          >
            &gt;
          </button>
        </nav>
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
 // Fixed JavaScript code untuk update peminjaman

    function fetchPeminjamanData() {
        fetch('{{ route('admin.peminjaman-json') }}')
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('peminjaman-table-body');
                tbody.innerHTML = '';
                data.data.forEach((peminjaman, index) => {
                    const tr = document.createElement('tr');

                    tr.innerHTML = `
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-normal">${index + 1}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-normal">${peminjaman.nomor_surat}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-normal">${peminjaman.asal_surat}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-normal">${peminjaman.nama_peminjam}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-normal">${peminjaman.lama_hari} Hari</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold">
                            ${getStatusBadge(peminjaman.status)}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 font-normal cursor-pointer hover:underline">
                            ${getActionButtons(peminjaman)}
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

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

    function getActionButtons(peminjaman) {
        if (peminjaman.status === 'Diterima' || peminjaman.status === 'Ditolak') {
            return `<a href="/admin/peminjaman/cetak-pdf-balasan/${peminjaman.id}"
                    target="_blank"
                    class="print-out-button block w-full text-center text-center text-sm"
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
    function openModalDetail(id) {
        const data = peminjamanData.find(p => p.id === id);
        if (!data) return;

        document.getElementById('modal_nomor_surat').innerText = `: ${data.nomor_surat}`;
        document.getElementById('modal_asal_surat').innerText = `: ${data.asal_surat}`;
        document.getElementById('modal_nama_peminjam').innerText = `: ${data.nama_peminjam}`;
        document.getElementById('modal_jumlah_ruangan').innerText = `: ${data.jumlah_ruangan}`;
        document.getElementById('modal_jumlah_pc').innerText = `: ${data.jumlah_pc}`;
        document.getElementById('modal_lama_peminjam').innerText = `: ${data.lama_hari} hari`;
        const statusElement = document.getElementById('modal_status');
        statusElement.innerText = data.status ?? 'Menunggu';
        // Reset semua class warna sebelumnya
        statusElement.className = 'inline-flex px-2 py-1 text-sm font-medium rounded-full ' + getStatusClasses(data.status);
        const lampiranLink = document.getElementById('modal_lampiran_link');
        if (data.lampiran) {
            lampiranLink.href = `/storage/${data.lampiran}`;
            lampiranLink.classList.remove('hidden');
        } else {
            lampiranLink.href = `/storage/`;
        }

        // Render tanggal
        const container = document.getElementById('modal_tanggal_peminjam');
        container.innerHTML = '';
        data.tanggal_formatted.forEach(tgl => {
            const div = document.createElement('div');
            div.innerText = `- ${tgl}`;
            container.appendChild(div);
        });

        // Tampilkan modal detail
        const modal = document.querySelector('#modalOverlayDetail .bg-white');
        modalOverlayDetail.classList.remove('opacity-0', 'invisible');
        modalOverlayDetail.classList.add('opacity-100', 'visible');

        setTimeout(() => {
            modal.classList.remove('scale-75', '-translate-y-12');
            modal.classList.add('scale-100', 'translate-y-0');
        }, 10);

        document.body.style.overflow = 'hidden';
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
                title: 'Data berhasil diperbarui!',
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



    function deletePeminjaman(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data akan terhapus permanen.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
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

                    // Tampilkan toast sukses SweetAlert
                    Swal.fire({
                        toast: true,
                        position: 'bottom-end',
                        icon: 'success',
                        title: 'Data berhasil dihapus',
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

@endsection
