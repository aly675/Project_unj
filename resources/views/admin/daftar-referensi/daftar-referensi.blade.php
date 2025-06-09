@extends('layouts.admin-layout')

@section('title', 'Daftar Referensi')

@section('main')

 <section class="flex-1">
  <h1 class="text-gray-900 font-extrabold text-2xl mb-4">
      Daftar Refrensi
     </h1>
     <div class="flex flex-wrap items-center gap-3 mb-6 text-xl text-gray-400">
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
      <div class="ml-auto">
       <a
        href="{{route('admin.tambah-ruangan-page')}}"
        class="bg-teal-800 text-white rounded-full px-6 py-2 text-sm font-semibold hover:bg-teal-900 transition-colors whitespace-nowrap">
        Tambah Data
      </a>
      </div>
     </div>

        <div class="bg-white bg-opacity-30 shadow-xl rounded-xl p-10 max-w-9xl flex flex-col md:flex-row md:items-center md:justify-between gap-6">
        <!-- Table Data Ruangan -->
            <div class="flex-1 overflow-x-10">
                <table class="w-full text-sm text-gray-900 font-normal">
                    <tbody>
                        <tr>
                            <td class="pr-4 font-semibold text-right w-[150px]">Nama Ruangan</td>
                            <td class="px-2 text-center w-2">:</td>
                            <td class="text-left">1</td>
                        </tr>
                        <tr>
                            <td class="pr-4 font-semibold text-right">Nomor Ruangan</td>
                            <td class="px-2 text-center">:</td>
                            <td class="text-left">1</td>
                        </tr>
                        <tr>
                            <td class="pr-4 font-semibold text-right">Jumlah PC</td>
                            <td class="px-2 text-center">:</td>
                            <td class="text-left">1</td>
                        </tr>
                        <tr>
                            <td class="pr-4 font-semibold text-right">Kapasitas Orang</td>
                            <td class="px-2 text-center">:</td>
                            <td class="text-left">1</td>
                        </tr>
                    <tr>
                            <td class="pr-4 font-semibold text-right align-top" rowspan="12">Fasilitas</td>
                            <td class="px-2 text-center align-top" rowspan="12">:</td>
                            <td class="text-left">1 PC</td>
                        </tr>
                        <tr>
                            <td class="text-left">AC 2</td>
                        </tr>
                        <tr>
                            <td class="text-left">Proyektor</td>
                        </tr>
                        <tr>
                            <td class="text-left">AC 2</td>
                        </tr>
                        <tr>
                            <td class="text-left">Proyektor</td>
                        </tr>
                        <tr>
                            <td class="text-left">AC 2</td>
                        </tr>
                        <tr>
                            <td class="text-left">Proyektor</td>
                        </tr>
                        <tr>
                            <td class="text-left">AC 2</td>
                        </tr>
                        <tr>
                            <td class="text-left">Proyektor</td>
                        </tr>
                        <tr>
                            <td class="text-left">AC 2</td>
                        </tr>
                        <tr>
                            <td class="text-left">Proyektor</td>
                        </tr>

                    </tbody>
                </table>
            </div>

        <!-- Gambar & Tombol -->
            <div class="flex flex-col items-center gap-4">
                <img alt="Office room with desks and chairs, modern interior with computers on desks and office chairs" class="rounded-lg object-cover w-[300px] h-[220px]" height="120" src="https://storage.googleapis.com/a1aa/image/489c915a-6fbd-433d-9bc5-2956ded13a39.jpg" width="200"/>
                <div class="flex gap-2">
                <a href="{{route('admin.update-ruangan-page')}}" class="bg-blue-600 hover:bg-blue-700 text-white text-xs rounded px-4 py-2 flex items-center gap-1" >
                    <i class="fas fa-edit"></i>
                    Edit
                </a>
                <button class="bg-red-600 hover:bg-red-700 text-white text-xs rounded px-4 py-2 flex items-center gap-1" type="button">
                    <i class="fas fa-trash-alt"></i>
                    Hapus
                </button>
                </div>
            </div>
        </div>

        <div class="bg-white bg-opacity-30 shadow-xl rounded-xl p-10 max-w-9xl flex flex-col md:flex-row md:items-center md:justify-between gap-6">
        <!-- Table Data Ruangan -->
            <div class="flex-1 overflow-x-10">
                <table class="w-full text-sm text-gray-900 font-normal">
                    <tbody>
                        <tr>
                            <td class="pr-4 font-semibold text-right w-[150px]">Nama Ruangan</td>
                            <td class="px-2 text-center w-2">:</td>
                            <td class="text-left">1</td>
                        </tr>
                        <tr>
                            <td class="pr-4 font-semibold text-right">Nomor Ruangan</td>
                            <td class="px-2 text-center">:</td>
                            <td class="text-left">1</td>
                        </tr>
                        <tr>
                            <td class="pr-4 font-semibold text-right">Jumlah PC</td>
                            <td class="px-2 text-center">:</td>
                            <td class="text-left">1</td>
                        </tr>
                        <tr>
                            <td class="pr-4 font-semibold text-right">Kapasitas Orang</td>
                            <td class="px-2 text-center">:</td>
                            <td class="text-left">1</td>
                        </tr>
                    <tr>
                            <td class="pr-4 font-semibold text-right align-top" rowspan="12">Fasilitas</td>
                            <td class="px-2 text-center align-top" rowspan="12">:</td>
                            <td class="text-left">1 PC</td>
                        </tr>
                        <tr>
                            <td class="text-left">AC 2</td>
                        </tr>

                    </tbody>
                </table>
            </div>

        <!-- Gambar & Tombol -->
            <div class="flex flex-col items-center gap-4">
                <img alt="Office room with desks and chairs, modern interior with computers on desks and office chairs" class="rounded-lg object-cover w-[300px] h-[220px]" height="120" src="https://storage.googleapis.com/a1aa/image/489c915a-6fbd-433d-9bc5-2956ded13a39.jpg" width="200"/>
                <div class="flex gap-2">
                <button class="bg-blue-600 hover:bg-blue-700 text-white text-xs rounded px-4 py-2 flex items-center gap-1" type="button">
                    <i class="fas fa-edit"></i>
                    Edit
                </button>
                <button class="bg-red-600 hover:bg-red-700 text-white text-xs rounded px-4 py-2 flex items-center gap-1" type="button">
                    <i class="fas fa-trash-alt"></i>
                    Hapus
                </button>
                </div>
            </div>
        </div>


      </section>

@endsection
