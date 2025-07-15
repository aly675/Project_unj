<!-- Modal Container -->
<div
  id="modalUpdate"
  class="bg-white w-full rounded-xl max-w-md mx-4 overflow-hidden shadow-2xl transform -translate-y-1.5 transition-all duration-300 relative scale-95"
>
  <!-- Modal Header -->
  <div class="bg-teal-800 text-white px-6 py-4 flex justify-between items-center">
    <h2 class="text-lg font-semibold">Edit Fasilitas</h2>
    <button
      id="closeBtn"
      onclick="closeModalUpdateFasilitas()"
      class="text-white hover:bg-white hover:bg-opacity-10 rounded p-1 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50"
    >
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
      </svg>
    </button>
  </div>

  <!-- Modal Body -->
  <div class="px-6 py-5 max-h-[90vh] overflow-y-auto">
    <!-- Form langsung tanpa inner card -->
    <form id="formUpdateFasilitas" method="POST" onsubmit="updateFasilitas(event)" class="space-y-4">
      @csrf
      @method("PUT")

      <!-- Nama Fasilitas -->
      <div>
        <label for="inputNamaFasilitas" class="block text-sm font-medium text-gray-700 mb-1">
          Nama Fasilitas
        </label>
        <input
          id="inputNamaFasilitas"
          name="nama"
          type="text"
          required
          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
        />
      </div>

      <!-- Action Buttons -->
      <div class="flex justify-end space-x-3 pt-4">
        <button
          type="button"
          onclick="closeModalUpdateFasilitas()"
          class="px-6 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition-colors"
        >
          Batal
        </button>
        <button
          type="submit"
          class="px-6 py-2 bg-teal-800 hover:bg-teal-700 text-white rounded-md transition-colors"
        >
          Simpan
        </button>
      </div>
    </form>
  </div>
</div>


<script>
    function updateFasilitas(e) {
        e.preventDefault();

        const form = document.getElementById('formUpdateFasilitas');
        const url = form.action;
        const formData = new FormData(form);

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(data => {
                    throw new Error(data.message || 'Gagal memperbarui fasilitas.');
                });
            }
            return response.json();
        })
        .then(res => {
            closeModalUpdateFasilitas();

            Swal.fire({
                toast: true,
                position: 'bottom-end',
                icon: 'success',
                title: res.message || 'Fasilitas berhasil diperbarui.',
                timer: 3000,
                showConfirmButton: false,
                timerProgressBar: true
            });

            fetchFasilitas(); // Refresh tabel secara real-time jika sudah ada
        })
        .catch(err => {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: err.message || 'Terjadi kesalahan saat memperbarui fasilitas.'
            });
        });
    }
</script>
