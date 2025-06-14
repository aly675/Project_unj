@extends('layouts.layout')

@section('main')
@php
    $user = Auth::user();
    $redirectTo = route('login');
    if ($user) {
        $role = strtolower($user->role);
        $redirectTo = route("{$role}.dashboard-page");
    }
@endphp
<div class="bg-white rounded-lg shadow-lg p-10 max-w-md text-center">
    <h1 class="text-6xl font-extrabold text-red-600 mb-4">404</h1>
    <h2 class="text-2xl font-semibold mb-2">Not Found</h2>
    <p class="text-gray-600 mb-6">Hamalan ini tidak tersedia.</p>

    <a href="{{ $redirectTo }}"
        class="inline-block bg-blue-600 text-white px-6 py-3 rounded-md font-medium hover:bg-blue-700 transition">
        ← Kembali
    </a>
</div>

@endsection
