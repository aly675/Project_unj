@extends('layouts.super-admin-layout')

@section('title', 'Dashboard')

@section('style')
    <style>
    .chart-container {
      position: relative;
      height: 200px;
      width: 100%;
    }

    .chart-line {
      fill: none;
      stroke: #333;
      stroke-width: 2;
    }

    .chart-line-secondary {
      fill: none;
      stroke: #ccc;
      stroke-width: 1.5;
      stroke-dasharray: 4;
    }
    </style>
@endsection

@section('main')
        <h1 class="text-2xl font-semibold mb-6">Ringkasan</h1>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
          <div class="bg-blue-100 rounded-lg p-4">
            <div class="text-sm text-gray-600">Total User</div>
            <div class="text-2xl font-bold">{{$totalUsers}}</div>
          </div>
          <div class="bg-blue-100 rounded-lg p-4">
            <div class="text-sm text-gray-600">Role Aktif</div>
            <div class="text-2xl font-bold">15</div>
          </div>
          <div class="bg-blue-100 rounded-lg p-4">
            <div class="text-sm text-gray-600">Pengguna Aktif</div>
            <div class="text-2xl font-bold">{{$activeUsers}}</div>
          </div>
          <div class="bg-blue-100 rounded-lg p-4">
            <div class="text-sm text-gray-600">Pengguna Nonaktif</div>
            <div class="text-2xl font-bold">{{$nonActiveUsers}}</div>
          </div>
        </div>

        <!-- User Table -->
        <div class="bg-white rounded-lg p-6 shadow-sm">
          <div class="flex justify-between items-center mb-6">
            <div>
              <h2 class="text-lg font-semibold">Daftar Pengguna</h2>
              <div class="text-sm text-green-500">Pengguna Aktif</div>
            </div>

            <div class="flex gap-4">
              <div class="relative">
                <input type="text" placeholder="Search" class="pl-8 pr-4 py-2 border rounded-lg text-sm w-64">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 absolute left-2.5 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
              </div>

              <div class="flex items-center gap-2">
                <span class="text-sm text-gray-500">Sort by:</span>
                <button class="flex items-center gap-1 text-sm">
                  Newest
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                  </svg>
                </button>
              </div>
            </div>
          </div>

          <div class="overflow-x-auto">
            <table class="w-full">
              <thead>
                <tr class="text-left text-sm text-gray-500 border-b">
                  <th class="pb-3 font-medium">Nama</th>
                  <th class="pb-3 font-medium">Role</th>
                  <th class="pb-3 font-medium">Email</th>
                  <th class="pb-3 font-medium">Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $data )
                <tr class="border-b">
                  <td class="py-4">{{$data->name}}</td>
                  <td class="py-4">{{$data->role}}</td>
                  <td class="py-4">{{$data->email}}</td>
                  <td class="py-4">
                    <span class="px-3 py-1 {{$data->status === 'aktif' ? 'text-green-800 bg-green-100' : 'text-red-800 bg-red-100'}}  rounded-md text-xs">{{$data->status}}</span>
                  </td>
                </tr>
                @endforeach
                <tr class="border-b">
                  <td class="py-4">Floyd Miles</td>
                  <td class="py-4">Yahoo</td>
                  <td class="py-4">(205) 555-0100</td>
                  <td class="py-4">
                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-md text-xs">Nonaktif</span>
                  </td>
                </tr>
                <tr class="border-b">
                  <td class="py-4">Ronald Richards</td>
                  <td class="py-4">Adobe</td>
                  <td class="py-4">(302) 555-0107</td>
                  <td class="py-4">
                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-md text-xs">Inactive</span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="flex justify-between items-center mt-6">
            <div class="text-sm text-gray-500">
              Showing data 1 to 8 of 256K entries
            </div>

            <div class="flex gap-2">
              <button class="w-8 h-8 flex items-center justify-center rounded-md border">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
              </button>
              <button class="w-8 h-8 flex items-center justify-center rounded-md bg-blue-600 text-white">1</button>
              <button class="w-8 h-8 flex items-center justify-center rounded-md border">2</button>
              <button class="w-8 h-8 flex items-center justify-center rounded-md border">3</button>
              <button class="w-8 h-8 flex items-center justify-center rounded-md border">4</button>
              <button class="w-8 h-8 flex items-center justify-center rounded-md border">...</button>
              <button class="w-8 h-8 flex items-center justify-center rounded-md border">40</button>
              <button class="w-8 h-8 flex items-center justify-center rounded-md border">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
              </button>
            </div>
          </div>
        </div>
@endsection

@section('js')

@endsection
