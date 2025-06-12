@extends('layouts.kepala-upt-layout')

@section('title', 'Dashboard')

@section('page', 'Dashboard')

@section('main')
      <h1 class="text-2xl font-semibold text-gray-800 px-6 mt-6">Ringkasan</h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-6 mb-10">
                <div class="bg-white p-4 rounded-lg shadow-md text-center">
                    <h2 class="text-xl font-semibold">Total Surat</h2>
                    <p class="text-3xl">15</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md text-center">
                    <h2 class="text-xl font-semibold">Jumlah Permintaan</h2>
                    <p class="text-3xl">15</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md text-center">
                    <h2 class="text-xl font-semibold">Total Ruangan</h2>
                    <p class="text-3xl">15</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md text-center">
                    <h2 class="text-xl font-semibold">Total Pengguna</h2>
                    <p class="text-3xl">15</p>
                </div>
            </div>



          <!-- Table -->
        <div class="bg-white rounded-xl p-6 shadow-md max-w-full overflow-x-auto">
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-5 gap-4">
            <div>
              <h2 class="text-lg font-semibold leading-tight select-none">Daftar Surat Masuk</h2>
              <a href="#" class="text-sm text-teal-600 select-none">Pengguna Aktif</a>
            </div>

            <div class="flex items-center gap-3">
              <label for="searchInput" class="sr-only">Search</label>
              <input
                id="searchInput"
                type="search"
                placeholder="Search"
                class="rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
              />
              <select
                aria-label="Sort by"
                class="rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
              >
                <option>Sort by : Newest</option>
                <option>Sort by : Oldest</option>
                <option>Sort by : Name</option>
              </select>
            </div>
          </div>

          <table class="w-full text-left text-sm text-gray-700 border-collapse">
            <thead class="border-b border-gray-300">
              <tr>
                <th class="px-4 py-2 font-semibold text-gray-400 select-none">Nama Peminjam</th>
                <th class="px-4 py-2 font-semibold text-gray-400 select-none">Role</th>
                <th class="px-4 py-2 font-semibold text-gray-400 select-none">Ruangan</th>
                <th class="px-4 py-2 font-semibold text-gray-400 select-none">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr class="border-b border-gray-100">
                <td class="px-4 py-3">Jane Cooper</td>
                <td class="px-4 py-3">6 April 2023</td>
                <td class="px-4 py-3">R.201</td>
                <td class="px-4 py-3">
                  <span class="inline-block px-3 py-1 bg-teal-200 text-teal-800 rounded-md text-xs">Disetujui</span>
                </td>
              </tr>
              <tr class="border-b border-gray-100">
                <td class="px-4 py-3">Floyd Miles</td>
                <td class="px-4 py-3">Yahoo</td>
                <td class="px-4 py-3">(205) 555-0100</td>
                <td class="px-4 py-3">
                  <span class="inline-block px-3 py-1 bg-red-200 text-red-700 rounded-md text-xs">Ditolak</span>
                </td>
              </tr>
              <tr class="border-b border-gray-100">
                <td class="px-4 py-3">Ronald Richards</td>
                <td class="px-4 py-3">Adobe</td>
                <td class="px-4 py-3">(302) 555-0107</td>
                <td class="px-4 py-3">
                  <span class="inline-block px-3 py-1 bg-red-200 text-red-700 rounded-md text-xs">Inactive</span>
                </td>
              </tr>
              <tr class="border-b border-gray-100">
                <td class="px-4 py-3">Marvin McKinney</td>
                <td class="px-4 py-3">Tesla</td>
                <td class="px-4 py-3">(252) 555-0126</td>
                <td class="px-4 py-3">
                  <span class="inline-block px-3 py-1 bg-teal-200 text-teal-800 rounded-md text-xs">Active</span>
                </td>
              </tr>
              <tr class="border-b border-gray-100">
                <td class="px-4 py-3">Jerome Bell</td>
                <td class="px-4 py-3">Google</td>
                <td class="px-4 py-3">(629) 555-0129</td>
                <td class="px-4 py-3">
                  <span class="inline-block px-3 py-1 bg-teal-200 text-teal-800 rounded-md text-xs">Active</span>
                </td>
              </tr>
              <tr class="border-b border-gray-100">
                <td class="px-4 py-3">Kathryn Murphy</td>
                <td class="px-4 py-3">Microsoft</td>
                <td class="px-4 py-3">(406) 555-0120</td>
                <td class="px-4 py-3">
                  <span class="inline-block px-3 py-1 bg-teal-200 text-teal-800 rounded-md text-xs">Active</span>
                </td>
              </tr>
              <tr class="border-b border-gray-100">
                <td class="px-4 py-3">Jacob Jones</td>
                <td class="px-4 py-3">Yahoo</td>
                <td class="px-4 py-3">(208) 555-0112</td>
                <td class="px-4 py-3">
                  <span class="inline-block px-3 py-1 bg-teal-200 text-teal-800 rounded-md text-xs">Active</span>
                </td>
              </tr>
              <tr>
                <td class="px-4 py-3">Kristin Watson</td>
                <td class="px-4 py-3">Facebook</td>
                <td class="px-4 py-3">(704) 555-0127</td>
                <td class="px-4 py-3">
                  <span class="inline-block px-3 py-1 bg-red-200 text-red-700 rounded-md text-xs">Inactive</span>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="mt-4 text-xs text-gray-400 select-none">Showing data 1 to 8 of 256K entries</div>
          <nav aria-label="Pagination navigation" class="mt-2 flex justify-center gap-2 text-gray-600 select-none">
            <button class="p-1 rounded hover:bg-gray-200" aria-label="Previous page">&lt;</button>
            <button class="p-2 rounded bg-teal-700 text-white" aria-current="page">1</button>
            <button class="p-2 rounded hover:bg-gray-200">2</button>
            <button class="p-2 rounded hover:bg-gray-200">3</button>
            <button class="p-2 rounded hover:bg-gray-200">4</button>
            <span class="p-2">&hellip;</span>
            <button class="p-2 rounded hover:bg-gray-200">40</button>
            <button class="p-1 rounded hover:bg-gray-200" aria-label="Next page">&gt;</button>
          </nav>
        </div>
    </div>
@endsection
