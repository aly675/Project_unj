@extends('layouts.layout')

@section('main')

@php
    use Illuminate\Support\Facades\Auth;

    $dashboardRoute = route('login'); // default guest

    if (Auth::check()) {
        switch (Auth::user()->role) {
            case 'superadmin':
                $dashboardRoute = route('superadmin.dashboard-page');
                break;
            case 'admin':
                $dashboardRoute = route('admin.dashboard-page');
                break;
            case 'kepalaupt':
                $dashboardRoute = route('kepalaupt.dashboard-page');
                break;
            case 'supkorla':
                $dashboardRoute = route('supkorla.dashboard-page');
                break;
        }
    }
@endphp

<div class="bg-white rounded-lg shadow-lg p-10 max-w-md text-center">
    <h1 class="text-6xl font-extrabold text-red-600 mb-4">403</h1>
    <h2 class="text-2xl font-semibold mb-2">Akses Ditolak</h2>
    <p class="text-gray-600 mb-6">Anda tidak memiliki izin untuk mengakses halaman ini.</p>
    <a href="{{ $dashboardRoute }}"
       class="inline-block bg-blue-600 text-white px-6 py-3 rounded-md font-medium hover:bg-blue-700 transition">
       ← Kembali
    </a>
</div>

@endsection
