<!-- Modal Container -->
<div
  id="modalUpdate"
  class="w-full max-w-3xl mx-auto bg-white rounded-xl overflow-hidden shadow-2xl transform transition-all duration-300 relative scale-95"
>

  <!-- Modal Header -->
  <div class="bg-teal-800 text-white flex items-center justify-between px-6 py-4">
    <h2 class="text-lg font-semibold">Form Input Surat Peminjaman</h2>
    <button
      id="closeBtn"
      onclick="closeModalUpdate()"
      class="p-1 rounded hover:bg-white hover:bg-opacity-10 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50 transition"
    >
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
      </svg>
    </button>
  </div>

  <!-- Modal Body -->
  <div class="px-6 py-6 max-h-[80vh] overflow-y-auto">

    <form method="POST" onsubmit="handleSubmit(event)" enctype="multipart/form-data" id="updatePeminjamanForm">
      @csrf
      @method('PUT')

      <!-- Nomor Surat -->
      <div>
        <label for="nomor-surat" class="block text-sm font-medium text-gray-700 mb-1">Nomor Surat</label>
        <input
          id="nomor-surat"
          name="nomor_surat"
          type="text"
          required
          class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-600"
        />
      </div>

      <!-- Asal Surat -->
      <div class="mt-5">
        <label for="asal-surat" class="block text-sm font-medium text-gray-700 mb-1">Asal Surat</label>
        <input
          id="asal-surat"
          name="asal_surat"
          type="text"
          required
          class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-600"
        />
      </div>

      <!-- Nama Peminjam -->
      <div class="mt-5">
        <label for="nama-peminjam" class="block text-sm font-medium text-gray-700 mb-1">Nama Peminjam</label>
        <input
          id="nama-peminjam"
          name="nama_peminjam"
          type="text"
          required
          class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-600"
        />
      </div>

      <!-- Jumlah Hari -->
      <div class="mt-5">
        <label for="jumlah-hari" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Hari</label>
        <input
          id="jumlah-hari"
          name="jumlah_hari"
          type="number"
          min="1"
          value="1"
          readonly
          class="w-full border border-gray-300 rounded-md px-3 py-2 bg-gray-100 cursor-not-allowed"
        />
      </div>

      <!-- Tanggal Peminjaman Dinamis -->
      <div class="mt-5">
        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Peminjaman</label>
        <div id="tanggal-peminjaman-container" class="space-y-2"></div>
        <button
          type="button"
          onclick="tambahTanggalInput()"
          class="mt-3 bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-md transition"
        >
          Tambah Tanggal
        </button>
      </div>

      <!-- Jumlah Ruangan -->
      <div class="mt-5">
        <label for="jumlah-ruangan" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Ruangan</label>
        <input
          id="jumlah-ruangan"
          name="jumlah_ruangan"
          type="number"
          min="0"
          class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-600"
        />
      </div>

      <!-- Jumlah PC -->
      <div class="mt-5">
        <label for="jumlah-pc" class="block text-sm font-medium text-gray-700 mb-1">Jumlah PC</label>
        <input
          id="jumlah-pc"
          name="jumlah_pc"
          type="number"
          min="0"
          class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-600"
        />
      </div>

      <!-- Lampiran -->
      <div class="mt-5">
        <label for="lampiran" class="block text-sm font-medium text-gray-700 mb-1">Lampiran</label>
        <input
          id="lampiran"
          name="lampiran"
          type="file"
          accept=".pdf"
          class="w-full border border-gray-300 rounded-md px-3 py-2 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-teal-600"
        />
        <p class="text-xs text-gray-500 mt-1">Hanya file PDF, maksimum 2 MB</p>
      </div>

      <!-- Buttons -->
      <div class="flex justify-end gap-3 pt-6">
        <button
          type="button"
          onclick="closeModalUpdate()"
          class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-md transition"
        >
          Batal
        </button>
        <button
          type="submit"
          class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-md transition"
        >
          Simpan
        </button>
      </div>

    </form>
  </div>
</div>
