@extends('layouts.admin-layout')

@section('title', 'Daftar Referensi')

@section('main')
<section class="flex-1">
    <h1 class="text-gray-900 font-extrabold text-2xl mb-4">Daftar Referensi</h1>
    <div class="flex flex-wrap items-center gap-3 mb-6 text-xl text-gray-400">
        <!-- ... Search & Filter ... -->
        <div class="ml-auto">
            <a href="{{ route('admin.tambah-ruangan-page') }}" class="bg-teal-800 text-white rounded-full px-6 py-2 text-sm font-semibold hover:bg-teal-900 transition-colors whitespace-nowrap">
                Tambah Data
            </a>
        </div>
    </div>

    @foreach($ruangans as $ruangan)
        <div class="bg-white bg-opacity-30 shadow-xl rounded-xl p-10 max-w-9xl flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-8">
            <!-- Table Data Ruangan -->
            <div class="flex-1 overflow-x-10">
                <table class="w-full text-sm text-gray-900 font-normal">
                    <tbody>
                        <tr>
                            <td class="pr-4 font-semibold text-right w-[150px]">Nama Ruangan</td>
                            <td class="px-2 text-center w-2">:</td>
                            <td class="text-left">{{ $ruangan->nama }}</td>
                        </tr>
                        <tr>
                            <td class="pr-4 font-semibold text-right">Nomor Ruangan</td>
                            <td class="px-2 text-center">:</td>
                            <td class="text-left">{{ $ruangan->nomor }}</td>
                        </tr>
                        <tr>
                            <td class="pr-4 font-semibold text-right">Kapasitas Orang</td>
                            <td class="px-2 text-center">:</td>
                            <td class="text-left">{{ $ruangan->kapasitas }}</td>
                        </tr>
                        <tr>
                            <td class="pr-4 font-semibold text-right align-top" rowspan="{{ max(1, $ruangan->fasilitas->count()) }}">Fasilitas</td>
                            <td class="px-2 text-center align-top" rowspan="{{ max(1, $ruangan->fasilitas->count()) }}">:</td>
                            <td class="text-left">
                                @if($ruangan->fasilitas->count())
                                    {{ $ruangan->fasilitas[0]->nama }}
                                    @if($ruangan->fasilitas[0]->pivot->jumlah > 1)
                                        x{{ $ruangan->fasilitas[0]->pivot->jumlah }}
                                    @endif
                                @else
                                    <em>Tidak ada fasilitas</em>
                                @endif
                            </td>
                        </tr>
                        @foreach($ruangan->fasilitas->slice(1) as $fasilitas)
                            <tr>
                                <td class="text-left">
                                    {{ $fasilitas->nama }}
                                    @if($fasilitas->pivot->jumlah > 1)
                                        x{{ $fasilitas->pivot->jumlah }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Gambar & Tombol -->
            <div class="flex flex-col items-center gap-4">
                <img alt="Gambar Ruangan" class="rounded-lg object-cover w-[300px] h-[220px]"
                     src="{{ $ruangan->gambar ? asset('storage/'.$ruangan->gambar) : asset('/placeholder.svg') }}" width="200" height="120"/>
                <div class="flex gap-2">
                    <a href="{{ route('admin.update-ruangan-page', ['id' => $ruangan->id]) }}" class="bg-blue-600 hover:bg-blue-700 text-white text-xs rounded px-4 py-2 flex items-center gap-1">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form method="POST" action="{{ route('admin.delete-ruangan', $ruangan->id) }}" onsubmit="return confirm('Yakin ingin hapus ruangan ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-600 hover:bg-red-700 text-white text-xs rounded px-4 py-2 flex items-center gap-1" type="submit">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    @if($ruangans->isEmpty())
        <div class="text-center text-gray-500 py-10">Belum ada data ruangan.</div>
    @endif
</section>
@endsection
