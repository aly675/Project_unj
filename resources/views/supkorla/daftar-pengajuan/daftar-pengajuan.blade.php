@extends('layouts.supkorla-layout')

@section('title', 'Daftar Pengajuan Surat')

@section('page', 'Daftar Pengajuan surat')

@section('style')
    <style>
    .scroll-hide::-webkit-scrollbar {
        display: none;
    }
    .scroll-hide {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;     /* Firefox */
    }

          /* Modern scrollbar */
        .scrollbar-modern {
        scrollbar-width: thin;             /* Firefox */
        scrollbar-color: #94a3b8 #f1f5f9;  /* thumb color & track color */
        }

        /* Chrome, Edge, Safari */
        .scrollbar-modern::-webkit-scrollbar {
        width: 6px;                          /* scroll bar width */
        }

        .scrollbar-modern::-webkit-scrollbar-track {
        background: #f1f5f9;                 /* light gray */
        border-radius: 100px;
        }

        .scrollbar-modern::-webkit-scrollbar-thumb {
        background-color: #94a3b8;           /* slate-400 */
        border-radius: 100px;
        border: 2px solid transparent;       /* spacing */
        background-clip: content-box;
        }
    </style>
@endsection

@section('main')

    <h1 class="text-3xl font-bold mb-6 text-[#004B50]">Pengajuan Masuk - Supkorla</h1>

    <div class="bg-white rounded-2xl shadow-lg ring-1 ring-black/5 p-6">
      <table class="w-full table-auto text-sm">
        <thead class="bg-[#F5F7FA] text-[#004B50]">
          <tr>
            <th class="p-3 text-left">Nomor Surat</th>
            <th class="p-3 text-left">Nama</th>
            <th class="p-3 text-left">Tanggal</th>
            <th class="p-3 text-left">Status</th>
            <th class="p-3 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          <tr class="hover:bg-gray-50">
            <td class="p-3">77</td>
            <td class="p-3">Bubuubu</td>
            <td class="p-3">20 Juni 2025</td>
            <td class="p-3">
              <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">
                Menunggu Verifikasi
              </span>
            </td>
            <td class="p-3 text-center">
              <button onclick="openModalVerifikasi()" class="bg-[#007D6E] hover:bg-[#00685D] text-white px-4 py-1 rounded-md text-sm shadow-sm">
                Verifikasi
              </button>
            </td>
          </tr>
          <tr class="hover:bg-gray-50">
            <td class="p-3">77</td>
            <td class="p-3">Bubuubu</td>
            <td class="p-3">20 Juni 2025</td>
            <td class="p-3">
              <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">
                Ditolak
              </span>
            </td>
            <td class="p-3 text-center">
              <button onclick="openModalVerifikasi()" class="bg-[#007D6E] hover:bg-[#00685D] text-white px-4 py-1 rounded-md text-sm shadow-sm">
                Verifikasi
              </button>
            </td>
          </tr>
          <tr class="hover:bg-gray-50">
            <td class="p-3">77</td>
            <td class="p-3">Bubuubu</td>
            <td class="p-3">20 Juni 2025</td>
            <td class="p-3">
              <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">
                Sudah Diverifikasi
              </span>
            </td>
            <td class="p-3 text-center">
              <button onclick="openModalVerifikasi()" class="bg-[#007D6E] hover:bg-[#00685D] text-white px-4 py-1 rounded-md text-sm shadow-sm">
                Verifikasi
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div id="modalOverlayVerifikasi" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 opacity-0 invisible transition-all duration-300 ease-out">
        @include('supkorla.daftar-pengajuan.verifikasi-pengajuan')
    </div>

@endsection

@section('js')
    <script>
        const ruangans = [
        { nama: "Ruang Multimedia", ac: 2, pc: 15, proyektor: 1, tersedia: true },
        { nama: "Ruang Rapat A", ac: 1, pc: 0, proyektor: 1, tersedia: false },
        { nama: "Lab Komputer 1", ac: 3, pc: 20, proyektor: 2, tersedia: true },
        { nama: "Studio Editing", ac: 2, pc: 6, proyektor: 1, tersedia: true },
        { nama: "Ruang Kelas C", ac: 1, pc: 5, proyektor: 0, tersedia: false },
        { nama: "Ruang Pelatihan", ac: 1, pc: 10, proyektor: 1, tersedia: true },
        { nama: "Studio Editing", ac: 2, pc: 6, proyektor: 1, tersedia: true },
        { nama: "Ruang Kelas C", ac: 1, pc: 5, proyektor: 0, tersedia: false },
        { nama: "Ruang Pelatihan", ac: 1, pc: 10, proyektor: 1, tersedia: true },
        ];

        const container = document.getElementById("ruangan-list");
        const jumlahPcSpan = document.getElementById("jumlah-pc");

        function openModal() {
        document.getElementById("modal").classList.remove("hidden");
        document.getElementById("modal").classList.add("flex");
        jumlahPcSpan.textContent = "-";
        }

        function closeModal() {
        document.getElementById("modal").classList.add("hidden");
        document.getElementById("modal").classList.remove("flex");
        }

        ruangans.forEach((r, index) => {
        const label = document.createElement("label");
        label.className =
            "relative flex flex-col justify-between border rounded-xl p-5 bg-white shadow-sm transition-all " +
            (r.tersedia
            ? "cursor-pointer hover:shadow-md hover:border-[#007D6E]"
            : "opacity-60 cursor-not-allowed bg-gray-100");

        const radio = document.createElement("input");
        radio.type = "radio";
        radio.name = "ruangan";
        radio.className = "mt-1";
        radio.disabled = !r.tersedia;

        if (r.tersedia) {
            radio.addEventListener("change", () => {
            jumlahPcSpan.textContent = `${r.pc} PC`;
            });
        }

        label.innerHTML = `
            <div class="flex items-start gap-4">
            <!-- Placeholder radio -->
            <div class="mt-1"></div>
            <div class="flex-1">
                <h3 class="text-base font-semibold mb-2 ${r.tersedia ? "text-gray-800" : "text-gray-500"}">
                ${r.nama}
                </h3>
                <ul class="text-sm ${r.tersedia ? "text-gray-600" : "text-gray-400"} list-disc list-inside leading-relaxed">
                <li>${r.pc} PC</li>
                </ul>
            </div>
            </div>
            <div class="flex justify-between items-center mt-4">
            ${
                !r.tersedia
                ? `<div class="bg-red-500 text-white text-xs px-2 py-1 rounded-full font-medium">Sudah Digunakan</div>`
                : `<span class="text-xs text-green-600 font-medium">Tersedia</span>`
            }
            </div>
        `;

        // Replace placeholder with radio
        label.querySelector(".mt-1").replaceWith(radio);
        container.appendChild(label);
        });




        const modalOverlayVerifikasi = document.getElementById('modalOverlayVerifikasi');

        // DETAIL MODAL FUNCTIONS
        function openModalVerifikasi() {

            // Tampilkan modal
            const modal = document.querySelector('#modalOverlayVerifikasi .bg-white');
            modalOverlayVerifikasi.classList.remove('opacity-0', 'invisible');
            modalOverlayVerifikasi.classList.add('opacity-100', 'visible');

            setTimeout(() => {
                modal.classList.remove('scale-75', '-translate-y-12');
                modal.classList.add('scale-100', 'translate-y-0');
            }, 10);

            document.body.style.overflow = 'hidden';
        }

        function closeModalVerifikasi() {
            const modal = document.querySelector('#modalOverlayverifikasi .bg-white');
            modal.classList.remove('scale-100', 'translate-y-0');
            modal.classList.add('scale-75', '-translate-y-12');

            setTimeout(() => {
                modalOverlayVerifikasi.classList.remove('opacity-100', 'visible');
                modalOverlayVerifikasi.classList.add('opacity-0', 'invisible');
            }, 200);

            document.body.style.overflow = 'auto';
        }


    </script>
@endsection
