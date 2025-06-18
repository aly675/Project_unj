@extends('layouts.admin-layout')

@section('title', 'Peminjaman')

@section('style')
    <style>
        .file-input {
            position: relative;
            overflow: hidden;
            display: inline-block;
            cursor: pointer;
        }
        .file-input input[type=file] {
            position: absolute;
            left: -9999px;
        }
    </style>
@endsection

@section('main')

    <div class="bg-white warna rounded-lg shadow-sm p-6">
                <h1 class="text-xl font-semibold text-gray-800 mb-6">Form Input Surat Peminjaman</h1>

                <form class="space-y-6" onsubmit="handleSubmit(event)">
                    <!-- Nomor Surat -->
                    <div>
                        <label for="nomor-surat" class="text-sm font-medium text-gray-700 mb-2 block">
                            Nomor Surat
                        </label>
                        <input id="nomor-surat" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
                    </div>

                    <!-- Asal Surat -->
                    <div>
                        <label for="asal-surat" class="text-sm font-medium text-gray-700 mb-2 block">
                            Asal Surat
                        </label>
                        <input id="asal-surat" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
                    </div>

                    <!-- Nama Peminjam -->
                    <div>
                        <label for="nama-peminjam" class="text-sm font-medium text-gray-700 mb-2 block">
                            Nama Peminjam
                        </label>
                        <input id="nama-peminjam" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
                    </div>

                    <!-- Jumlah Hari -->
                    <div>
                    <label for="jumlah-hari" class="text-sm font-medium text-gray-700 mb-2 block">
                        Jumlah Hari
                    </label>
                    <input
                        id="jumlah-hari"
                        type="number"
                        min="1"
                        value="1"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                        oninput="renderTanggalInputs()"
                    />
                    </div>

                    <!-- Tanggal Peminjaman -->
                    <div id="tanggal-peminjaman-container" class="mt-4 space-y-2"></div>

                    <!-- Jumlah Ruangan -->
                    <div>
                        <label for="jumlah-ruangan" class="text-sm font-medium text-gray-700 mb-2 block">
                            Jumlah Ruangan
                        </label>
                        <input id="jumlah-ruangan" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
                    </div>

                    <!-- Jumlah PC -->
                    <div>
                        <label for="jumlah-pc" class="text-sm font-medium text-gray-700 mb-2 block">
                            Jumlah PC
                        </label>
                        <input id="jumlah-pc" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
                    </div>

                    <!-- Lampiran -->
                    <div>
                        <label for="lampiran" class="text-sm font-medium text-gray-700 mb-2 block">
                            Lampiran
                        </label>
                        <input
                            id="lampiran"
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
                            onclick="handleCancel()"
                            class="bg-red-600 hover:bg-red-700 text-white border border-red-600 px-6 py-2 rounded-md transition-colors"
                        >
                            Batal
                        </button>
                        <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-md transition-colors">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>

@endsection

@section('js')
    <script>
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

        function handleCancel() {
            if (confirm('Apakah Anda yakin ingin membatalkan? Data yang telah diisi akan hilang.')) {
                document.querySelector('form').reset();
            }
        }

        function handleSubmit(event) {
            event.preventDefault();

            // Get form data
            const formData = new FormData(event.target);
            const data = Object.fromEntries(formData.entries());

            // Simple validation
            const requiredFields = ['nomor-surat', 'asal-surat', 'nama-peminjam', 'jumlah-hari', 'tanggal-peminjaman'];
            const missingFields = requiredFields.filter(field => !data[field]);

            if (missingFields.length > 0) {
                alert('Mohon lengkapi semua field yang wajib diisi.');
                return;
            }

            // File size validation
            const fileInput = document.getElementById('lampiran');
            if (fileInput.files[0] && fileInput.files[0].size > 2 * 1024 * 1024) {
                alert('Ukuran file tidak boleh lebih dari 2 MB.');
                return;
            }

            alert('Data berhasil disimpan!');
            console.log('Form data:', data);
        }

        // File input change handler
        document.getElementById('lampiran').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                if (file.type !== 'application/pdf') {
                    alert('Hanya file PDF yang diperbolehkan.');
                    e.target.value = '';
                    return;
                }
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file tidak boleh lebih dari 2 MB.');
                    e.target.value = '';
                    return;
                }
            }
        });
    </script>
@endsection
