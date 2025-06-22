<!-- Modal Container -->
<div
    id="modalUpdate"
    class="bg-white w-full rounded-xl max-w-3xl mx-4 overflow-hidden shadow-2xl transform -translate-y-1.5 transition-all duration-300 relative scale-95"
>

    <!-- Modal Header -->
    <div class="bg-teal-800 text-white px-6 py-5 flex justify-between items-center">
        <h2 class="text-xl font-semibold">Tambah Fasilitas</h2>
        <button
            id="closeBtn"
            onclick="closeModalTambahFasilitas()"
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
            <h1 class="text-xl font-semibold text-gray-800 mb-6">Form Tambah Fasilitas</h1>

            <!-- Form menggunakan method POST biasa tanpa fetch -->
            <form method="POST" action="{{route('admin.submit-fasilitas')}}" enctype="multipart/form-data">
                @csrf
                    <!-- Nama Fasilitas -->
                <div class="mb-4">
                    <label for="nama-peminjam" class="text-sm font-medium text-gray-700 mb-2 block">
                        Nama Fasilitas
                    </label>
                    <input
                        id="nama"
                        name="nama"
                        type="text"
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                    />
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-3 pt-6">
                    <button
                        type="button"
                        onclick="cancelledModalTambahFasilitas()"
                        class="bg-red-600 hover:bg-red-700 text-white border border-red-600 px-6 py-2 rounded-md transition-colors"
                    >
                        Batal
                    </button>
                    <button
                        type="submit"
                        class="bg-teal-800 hover:bg-teal-700 text-white px-6 py-2 rounded-md transition-colors"
                    >
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
