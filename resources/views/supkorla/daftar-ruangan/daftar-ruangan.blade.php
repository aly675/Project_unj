@extends('layouts.supkorla-layout')

@section('title', 'Daftar Ruangan')

@section('page', 'Daftar Ruangan')

@section('style')
    <style>

    </style>
@endsection

@section('main')

    <h1 class="text-gray-900 font-extrabold text-2xl mb-4">Daftar Ruangan</h1>
    <div class="flex flex-wrap items-center gap-3 mb-6 text-xl text-gray-400">
        {{-- Search & Add Button --}}
        <div class="flex items-center justify-between gap-4 w-full">
            <div class="relative w-full max-w-sm">
                <input
                    type="text"
                    name="search"
                    placeholder="Cari ruangan..."
                    class="w-full pl-10 pr-4 py-2 rounded-full border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:outline-none text-sm text-gray-700"
                >
                <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z"/>
                    </svg>
                </div>
            </div>

        </div>

    </div>

    @foreach($ruangans as $ruangan)
        <div class="bg-white bg-opacity-30 shadow-xl rounded-xl p-10 max-w-9xl flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-8">
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
                                        (Jumlah Fasilitas : {{ $ruangan->fasilitas[0]->pivot->jumlah }})
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
                                        (Jumlah Fasilitas : {{ $fasilitas->pivot->jumlah }})
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex flex-col items-center gap-4">
                <img alt="Gambar Ruangan" class="rounded-lg object-cover w-[300px] h-[220px]"
                    src="{{ $ruangan->gambar ? asset('storage/'.$ruangan->gambar) : asset('/placeholder.svg') }}" width="200" height="120"/>
            </div>
        </div>
    @endforeach

    @if($ruangans->isEmpty())
        <div class="text-center text-gray-500 py-10">Belum ada data ruangan.</div>
    @endif
@endsection

@section('js')

@endsection
