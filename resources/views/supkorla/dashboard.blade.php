@extends('layouts.supkorla-layout')

@section('title', 'Dashboard')

@section('page', 'Dashboard')

@section('style')
    <style>

    </style>
@endsection

@section('main')
                <h1 class="text-2xl font-bold text-gray-900 mb-6">Ringkasan</h1>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                        <h3 class="text-sm font-medium text-gray-600 mb-2">Total Surat Masuk</h3>
                        <p id="total-surat" class="text-3xl font-bold text-gray-900">0</p>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                        <h3 class="text-sm font-medium text-gray-600 mb-2">Menunggu Persetujuan</h3>
                        <p id="menunggu-persetujuan" class="text-3xl font-bold text-gray-900">0</p>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                        <h3 class="text-sm font-medium text-gray-600 mb-2">Menunggu Verifikasi</h3>
                        <p id="menunggu-verifikasi" class="text-3xl font-bold text-gray-900">0</p>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                        <h3 class="text-sm font-medium text-gray-600 mb-2">Surat Diverifikasi</h3>
                        <p id="surat-diverifikasi" class="text-3xl font-bold text-gray-900">0</p>
                    </div>
                </div>

                <!-- Data Table -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900">Daftar Surat Masuk</h2>
                                <p class="text-sm text-teal-600 mt-1">Pengguna Aktif</p>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="relative">
                                    <input type="text" placeholder="Search..."
                                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="text-xs text-gray-600">Sort by:</span>
                                    <select class="border border-gray-300 rounded px-3 py-2 text-xs">
                                        <option>Newest</option>
                                        <option>Oldest</option>
                                    </select>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="text-xs text-gray-600">Status :</span>
                                    <select class="border border-gray-300 rounded px-3 py-2 text-xs">
                                        <option>All</option>
                                        <option>Menunggu Persetujuan</option>
                                        <option>Menunggu Verifikasi</option>
                                        <option>Sudah Diverifikasi</option>
                                        <option>Ditolak</option>
                                    </select>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <select class="border border-gray-300 rounded px-3 py-2 text-xs">
                                        <option>5</option>
                                        <option>10</option>
                                        <option>25</option>
                                        <option>50</option>
                                        <option>100</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Peminjam</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lama Peminjam</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Ruangan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Jane Cooper</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">10 Hari</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">10</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Sudah Diverifikasi</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Floyd Miles</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">10 Hari</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">9</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Ditolak</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Ronald Richards</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">10 Hari</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">20</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Menunggu Verifikasi</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Marvin McKinney</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">10 Hari</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">20</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">Menunggu Persetujuan</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <p class="text-sm text-gray-500">Showing data 1 to 8 of 256K entries</p>
                            <div class="flex items-center space-x-2">
                                <button class="px-3 py-1 text-sm text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button class="px-3 py-1 text-sm bg-teal-600 text-white rounded">1</button>
                                <button class="px-3 py-1 text-sm text-gray-500 hover:text-gray-700">2</button>
                                <button class="px-3 py-1 text-sm text-gray-500 hover:text-gray-700">3</button>
                                <button class="px-3 py-1 text-sm text-gray-500 hover:text-gray-700">4</button>
                                <span class="px-3 py-1 text-sm text-gray-500">...</span>
                                <button class="px-3 py-1 text-sm text-gray-500 hover:text-gray-700">40</button>
                                <button class="px-3 py-1 text-sm text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
@endsection

@section('js')
<script>

    document.addEventListener('DOMContentLoaded', () => {
        fetch('{{ route('supkorla.dashboard-summary-json') }}')
            .then(res => res.json())
            .then(data => {
                document.getElementById('total-surat').textContent = data.total;
                document.getElementById('menunggu-persetujuan').textContent = data.menungguPersetujuan;
                document.getElementById('menunggu-verifikasi').textContent = data.menungguVerifikasi;
                document.getElementById('surat-diverifikasi').textContent = data.diterima;
            })
            .catch(error => {
                console.error('Gagal ambil data summary:', error);
            });
    });
</script>
@endsection
