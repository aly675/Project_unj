<!-- Modal Container -->
<div
    id="modalUpdate"
    class="bg-white w-full rounded-xl max-w-3xl mx-4 overflow-hidden shadow-2xl transform -translate-y-1.5 transition-all duration-300 relative scale-95"
>

    <!-- Modal Header -->
    <div class="bg-teal-800 text-white px-6 py-5 flex justify-between items-center">
        <h2 class="text-xl font-semibold">Edit Pengajuan Surat</h2>
        <button
            id="closeBtn"
            onclick="closeModalUpdate()"
            class="text-white hover:bg-white hover:bg-opacity-10 rounded p-1 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Modal Body -->
    <div class="px-6 py-6 space-y-4 max-h-[90vh] overflow-y-auto">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h1 class="text-xl font-semibold text-gray-800 mb-6">Form Input Surat Peminjaman</h1>

            <!-- Form menggunakan method POST biasa tanpa fetch -->
            <form method="POST" onsubmit="handleSubmit(event)" enctype="multipart/form-data" id="updatePeminjamanForm">
                @csrf
                @method('PUT')

                <!-- Nomor Surat -->
                <div class="mb-4">
                    <label for="nomor-surat" class="text-sm font-medium text-gray-700 mb-2 block">
                        Nomor Surat
                    </label>
                    <input
                        id="nomor-surat"
                        name="nomor_surat"
                        type="text"
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                    />
                </div>

                <!-- Asal Surat -->
                <div class="mb-4">
                    <label for="asal-surat" class="text-sm font-medium text-gray-700 mb-2 block">
                        Asal Surat
                    </label>
                    <input
                        id="asal-surat"
                        name="asal_surat"
                        type="text"
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                    />
                </div>

                <!-- Nama Peminjam -->
                <div class="mb-4">
                    <label for="nama-peminjam" class="text-sm font-medium text-gray-700 mb-2 block">
                        Nama Peminjam
                    </label>
                    <input
                        id="nama-peminjam"
                        name="nama_peminjam"
                        type="text"
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                    />
                </div>

                    <!-- Jumlah Hari -->
                    <div>
                        <label class="text-sm font-medium text-gray-700 mb-2 block">Jumlah Hari</label>
                        <input
                            id="jumlah-hari"
                            type="number"
                            name="jumlah_hari"
                            min="1"
                            value="1"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed"
                            readonly
                        />
                    </div>

                    <!-- Tanggal Peminjaman -->
                    <div id="tanggal-peminjaman-container" class="mt-4 space-y-2"></div>

                    <!-- Tombol Tambah Tanggal -->
                    <button
                        type="button"
                        onclick="tambahTanggalInput()"
                        class="mt-4 mb-5 bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-md transition-colors"
                    >
                        Tambah Tanggal
                    </button>


                <!-- Jumlah Ruangan -->
                <div class="mb-4">
                    <label for="jumlah-ruangan" class="text-sm font-medium text-gray-700 mb-2 block">
                        Jumlah Ruangan
                    </label>
                    <input
                        id="jumlah-ruangan"
                        name="jumlah_ruangan"
                        type="number"
                        min="0"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                    />
                </div>

                <!-- Jumlah PC -->
                <div class="mb-4">
                    <label for="jumlah-pc" class="text-sm font-medium text-gray-700 mb-2 block">
                        Jumlah PC
                    </label>
                    <input
                        id="jumlah-pc"
                        name="jumlah_pc"
                        type="number"
                        min="0"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                    />
                </div>

                <!-- Lampiran -->
                <div class="mb-6">
                    <label for="lampiran" class="text-sm font-medium text-gray-700 mb-2 block">
                        Lampiran
                    </label>
                    <input
                        id="lampiran"
                        name="lampiran"
                        type="file"
                        accept=".pdf"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100"
                    />
                    <p class="text-xs text-gray-500 mt-1">
                        Format file yang diperbolehkan hanya pdf dengan ukuran maksimum 2 MB
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-3 pt-6">
                    <button
                        type="button"
                        onclick="closeModalUpdate()"
                        class="bg-red-600 hover:bg-red-700 text-white border border-red-600 px-6 py-2 rounded-md transition-colors"
                    >
                        Batal
                    </button>
                    <button
                        type="submit"
                        class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-md transition-colors"
                    >
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
