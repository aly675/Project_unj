@php
    switch ($profile->role) {
        case 'superadmin':
            $layout = 'layouts.super-admin-layout';
            break;
        case 'admin':
            $layout = 'layouts.admin-layout';
            break;
        case 'kepalaupt':
            $layout = 'layouts.kepala-upt-layout';
            break;
        case 'supkorla':
            $layout = 'layouts.supkorla-layout';
            break;
        case '':
        default:
            $layout = 'layouts.layout';
            break;
    }
@endphp


@extends($layout)

@section('title', 'Profile')

@section('main')
  <!-- Main Content -->
  <main class="p-4 sm:p-6">
    <div class="max-w-7xl mx-auto">
      <h2 class="text-sm font-semibold text-gray-700 mb-1">Informasi Profil</h2>
      <p class="text-xs text-gray-500 mb-6">
        Perbarui foto profil Anda untuk menjaga tampilan akun tetap terkini. Data pribadi lainnya diambil secara otomatis dari Kepegawaian.
      </p>

      <div class="flex flex-col lg:flex-row gap-4">
        <!-- Profile Photo -->
        <div class="bg-gray-200 rounded-lg p-6 flex flex-col items-center justify-center w-full lg:w-1/3">
          <div class="relative">
            <img src="{{ $profile->image ? asset('storage/' . $profile->image) : asset('assets/images/icon/none-profile-icon.svg') }}" class="w-40 h-40 rounded-full border-4 border-white shadow object-cover" alt="Foto Profil">
            <span class="absolute -top-2 -right-2 bg-green-200 text-green-700 text-xs px-2 py-1 rounded-full">{{$profile->status}}</span>
          </div>
        </div>

        <!-- Form -->
        <div class="bg-gray-200 rounded-lg p-6 w-full lg:w-2/3">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="text-xs text-gray-600 block mb-1">Nama Lengkap:</label>
              <input type="text" class="w-full p-2 rounded border border-gray-300 text-sm" value="{{$profile->name}}" placeholder="Nama Lengkap">
            </div>
            <div>
              <label class="text-xs text-gray-600 block mb-1">Role:</label>
              <input type="text" class="w-full p-2 rounded border border-gray-300 text-sm" disabled value="{{$profile->role}}" placeholder="Username">
            </div>
            <div>
              <label class="text-xs text-gray-600 block mb-1">Email:</label>
              <input type="email" class="w-full p-2 rounded border border-gray-300 text-sm" value="{{$profile->email}}" placeholder="Email">
            </div>
            <div>
              <label class="text-xs text-gray-600 block mb-1">WhatsApp:</label>
              <input type="text" class="w-full p-2 rounded border border-gray-300 text-sm" placeholder="WhatsApp">
            </div>
            <div class="md:col-span-2">
              <label class="text-xs text-gray-600 block mb-1">Alamat:</label>
              <textarea rows="3" class="w-full p-2 rounded border border-gray-300 text-sm" placeholder="Alamat"></textarea>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

@endsection
