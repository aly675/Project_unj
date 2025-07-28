@extends('layouts.kepala-upt-layout')

@section('title', 'Pengajuan Surat')

@section('page', 'Pengajuan Surat')

@section('style')
<script>
    tailwind.config = {
        theme: {
            extend: {
                animation: {
                    'modal-show': 'modal-show 0.3s cubic-bezier(0.34, 1.56, 0.64, 1)',
                    'fade-in': 'fade-in 0.3s ease-out',
                },
                keyframes: {
                    'modal-show': {
                        '0%': {
                            transform: 'scale(0.7) translateY(-50px)',
                            opacity: '0'
                        },
                        '100%': {
                            transform: 'scale(1) translateY(0)',
                            opacity: '1'
                        }
                    },
                    'fade-in': {
                        '0%': { opacity: '0' },
                        '100%': { opacity: '1' }
                    }
                }
            }
        }
    }
</script>
<style>
    .modal-enter {
        animation: modal-show 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
    }

    .modal-overlay-enter {
        animation: fade-in 0.3s ease-out forwards;
    }

    .date-scroll::-webkit-scrollbar {
        width: 6px;
    }

    .date-scroll::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 3px;
    }

    .date-scroll::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }

    .date-scroll::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>
@endsection

@section('main')

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                    <h1 class="flex text-2xl mr-5 font-semibold text-gray-900">Pengajuan Surat</h1>
                    <div class="flex gap-4">
                        <div class="relative">
                            <input type="text" id="search-input" placeholder="Search" class="pl-8 pr-4 py-2 border rounded-lg text-sm w-64">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 absolute left-2.5 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-gray-500">Sort by Status:</span>
                            <select id="sort-select" class="border border-gray-300 rounded px-2 py-1 text-sm">
                                <option value="diterima">All</option>
                                <option value="diterima">Diterima</option>
                                <option value="ditolak">Ditolak</option>
                                <option value="menunggu-persetujuan">Menunggu Persetujuan</option>
                            </select>
                        </div>
                    </div>
                </div>

<!-- Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NO</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NOMOR SURAT</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NAMA PEMINJAM</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">STATUS</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">AKSI</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($peminjamans as $data)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$loop->iteration}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$data->nomor_surat}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$data->nama_peminjam}}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span @class([
                            'inline-flex px-2 py-1 text-xs font-medium rounded-full',
                            'bg-green-100 text-green-800' => $data->status === 'Diterima' || 'Menunggu Verifikasi',
                            'bg-red-100 text-red-800' => $data->status === 'Ditolak',
                            'bg-yellow-100 text-yellow-800' => $data->status === 'Menunggu Persetujuan',
                            ])
                            @class(['p-4', 'font-bold' => true])
                            >
                            {{-- {{ $data->status === 'Menunggu Verifikasi' ? 'Disetujui' : $data->status }} --}}
                            @if($data->status === 'Ditolak')
                                Ditolak
                                @elseif ($data->status === 'Menunggu Persetujuan')
                                Menunggu Persetujuan
                                @else
                                disetujui
                            @endif
                        </span>


                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button onclick="openModal({{ $data->id }})" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm font-medium transition-colors">Detail</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Detail Surat --}}
@include('kepalaUpt.pengajuan-surat.detail-surat')

@endsection

@section('js')
<script>
        // ID peminjaman yang sedang dipilih// Variabel global untuk menyimpan ID pengajuan yang sedang dipilih
    let selectedId = null;

    // Baris ini mengasumsikan Anda melewatkan data 'peminjamans' dari controller Laravel Anda
    // ke view Blade sebagai array JSON.
    const peminjamanData = @json($peminjamans);

    /**
     * Membuka modal detail dengan data untuk ID pengajuan yang diberikan.
     * @param {number} id - ID peminjaman (pengajuan).
     */
    function openModal(id) {
        selectedId = id;

        // Cari data untuk ID yang dipilih
        const data = peminjamanData.find(p => p.id === id);
        if (!data) {
            alert("Data tidak ditemukan!");
            return;
        }

        // Dapatkan elemen modal
        const modalOverlay = document.getElementById("modalOverlayDetail");
        const modal = modalOverlay.querySelector(".bg-white");
        const statusEl = document.getElementById("modal_status");
        const tanggalEl = document.getElementById("modal_tanggal_peminjam");
        const suratBtn = document.getElementById("suratBtn");
        const modalBody = modal.querySelector(".px-6.py-6.space-y-4"); // Dapatkan badan modal untuk konten dinamis

        // Isi konten modal
        document.getElementById("modal_nomor_surat").innerText = `: ${data.nomor_surat}`;
        document.getElementById("modal_asal_surat").innerText = `: ${data.asal_surat}`;
        document.getElementById("modal_nama_peminjam").innerText = `: ${data.nama_peminjam}`;
        document.getElementById("modal_lama_peminjam").innerText = `: ${data.lama_hari} hari`;

        // Atur teks status dan styling
        statusEl.innerText = data.status;
        statusEl.className = "inline-flex px-2 py-1 text-sm font-medium rounded-full"; // Reset kelas

        // Terapkan kelas spesifik status
        if (data.status === "Disetujui") {
            statusEl.classList.add("bg-green-100", "text-green-800");
        } else if (data.status === "Ditolak") {
            statusEl.classList.add("bg-red-100", "text-red-800");
        } else {
            statusEl.classList.add("bg-yellow-100", "text-yellow-800");
        }

        // --- Tampilan dinamis "Alasan Ditolak" ---
        // Hapus div 'alasan' yang mungkin sudah ada dari pembukaan modal sebelumnya
        const existingAlasanDiv = modalBody.querySelector('.alasan-ditolak-container');
        if (existingAlasanDiv) {
            existingAlasanDiv.remove();
        }

        // Tambahkan 'Alasan Ditolak' jika statusnya 'Ditolak' dan alasan ada
        if (data.status === "Ditolak" && data.alasan_penolakan) {
            const alasanContainer = document.createElement("div");
            alasanContainer.classList.add("flex", "flex-col", "sm:flex-row", "sm:items-start", "alasan-ditolak-container"); // Tambahkan kelas untuk memudahkan penghapusan
            alasanContainer.innerHTML = `
                <span class="font-medium text-gray-700 sm:min-w-[140px] sm:mr-4 mb-1 sm:mb-0">Alasan Ditolak</span>
                <span class="text-red-700 font-semibold">: ${data.alasan_penolakan}</span>
            `;
            // Sisipkan tepat sebelum bagian "Tanggal Peminjam"
            tanggalEl.parentElement.parentElement.insertAdjacentElement("beforebegin", alasanContainer);
        }
        // --- Akhir Tampilan dinamis "Alasan Ditolak" ---


        // Isi Tanggal Peminjam
        tanggalEl.innerHTML = ""; // Bersihkan tanggal sebelumnya
        if (Array.isArray(data.tanggal_formatted)) {
            data.tanggal_formatted.forEach(tgl => {
                const el = document.createElement("div");
                el.innerText = `- ${tgl}`;
                tanggalEl.appendChild(el);
            });
        }

        // Atur tautan untuk surat pengajuan
        suratBtn.href = `/storage/${data.lampiran}`;

        // Tampilkan overlay modal dan terapkan animasi masuk
        modalOverlay.classList.remove("opacity-0", "invisible");
        modalOverlay.classList.add("opacity-100", "visible");

        setTimeout(() => {
            modal.classList.remove("scale-75", "-translate-y-12");
            modal.classList.add("scale-100", "translate-y-0");
        }, 10); // Penundaan kecil untuk animasi yang lebih mulus

        // Nonaktifkan scroll body saat modal terbuka
        document.body.style.overflow = "hidden";
    }

    /**
     * Menutup modal detail.
     */
    function closeModalDetail() {
        const modalOverlay = document.getElementById("modalOverlayDetail");
        const modal = modalOverlay.querySelector(".bg-white");

        // Terapkan animasi keluar
        modal.classList.remove("scale-100", "translate-y-0");
        modal.classList.add("scale-75", "-translate-y-12");

        setTimeout(() => {
            // Sembunyikan overlay modal setelah animasi selesai
            modalOverlay.classList.remove("opacity-100", "visible");
            modalOverlay.classList.add("opacity-0", "invisible");
            // Aktifkan kembali scroll body
            document.body.style.overflow = "auto";
        }, 200); // Sesuaikan dengan durasi transisi CSS
    }

    /**
     * Membuka modal alasan penolakan.
     */
    function openModalAlasan() {
        const modal = document.getElementById("modalAlasan");
        modal.classList.remove("opacity-0", "invisible");
        modal.classList.add("opacity-100", "visible");
    }

    /**
     * Menutup modal alasan penolakan.
     */
    function closeModalAlasan() {
        const modal = document.getElementById("modalAlasan");
        modal.classList.remove("opacity-100", "visible");
        modal.classList.add("opacity-0", "invisible");
        document.getElementById("alasan").value = ''; // Kosongkan textarea saat ditutup
    }

    /**
     * Menangani pengiriman alasan penolakan.
     * Mengirim permintaan AJAX ke backend.
     * @param {Event} e - Event submit.
     */
    function submitAlasanTolak(e) {
        e.preventDefault(); // Mencegah pengiriman formulir default

        const alasan = document.getElementById("alasan").value.trim();
        if (!alasan) {
            alert("Alasan penolakan wajib diisi.");
            return;
        }

        const submitBtn = document.querySelector("#formAlasanTolak button[type='submit']");
        submitBtn.disabled = true; // Nonaktifkan tombol untuk mencegah pengiriman ganda
        submitBtn.innerText = "Mengirim..."; // Ubah teks tombol

        const urlTolak = `/kepala-upt/pengajuan-surat/${selectedId}/tolak`;
        // Kirim permintaan POST ke backend
        fetch(urlTolak,  {
                method: "POST",
                headers: {
                    // Dapatkan token CSRF dari meta tag (default Laravel)
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Content-Type": "application/json" // Menunjukkan bahwa body adalah JSON
                },
                body: JSON.stringify({ alasan: alasan }) // Kirim alasan sebagai JSON
            })
        .then(res => {
            if (!res.ok) {
                // Jika respons tidak OK (misalnya, 400, 500), parse pesan kesalahan
                return res.json().then(err => Promise.reject(err));
            }
            return res.json();
        })
        .then(res => {
            alert(res.message || "Pengajuan berhasil ditolak.");
            closeModalAlasan(); // Tutup modal penolakan
            closeModalDetail(); // Tutup modal detail
            location.reload(); // Muat ulang halaman untuk mencerminkan perubahan
        })
        .catch(err => {
            console.error("Error menolak pengajuan:", err);
            alert(err.message || "Terjadi kesalahan saat menolak. Silakan coba lagi.");
        })
        .finally(() => {
            submitBtn.disabled = false; // Aktifkan kembali tombol
            submitBtn.innerText = "Kirim"; // Kembalikan teks tombol
        });
    }

    // Event listener untuk interaksi modal setelah DOM sepenuhnya dimuat
    document.addEventListener("DOMContentLoaded", () => {
        // Event listener untuk tombol "Tolak" di dalam modal detail
        // Catatan: Kelas 'tolak-btn' ada pada tombol di footer modal.
        document.querySelectorAll(".tolak-btn").forEach(btn => {
            btn.addEventListener("click", openModalAlasan);
        });

        // Event listener untuk tombol "Kirim" di formulir alasan penolakan
        document.getElementById("formAlasanTolak").addEventListener("submit", submitAlasanTolak);

        // Event listener untuk tombol "Terima" di dalam modal detail
        document.getElementById("terimaBtn").addEventListener("click", () => {
            if (!confirm("Yakin ingin menyetujui pengajuan ini?")) {
                return;
            }

            const btn = document.getElementById("terimaBtn");
            btn.disabled = true;
            btn.innerText = "Menyetujui...";

            urlTerima = `/kepala-upt/pengajuan-surat/${selectedId}/terima`
            fetch(urlTerima,  {
                    method: "POST",
                    headers: {
                        // Dapatkan token CSRF dari meta tag (default Laravel)
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "Content-Type": "application/json" // Menunjukkan bahwa body adalah JSON
                    },
                    body: JSON.stringify({ alasan: alasan }) // Kirim alasan sebagai JSON
                })
            .then(res => {
                if (!res.ok) {
                    return res.json().then(err => Promise.reject(err));
                }
                return res.json();
            })
            .then(res => {
                alert(res.message || "Berhasil menyetujui.");
                closeModalDetail();
                location.reload();
            })
            .catch(err => {
                console.error("Error menyetujui pengajuan:", err);
                alert(err.message || "Terjadi kesalahan saat menyetujui. Silakan coba lagi.");
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerText = "Terima";
            });
        });
    });

    // Event listener global untuk menutup modal dengan tombol ESC atau klik di luar
    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
            if (document.getElementById("modalOverlayDetail").classList.contains("visible")) {
                closeModalDetail();
            }
            if (document.getElementById("modalAlasan").classList.contains("visible")) {
                closeModalAlasan();
            }
        }
    });

    document.addEventListener("click", function (e) {
        const overlayDetail = document.getElementById("modalOverlayDetail");
        const overlayAlasan = document.getElementById("modalAlasan");

        // Jika yang diklik adalah overlay modal detail itu sendiri (bukan elemen anaknya)
        if (e.target === overlayDetail && overlayDetail.classList.contains("visible")) {
            closeModalDetail();
        }
        // Jika yang diklik adalah overlay modal alasan penolakan itu sendiri (bukan elemen anaknya)
        if (e.target === overlayAlasan && overlayAlasan.classList.contains("visible")) {
            closeModalAlasan();
        }
    });
</script>
@endsection
