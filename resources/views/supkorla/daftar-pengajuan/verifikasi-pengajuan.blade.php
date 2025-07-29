
<!-- Modal Overlay -->
<div id="modalOverlayVerifikasi" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 opacity-0 invisible transition-all duration-300 ease-out">
    <div class="bg-white rounded-xl w-11/12 max-w-5xl mx-4 overflow-hidden shadow-2xl transform scale-75 -translate-y-12 transition-all duration-300 flex flex-col">
        <!-- Modal Header -->
        <div class="bg-teal-800 text-white px-6 py-5 flex justify-between items-center">
            <h2 class="text-lg font-semibold">Verifikasi Pengajuan</h2>
            <button onclick="closeModalVerifikasi()" class="text-white hover:bg-white hover:bg-opacity-10 rounded p-1">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <div class="bg-[#F9FAFB] rounded-xl p-4 border border-gray-200 mb-6">
            <div class="grid gap-2 text-sm text-gray-700">
            <div><strong>Nomor Surat:</strong> 77</div>
            <div><strong>Nama Peminjam:</strong> Bubuubu</div>
            <div><strong>Tanggal Peminjaman:</strong> 20 Juni 2025</div>
            <div><strong>Lama Peminjaman:</strong> 1 Hari</div>
            <div><strong>Jumlah Ruang Dipinjam:</strong> 1 Ruangan</div>
            <div><strong>Jumlah PC Dipinjam:</strong> <span id="jumlah-pc">-</span></div>
            </div>
        </div>

        <!-- Modal Body -->
        <form method="POST" action="{{ route('verifikasi.submit') }}">
            @csrf
            <input type="hidden" name="peminjamen_id" id="peminjamen_id_input">

            <div class="px-6 py-6 space-y-4 overflow-y-auto flex-1 scroll-hide">
                <h3 class="text-lg font-semibold mb-4 text-[#004B50]">Pilih Ruangan</h3>
                <div id="ruangan-list" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 max-h-[300px] scrollbar-modern overflow-y-auto pr-1">
                    {{-- Akan diisi JS --}}
                </div>
            </div>

            <div class="px-6 py-5 border-t border-gray-200 flex flex-col sm:flex-row justify-end items-center gap-3">
                <button type="button" onclick="closeModalVerifikasi()" class="bg-[#D92D20] text-white px-5 py-2 rounded hover:bg-red-600 font-medium shadow-sm">
                    Kembali
                </button>
                <button type="submit" class="bg-[#007D6E] text-white px-5 py-2 rounded hover:bg-[#00685D] font-medium shadow-sm">
                    Terima
                </button>
            </div>
        </form>
    </div>
</div>
