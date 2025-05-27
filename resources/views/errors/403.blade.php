<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>403 - Akses Ditolak</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen px-4">

@php
    use Illuminate\Support\Facades\Auth;

    $dashboardRoute = route('login'); // default guest

    if (Auth::check()) {
        switch (Auth::user()->role) {
            case 'superadmin':
                $dashboardRoute = route('superadmin.dashboard');
                break;
            case 'admin':
                $dashboardRoute = route('admin.dashboard');
                break;
            case 'kepalaupt':
                $dashboardRoute = route('kepalaupt.dashboard');
                break;
            case 'supkorla':
                $dashboardRoute = route('supkorla.dashboard');
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

</body>
</html>
