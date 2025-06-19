@extends('layouts.admin-layout')

@section('title', 'Peminjaman')

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
              class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider"
              scope="col"
            >
              NO
            </th>
            <th
              class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider"
              scope="col"
            >
              NOMOR SURAT
            </th>
            <th
              class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider"
              scope="col"
            >
              ASAL SURAT
            </th>
            <th
              class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider"
              scope="col"
            >
              NAMA PEMINJAM
            </th>
            <th
              class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider"
              scope="col"
            >
              LAMA PEMINJAM
            </th>
            <th
              class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider"
              scope="col"
            >
              STATUS
            </th>
            <th
              class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider"
              scope="col"
            >
              ACTION
            </th>
          </tr>
        </thead>
       <tbody class="divide-y divide-gray-200">
@foreach (  $peminjamans as $peminjaman)
  <tr>
    <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-700 font-normal">
      {{ $loop->iteration}}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900 font-normal">
      {{ $peminjaman->nomor_surat }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-700 font-normal">
      {{ $peminjaman->asal_surat }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-700 font-normal">
      {{ $peminjaman->nama_peminjam }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900 font-normal">
      {{ $peminjaman->lama_hari }} Hari
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-xs font-semibold text-yellow-400">
      {{$peminjaman->status}}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-xs text-blue-600 font-normal cursor-pointer hover:underline">
      <div class="flex items-center gap-x-2">
        <button onclick="openModalDetail({{ $peminjaman->id }})">
            <img src="{{ asset('assets/images/icon/action-view-icon.svg') }}" alt="View" />
        </button>
        <button onclick="openModalUpdate()">
          <img src="{{ asset('assets/images/icon/action-edit-icon.svg') }}" alt="Edit action icon"/>
        </button>
        <a href="#">
          <img src="{{ asset('assets/images/icon/action-delete-icon.svg') }}" alt="Delete action icon"/>
        </a>
      </div>
    </td>
  </tr>
@endforeach
</tbody>

      </table>
      <div
        class="mt-6 flex flex-col md:flex-row md:items-center md:justify-between text-xs text-gray-500 px-7 pb-5 font-light"
      >
        <div class="mb-3 md:mb-0 flex items-center gap-1">
          <span>Showing</span>
          <select
            title="p"
            class="border border-gray-200 rounded px-2 py-1 text-xs text-gray-500 focus:outline-none focus:ring-1 focus:ring-[#0d5c5c]"
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
                  // Get DOM elements
        const openModalBtn = document.getElementById('openModalBtn');
        const modalOverlayDetail = document.getElementById('modalOverlayDetail');
        const modalOverlayUpdate = document.getElementById('modalOverlayUpdate');
        const modal = document.getElementById('modal');
        const closeBtn = document.getElementById('closeBtn');

        // DETAIL MODAL
        // Function to open modal with smooth animation
        function openModalDetail() {
            modalOverlayDetail.classList.remove('opacity-0', 'invisible');
            modalOverlayDetail.classList.add('opacity-100', 'visible');

            // Small delay to ensure overlay is visible before animating modal
            setTimeout(() => {
                modal.classList.remove('scale-75', '-translate-y-12');
                modal.classList.add('scale-100', 'translate-y-0');
            }, 10);

            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }

        // CLOSE MODAL DETAIL
        // Function to close modal with smooth animation
        function closeModalDetail() {
            modal.classList.remove('scale-100', 'translate-y-0');
            modal.classList.add('scale-75', '-translate-y-12');

            // Wait for modal animation to complete before hiding overlay
            setTimeout(() => {
                modalOverlayDetail.classList.remove('opacity-100', 'visible');
                modalOverlayDetail.classList.add('opacity-0', 'invisible');
            }, 200);

            document.body.style.overflow = 'auto'; // Restore scrolling
        }

        // UPDATE MODAL
        // Function to open modal with smooth animation
        function openModalUpdate() {
            modalOverlayUpdate.classList.remove('opacity-0', 'invisible');
            modalOverlayUpdate.classList.add('opacity-100', 'visible');

            // Small delay to ensure overlay is visible before animating modal
            setTimeout(() => {
                modal.classList.remove('scale-75', '-translate-y-12');
                modal.classList.add('scale-100', 'translate-y-0');
            }, 10);

            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }

        // CLOSE MODAL UPDATE
        // Function to close modal with smooth animation
        function closeModalUpdate() {
            modal.classList.remove('scale-100', 'translate-y-0');
            modal.classList.add('scale-75', '-translate-y-12');

            // Wait for modal animation to complete before hiding overlay
            setTimeout(() => {
                modalOverlayUpdate.classList.remove('opacity-100', 'visible');
                modalOverlayUpdate.classList.add('opacity-0', 'invisible');
            }, 200);

            document.body.style.overflow = 'auto'; // Restore scrolling
        }


        // Event listeners
        // openModalBtn.addEventListener('click', openModal);
        // closeBtn.addEventListener('click', closeModal);

        // Close modal when clicking on overlay (outside the modal)
        modalOverlayDetail.addEventListener('click', function(e) {
            if (e.target === modalOverlayDetail) {
                closeModalDetail();
            }
            if (e.target === modalOverlayUpdate) {
                closeModalUpdate();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modalOverlayDetail.classList.contains('visible')) {
                closeModalDetail();
            }
            if (e.key === 'Escape' && modalOverlayUpdate.classList.contains('visible')) {
                closeModalUpdate();
            }
        });


        //UPDATE FORM

        function renderTanggalInputs() {
            const container = document.getElementById("tanggal-peminjaman-container");
            const jumlahHari = parseInt(document.getElementById("jumlah-hari").value);

            // Clear existing inputs
            container.innerHTML = "";

            for (let i = 0; i < jumlahHari; i++) {
            const wrapper = document.createElement("div");
            wrapper.classList.add("flex", "space-x-2", "items-center");

            const label = document.createElement("label");
            label.innerText = `Hari ke-${i + 1}:`;
            label.classList.add("w-24", "text-sm", "text-gray-700");

            const input = document.createElement("input");
            input.type = "date";
            input.className =
                "flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500";
            input.name = `tanggal-hari-${i + 1}`;

            const btn = document.createElement("button");
            btn.type = "button";
            btn.className =
                "bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-md transition-colors";
            btn.innerText = "Hapus";
            btn.onclick = function () {
                const container = document.getElementById("tanggal-peminjaman-container");

                if (container.children.length <= 1) {
                    alert("Minimal harus ada 1 hari.");
                    return;
                }

                wrapper.remove();

                // Update jumlah hari
                document.getElementById("jumlah-hari").value = container.children.length;

                // Reindex semua label setelah penghapusan
                Array.from(container.children).forEach((child, index) => {
                    const label = child.querySelector("label");
                    if (label) {
                    label.innerText = `Hari ke-${index + 1}:`;
                    }
                });
            };


            wrapper.appendChild(label);
            wrapper.appendChild(input);
            wrapper.appendChild(btn);
            container.appendChild(wrapper);
            }
        }

    // Initial render
    window.onload = renderTanggalInputs;

     const peminjamanData = @json($peminjamans);

    function openModalDetail(id) {
        const data = peminjamanData.find(p => p.id === id);
        if (!data) return;

        document.getElementById('modal_nomor_surat').innerText = `: ${data.nomor_surat}`;
        document.getElementById('modal_asal_surat').innerText = `: ${data.asal_surat}`;
        document.getElementById('modal_nama_peminjam').innerText = `: ${data.nama_peminjam}`;
        document.getElementById('modal_lama_peminjam').innerText = `: ${data.lama_hari} hari`;
        document.getElementById('modal_status').innerText = data.status ?? 'Menunggu';

        // render tanggal
        const container = document.getElementById('modal_tanggal_peminjam');
        container.innerHTML = '';
        data.tanggal_formatted.forEach(tgl => {
            const div = document.createElement('div');
            div.innerText = `- ${tgl}`;
            container.appendChild(div);
        });

        // Tampilkan modal
        const modalOverlay = document.getElementById('modalOverlayDetail');
        const modal = document.getElementById('modal');
        modalOverlay.classList.remove('opacity-0', 'invisible');
        modalOverlay.classList.add('opacity-100', 'visible');
        setTimeout(() => {
            modal.classList.remove('scale-75', '-translate-y-12');
            modal.classList.add('scale-100', 'translate-y-0');
        }, 10);
        document.body.style.overflow = 'hidden';
    }
    </script>
@endsection
