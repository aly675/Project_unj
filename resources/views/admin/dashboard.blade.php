@extends('layouts.admin-layout')

@section('title', 'Dashboard')

@section('main')

      <h1 class="text-2xl font-semibold text-gray-800">Ringkasan</h1>

        <div class="flex-1 flex flex-col">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-6">
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

            <div class="bg-white p-4 mt-6 rounded-lg shadow-md">
                <h2 class="font-semibold">Daftar Pengguna</h2>

                <div class="flex justify-between items-center mt-4">
                    <input type="text" placeholder="Cari..." class="border p-2 rounded-lg w-1/2">
                    <select class="border p-2 rounded-lg ml-2">
                        <option>Sort by</option>
                        <option>Name</option>
                        <option>Email</option>
                    </select>
                </div>

                <table class="table-auto w-full mt-4">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">Nama</th>
                            <th class="border px-4 py-2">Email</th>
                            <th class="border px-4 py-2">Telepon</th>
                            <th class="border px-4 py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border px-4 py-2">Jane Casper</td>
                            <td class="border px-4 py-2">jane@gmail.com</td>
                            <td class="border px-4 py-2">(123) 456-7890</td>
                            <td class="border px-4 py-2 text-green-600">Aktif</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2">Floyd Miles</td>
                            <td class="border px-4 py-2">floyd@gmail.com</td>
                            <td class="border px-4 py-2">(123) 456-7890</td>
                            <td class="border px-4 py-2 text-red-600">Tidak Aktif</td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>

                    <div class="mt-4">
                    <p>Showing 1 to 2 of 2 entries</p>
                    </div>
                </div>
            </div>
        </div>


@endsection

@section('js')
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 <script src="{{asset('assets/js/admin/dashboard-admin-ringkasan.js')}}"></script>
@endsection
