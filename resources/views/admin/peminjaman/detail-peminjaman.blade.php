@extends('layouts.admin-layout')

@section('title', 'Peminjaman')

@section('main')


    <h2 class="text-gray-900 font-extrabold text-2xl mb-6">Peminjaman</h2>
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
      <div class="flex gap-3 flex-1 max-w-md">
        <div class="relative flex-1">
          <input
            class="w-full border border-gray-300 rounded-md py-2 pl-3 pr-10 text-sm text-gray-600 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-700 focus:border-transparent"
            placeholder="Search..."
            type="text"
          />
          <i
            class="fas fa-search absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm pointer-events-none"
          ></i>
        </div>
        <select
          title="t"
          name=""
          id=""
          class="border border-gray-300 rounded-md py-2 px-3 text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-teal-700 focus:border-transparent"
        >
          <option>Status : All</option>
          <option>Pending</option>
          <option>Completed</option>
          <option>Cancelled</option>
        </select>
      </div>
      <a
        href="{{route('admin.tambah-peminjaman-page')}}"
        class="bg-teal-800 text-white rounded-full px-6 py-2 text-sm font-semibold hover:bg-teal-900 transition-colors whitespace-nowrap">
        Tambah Data
      </a>
    </div>
    <div class="overflow-x-auto bg-white rounded-lg shadow">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th
              class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider"
              scope="col"
            >
              ID
            </th>
            <th
              class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider"
              scope="col"
            >
              NOMOR SURAT
            </th>
            <th
              class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider"
              scope="col"
            >
              ASAL SURAT
            </th>
            <th
              class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider"
              scope="col"
            >
              NAMA PEMINJAM
            </th>
            <th
              class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider"
              scope="col"
            >
              LAMA PEMINJAM
            </th>
            <th
              class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider"
              scope="col"
            >
              STATUS
            </th>
            <th
              class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider"
              scope="col"
            >
              ACTION
            </th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          <!-- 10 rows as in screenshot -->
          <tr>
            <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-700 font-normal">
              #5089
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900 font-normal">
              0001
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-700 font-normal">
              Balai Samudra
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-700 font-normal">
              Muhammad Fadlan
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900 font-normal">
              1 Hari
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-xs font-semibold text-yellow-400">
              Pending
            </td>
            <td
              class="px-6 py-4 whitespace-nowrap text-xs text-blue-600 font-normal cursor-pointer hover:underline"
            >
              <div class="flex items-center gap-x-2">
                <a href="../"
                  ><img
                    src="{{asset('assets/images/icon/action-view-icon.svg')}}"
                    alt="View action icon"
                /></a>
                <a href="../"
                  ><img
                    src="{{asset('assets/images/icon/action-edit-icon.svg')}}"
                    alt="Edit action icon"
                /></a>
                <a href="../"
                  ><img
                    src="{{asset('assets/images/icon/action-delete-icon.svg')}}"
                    alt="Delete action icon"
                /></a>

                {{-- <a href="../"/>Cetak</a> --}}

              </div>
            </td>
          </tr>
        </tbody>
      </table>
      <div
        class="mt-6 flex flex-col md:flex-row md:items-center md:justify-between text-xs text-gray-500 px-7 pb-5 font-light"
      >
        <div class="mb-3 md:mb-0 flex items-center gap-1">
          <span>Showing</span>
          <select
            title="p"
            class="border border-gray-200 rounded px-2 py-1 text-xs text-gray-500 focus:outline-none focus:ring-1 focus:ring-[#0d5c5c]"
          >
            <option>10</option>
            <option>20</option>
            <option>50</option>
          </select>
          <span>of 50</span>
        </div>
        <nav
          class="flex items-center gap-1 select-none"
          role="navigation"
          aria-label="Pagination Navigation"
        >
          <button
            aria-label="Previous page"
            class="border border-gray-200 rounded px-2 py-1 text-gray-400 cursor-not-allowed"
            disabled
            tabindex="-1"
          >
            &lt;
          </button>
          <button
            aria-current="page"
            class="border border-gray-200 rounded px-2 py-1 bg-[#0d5c5c] text-white"
            tabindex="0"
          >
            1
          </button>
          <button
            class="border border-gray-200 rounded px-2 py-1 hover:bg-gray-100"
            tabindex="0"
          >
            2
          </button>
          <button
            class="border border-gray-200 rounded px-2 py-1 hover:bg-gray-100"
            tabindex="0"
          >
            3
          </button>
          <button
            class="border border-gray-200 rounded px-2 py-1 hover:bg-gray-100"
            tabindex="0"
          >
            4
          </button>
          <button
            class="border border-gray-200 rounded px-2 py-1 hover:bg-gray-100"
            tabindex="0"
          >
            5
          </button>
          <button
            aria-label="Next page"
            class="border border-gray-200 rounded px-2 py-1 text-gray-400 hover:bg-gray-100"
            tabindex="0"
          >
            &gt;
          </button>
        </nav>
      </div>
    </div>


@endsection
