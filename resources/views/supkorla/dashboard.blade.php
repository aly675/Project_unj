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
                        <p class="text-3xl font-bold text-gray-900">15</p>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                        <h3 class="text-sm font-medium text-gray-600 mb-2">Menunggu Persetujuan</h3>
                        <p class="text-3xl font-bold text-gray-900">15</p>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                        <h3 class="text-sm font-medium text-gray-600 mb-2">Surat Disetujui</h3>
                        <p class="text-3xl font-bold text-gray-900">15</p>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                        <h3 class="text-sm font-medium text-gray-600 mb-2">Surat Ditolak</h3>
                        <p class="text-3xl font-bold text-gray-900">15</p>
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
                                    <span class="text-sm text-gray-600">Sort by:</span>
                                    <select class="border border-gray-300 rounded px-3 py-2 text-sm">
                                        <option>Newest</option>
                                        <option>Oldest</option>
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
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Peminjam</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ruangan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Jane Cooper</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">6 April 2023</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">R.201</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Disetujui</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Floyd Miles</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Yahoo</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">(205) 555-0100</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Ditolak</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Ronald Richards</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Adobe</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">(302) 555-0107</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Ditolak</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Marvin McKinney</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Tesla</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">(252) 555-0126</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Disetujui</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Jerome Bell</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Google</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">(629) 555-0129</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Disetujui</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Kathryn Murphy</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Microsoft</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">(406) 555-0120</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Disetujui</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Jacob Jones</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Yahoo</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">(208) 555-0112</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Disetujui</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Kristin Watson</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Facebook</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">(704) 555-0127</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Ditolak</span>
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

@endsection
