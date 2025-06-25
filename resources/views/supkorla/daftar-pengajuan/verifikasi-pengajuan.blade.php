   <!-- Modal Container -->
        <div
            id="modal"
            class="bg-white rounded-xl w-11/12  max-h-[90vh] max-w-5xl mx-4 overflow-hidden shadow-2xl transform scale-75 -translate-y-12 transition-all duration-300 flex flex-col"
        >
            <!-- Modal Header -->
            <div class="bg-teal-800 text-white px-6 py-5 flex justify-between items-center">
                <h2 class="text-lg font-semibold">Verifikasi Pengajuan</h2>
                <button
                    id="closeBtn"
                    onclick="closeModalVerifikasi()"
                    class="text-white hover:bg-white hover:bg-opacity-10 rounded p-1 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="px-6 py-6 space-y-4 overflow-y-auto flex-1 scroll-hide">
               <div class="bg-[#F9FAFB] rounded-xl p-4 border border-gray-200 mb-6">
                    <div class="grid gap-2 text-sm text-gray-700">
                        <div><strong>Nomor Surat:</strong> 77</div>
                        <div><strong>Nama Peminjam:</strong> Bubuubu</div>

                        <!-- Tanggal Peminjam (sejajar kanan) -->
                        <div class="flex flex-col sm:flex-row sm:items-start sm:gap-4">
                            <strong class="text-gray-700 sm:min-w-[140px] sm:mb-0">Tanggal Peminjam:</strong>
                            <div class="flex-1">
                                <div class="relative">
                                    <div class="date-scroll scrollbar-modern max-h-20 overflow-y-auto bg-gray-100 rounded-md p-3 pr-8 border border-gray-300">
                                        <p>27-09-2009</p>
                                        <p>27-09-2009</p>
                                        <p>27-09-2009</p>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div><strong>Lama Peminjaman:</strong> 1 Hari</div>
                        <div><strong>Jumlah Ruang Dipinjam:</strong> 1 Ruangan</div>
                        <div><strong>Jumlah PC Dipinjam:</strong> 30</div>
                    </div>
                </div>

                <h3 class="text-lg font-semibold mb-4 text-[#004B50]">Pilih Ruangan</h3>
                <div id="ruangan-list" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 max-h-[300px] scrollbar-modern overflow-y-auto pr-1">

                </div>

            </div>

            <!-- Modal Footer -->
           <div class="px-6 py-5 border-t border-gray-200 flex flex-col sm:flex-row justify-end items-center gap-3">
                    <button type="button" onclick="closeModalVerifikasi()" class="bg-[#D92D20] text-white px-5 py-2 rounded hover:bg-red-600 font-medium shadow-sm">
                        Kembali
                    </button>
                    <button type="submit" class="bg-[#007D6E] text-white px-5 py-2 rounded hover:bg-[#00685D] font-medium shadow-sm">
                        Terima
                    </button>
            </div>
        </div>
