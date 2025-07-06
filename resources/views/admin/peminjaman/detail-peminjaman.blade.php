   <!-- Modal Container -->
        <div
            id="modal"
            class="bg-white rounded-xl w-11/12 max-w-lg mx-4 overflow-hidden shadow-2xl transform scale-75 -translate-y-12 transition-all duration-300"
        >
            <!-- Modal Header -->
            <div class="bg-teal-800 text-white px-6 py-5 flex justify-between items-center">
                <h2 class="text-lg font-semibold">Detail Pengajuan Surat</h2>
                <button
                    id="closeBtn"
                    onclick="closeModalDetail()"
                    class="text-white hover:bg-white hover:bg-opacity-10 rounded p-1 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="px-6 py-6 space-y-4">
            <!-- Nomor Surat -->
                <div class="flex flex-col sm:flex-row sm:items-start">
                    <span class="font-medium text-gray-700 sm:min-w-[140px] sm:mr-4 mb-1 sm:mb-0">Nomor Surat</span>
                    <span class="text-gray-900" id="modal_nomor_surat">: </span>
                </div>

                <!-- Asal Surat -->
                <div class="flex flex-col sm:flex-row sm:items-start">
                    <span class="font-medium text-gray-700 sm:min-w-[140px] sm:mr-4 mb-1 sm:mb-0">Asal Surat</span>
                    <span class="text-gray-900" id="modal_asal_surat">: </span>
                </div>

                <!-- Nama Peminjam -->
                <div class="flex flex-col sm:flex-row sm:items-start">
                    <span class="font-medium text-gray-700 sm:min-w-[140px] sm:mr-4 mb-1 sm:mb-0">Nama Peminjam</span>
                    <span class="text-gray-900" id="modal_nama_peminjam">: </span>
                </div>

                <!-- jumlah ruangan -->
                <div class="flex flex-col sm:flex-row sm:items-start">
                    <span class="font-medium text-gray-700 sm:min-w-[140px] sm:mr-4 mb-1 sm:mb-0">Jumlah Ruangan</span>
                    <span class="text-gray-900" id="modal_jumlah_ruangan">: </span>
                </div>

                <!-- Jumlah PC -->
                <div class="flex flex-col sm:flex-row sm:items-start">
                    <span class="font-medium text-gray-700 sm:min-w-[140px] sm:mr-4 mb-1 sm:mb-0">Jumlah PC</span>
                    <span class="text-gray-900" id="modal_jumlah_pc">: </span>
                </div>

                <!-- Lama Peminjaman -->
                <div class="flex flex-col sm:flex-row sm:items-start">
                    <span class="font-medium text-gray-700 sm:min-w-[140px] sm:mr-4 mb-1 sm:mb-0">Lama Peminjam</span>
                    <span class="text-gray-900" id="modal_lama_peminjam">: </span>
                </div>

                <!-- Status -->
                <div class="flex flex-col sm:flex-row sm:items-start">
                    <span class="font-medium text-gray-700 sm:min-w-[140px] sm:mr-4 mb-1 sm:mb-0">Status</span>
                    <span class="inline-flex px-2 py-1 text-sm font-medium bg-yellow-100 text-yellow-800 rounded-full" id="modal_status">Menunggu</span>
                </div>

                <!-- Tanggal Peminjaman -->
                <div class="flex flex-col sm:flex-row sm:items-start">
                    <span class="font-medium text-gray-700 sm:min-w-[140px] sm:mr-4 mb-2 sm:mb-0">Tanggal Peminjam</span>
                    <div class="flex-1">
                        <div class="relative">
                            <div class="date-scroll max-h-32 overflow-y-auto bg-gray-50 rounded-md p-3 pr-8 border border-gray-200">
                                <div class="space-y-1 text-sm text-gray-900" id="modal_tanggal_peminjam">
                                    <!-- akan diisi JS -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                </div>

            <!-- Modal Footer -->
           <div class="px-6 py-5 border-t border-gray-200 flex flex-col sm:flex-row justify-between items-center gap-3">
                <!-- Kiri -->

            <a id="modal_lampiran_link"
                href="#"
                target="_blank"
                class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2.5 px-5 rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Surat Pengajuan
            </a>


                <!-- Kanan -->
                <div class="flex gap-3">
                    <button
                        id="tolakBtn"
                        onclick="closeModalDetail()"
                        class="bg-red-600 hover:bg-red-700 text-white font-medium py-2.5 px-5 rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                    >
                        close
                    </button>
                </div>
            </div>
        </div>
