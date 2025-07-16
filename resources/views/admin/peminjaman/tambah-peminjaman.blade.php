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

    <h1 class="text-xl font-semibold text-gray-800 mb-4">
  Form Input Surat Peminjaman
</h1>

<div class="bg-white rounded-lg shadow-sm pt-1 px-6 pb-6">
  <form
    id="formPeminjaman"
    onsubmit="handleSubmit(event)"
    class="space-y-6"
    method="POST"
    action="{{ route('admin.tambah-peminjaman') }}"
    enctype="multipart/form-data"
  >
    @csrf

    <!-- Nomor Surat -->
    <div>
      <label for="nomor-surat" class="text-sm font-medium text-gray-700 mb-2 block">
        Nomor Surat
      </label>
      <input
        id="nomor-surat"
        name="nomor-surat"
        type="text"
        placeholder="0000/UNJ/PUSTIKOM/2025"
        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
      />
    </div>

    <!-- Asal Surat -->
    <div>
      <label for="asal-surat" class="text-sm font-medium text-gray-700 mb-2 block">
        Asal Surat
      </label>
      <input
        id="asal-surat"
        name="asal-surat"
        type="text"
        placeholder="PUSTIKOM"
        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
      />
    </div>

    <!-- Nama Peminjam -->
    <div>
      <label for="nama-peminjam" class="text-sm font-medium text-gray-700 mb-2 block">
        Nama Peminjam
      </label>
      <input
        id="nama-peminjam"
        name="nama-peminjam"
        type="text"
        placeholder="Jonedoe"
        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
      />
    </div>

    <!-- Jumlah Hari -->
    <div>
      <label class="text-sm font-medium text-gray-700 mb-2 block">
        Jumlah Hari
      </label>
      <input
        id="jumlah-hari"
        name="jumlah-hari"
        type="number"
        min="1"
        value="1"
        readonly
        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 cursor-not-allowed"
      />
    </div>

    <!-- Tanggal Peminjaman -->
    <div id="tanggal-peminjaman-container" class="mt-4 space-y-2"></div>

    <!-- Tombol Tambah Tanggal -->
    <button
      type="button"
      onclick="tambahTanggalInput()"
      class="mt-4 bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-md transition-colors"
    >
      Tambah Tanggal
    </button>

    <!-- Jumlah Ruangan -->
    <div>
      <label for="jumlah-ruangan" class="text-sm font-medium text-gray-700 mb-2 block">
        Jumlah Ruangan
      </label>
      <input
        id="jumlah-ruangan"
        name="jumlah-ruangan"
        type="number"
        min="1"
        value="1"
        required
        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
      />
    </div>

    <!-- Jumlah PC -->
    <div>
      <label for="jumlah-pc" class="text-sm font-medium text-gray-700 mb-2 block">
        Jumlah PC
      </label>
      <input
        id="jumlah-pc"
        name="jumlah-pc"
        type="number"
        min="1"
        value="1"
        required
        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
      />
    </div>

    <!-- Lampiran -->
    <div>
      <label for="lampiran" class="text-sm font-medium text-gray-700 mb-2 block">
        Lampiran
      </label>
      <input
        id="lampiran"
        name="lampiran"
        type="file"
        accept=".pdf"
        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500
        file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100"
      />
      <p class="text-xs text-gray-500 mt-1">
        Format file yang diperbolehkan hanya PDF dengan ukuran maksimum 2 MB
      </p>
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-end space-x-3 pt-6">
      <button
        type="button"
        onclick="handleCancel()"
        class="bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition-colors px-6 py-2 rounded-md"
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


@endsection

@section('js')
<script>
    function tambahTanggalInput() {
        const container = document.getElementById("tanggal-peminjaman-container");

        const wrapper = document.createElement("div");
        wrapper.classList.add("flex", "space-x-2", "items-center");

        const label = document.createElement("label");
        label.innerText = `Hari ke-${container.children.length + 1}:`;
        label.classList.add("w-24", "text-sm", "text-gray-700");

        const input = document.createElement("input");
        input.type = "date";
        input.name = "tanggal_peminjaman[]";
        input.required = true;
        input.className = "flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500";

        // Atur minimal tanggal adalah besok
        const today = new Date();
        today.setDate(today.getDate() + 1);
        const minDate = today.toISOString().split('T')[0];
        input.min = minDate;

        // Cek urutan tanggal
        input.addEventListener('change', () => {
            const inputs = document.querySelectorAll('input[name="tanggal_peminjaman[]"]');
            for (let i = 1; i < inputs.length; i++) {
                const prevDate = new Date(inputs[i - 1].value);
                const currentDate = new Date(inputs[i].value);
                if (inputs[i].value && inputs[i - 1].value && currentDate <= prevDate) {
                    alert(`Tanggal pada Hari ke-${i + 1} tidak boleh sebelum Hari ke-${i}. Harap pilih ulang.`);
                    inputs[i].value = "";
                    inputs[i].focus();
                    return;
                }
            }
        });

        const btn = document.createElement("button");
        btn.type = "button";
        btn.className = "bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-md transition-colors";
        btn.innerText = "Hapus";
        btn.onclick = function () {
            if (container.children.length <= 1) {
                alert("Minimal satu hari peminjaman.");
                return;
            }
            wrapper.remove();
            updateLabelTanggal();
        };

        wrapper.appendChild(label);
        wrapper.appendChild(input);
        wrapper.appendChild(btn);
        container.appendChild(wrapper);

        updateLabelTanggal();
    }

    // Update label & jumlah hari
    function updateLabelTanggal() {
        const container = document.getElementById("tanggal-peminjaman-container");
        const children = container.children;
        for (let i = 0; i < children.length; i++) {
            const label = children[i].querySelector("label");
            label.innerText = `Hari ke-${i + 1}:`;
        }
        document.getElementById("jumlah-hari").value = children.length;
    }

    // Saat halaman pertama kali dibuka, render 1 input tanggal
    window.addEventListener('DOMContentLoaded', () => {
        if (document.getElementById("tanggal-peminjaman-container").children.length === 0) {
            tambahTanggalInput();
        }
    });


    function updateLabelTanggal() {
        const container = document.getElementById("tanggal-peminjaman-container");
        const children = container.children;
        for (let i = 0; i < children.length; i++) {
            const label = children[i].querySelector("label");
            label.innerText = `Hari ke-${i + 1}:`;
        }
        document.getElementById("jumlah-hari").value = children.length;
    }


    function handleCancel() {
        Swal.fire({
            title: 'Batalkan Form?',
            text: 'Data yang sudah diisi akan hilang.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, batalkan!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('admin.peminjaman-batal') }}";
            }
        });
    }

    function handleSubmit(event) {
        event.preventDefault();

        // Get form data
        const formData = new FormData(event.target);
        const data = Object.fromEntries(formData.entries());

        // Simple validation
        const requiredFields = ['nomor-surat', 'asal-surat', 'nama-peminjam', 'jumlah-hari', 'lampiran'];
        const missingFields = requiredFields.filter(field => !data[field]);

        const tanggalInputs = document.querySelectorAll('input[name="tanggal_peminjaman[]"]');
        let tanggalKosong = false;
        tanggalInputs.forEach(input => {
            if (!input.value) tanggalKosong = true;
        });

        if (missingFields.length > 0 || tanggalKosong) {
            alert('Mohon lengkapi semua field yang wajib diisi.');
            return;
        }

        if (tanggalKosong) {
            alert('Mohon lengkapi semua tanggal peminjaman.');
            return;
        }

        // File size validation
        // File validation: wajib diisi, hanya PDF, ukuran maks 2MB
        const fileInput = document.getElementById('lampiran');
        const file = fileInput.files[0];

        if (!file) {
            alert('Mohon unggah lampiran (PDF).');
            return;
        }

        if (file.type !== 'application/pdf') {
            alert('Lampiran harus berupa file PDF.');
            return;
        }

        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file tidak boleh lebih dari 2 MB.');
            return;
        }

        // Jika semua valid, submit form secara manual
        event.target.submit();
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
