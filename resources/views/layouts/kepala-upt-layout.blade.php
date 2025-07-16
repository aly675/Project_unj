<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Kepala UPT | @yield('title')
  </title>
  <link rel="icon" href="{{asset('assets/images/logo_unj.svg')}}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://cdn.tailwindcss.com">
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
  @yield('style')
 </head>
 <body class="bg-gray-100 min-h-screen flex">
  <!-- Sidebar -->
    <aside id="sidebar" class="bg-teal-800 w-64 transition-all duration-300 ease-in-out min-h-screen flex flex-col">
      <div class="flex items-center gap-3 px-6 py-7 border-b border-teal-700">
        <img alt="logo unj" class="w-8 h-8" src="{{asset('assets/images/icon/logo-unj.svg')}}">
        <div id="sidebar-labels">
          <h1 class="text-white font-bold text-sm uppercase leading-none tracking-wider">PUSTIKOM</h1>
          <p class="text-white text-[0.625rem] mt-1 leading-tight tracking-wider">UNIVERSITAS NEGERI JAKARTA</p>
        </div>
      </div>

      <nav id="sidebar" class="flex flex-col mt-6 text-white/70 text-sm space-y-1 group">
        <a class="flex hover:bg-teal-700 items-center gap-3 px-7 py-6 hover:text-white transition-colors
         {{ request()->routeIs('kepalaupt.dashboard-page') ? 'bg-teal-700 text-white' : '' }}"
          href="{{route('kepalaupt.dashboard-page')}}">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0 -translate-y-0.5" viewBox="0 0 24 24" fill="currentColor">
          <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
          <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
        </svg>

          <span class="sidebar-text">Dashboard</span>
        </a>


       <a class="flex hover:bg-teal-700 items-center gap-5 px-7 py-6 hover:text-white transition-colors
         {{ request()->routeIs('') ||
           request()->routeIs('kepalaupt.pengajuan-surat-page') ? 'bg-teal-700 text-white' : '' }}"
          href="{{route('kepalaupt.pengajuan-surat-page')}}">
         <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0 -translate-y-0.5" viewBox="0 0 512 512">
            <path fill="currentColor" d="M215.4 96L144 96l-36.2 0L96 96l0 8.8L96 144l0 40.4 0 89L.2 202.5c1.6-18.1 10.9-34.9 25.7-45.8L48 140.3 48 96c0-26.5 21.5-48 48-48l76.6 0 49.9-36.9C232.2 3.9 243.9 0 256 0s23.8 3.9 33.5 11L339.4 48 416 48c26.5 0 48 21.5 48 48l0 44.3 22.1 16.4c14.8 10.9 24.1 27.7 25.7 45.8L416 273.4l0-89 0-40.4 0-39.2 0-8.8-11.8 0L368 96l-71.4 0-81.3 0zM0 448L0 242.1 217.6 403.3c11.1 8.2 24.6 12.7 38.4 12.7s27.3-4.4 38.4-12.7L512 242.1 512 448s0 0 0 0c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64c0 0 0 0 0 0zM176 160l160 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-160 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64l160 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-160 0c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
        </svg>


          <span class="sidebar-text">Pengajuan Surat</span>
        </a>


        <a class="flex hover:bg-teal-700 items-center gap-5 px-7 py-6 hover:text-white transition-colors
         {{ request()->routeIs('') ||
           request()->routeIs('kepalaupt.kalender') ? 'bg-teal-700 text-white' : '' }}"
          href="{{route('kepalaupt.kalender')}}">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0 -translate-y-0.5" viewBox="0 0 448 512">
            <path fill="currentColor" d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm80 64c-8.8 0-16 7.2-16 16l0 64c0 8.8 7.2 16 16 16l288 0c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16L80 256z"/>
        </svg>


          <span class="sidebar-text">Kalender</span>
        </a>
      </nav>
    </aside>

  <!-- Main content -->
  <div class="flex-1 flex flex-col">
   <!-- Header -->
   <header class="flex justify-between items-center bg-white px-6 py-4 border-b border-gray-200">
    <div class="flex items-center gap-1.5 text-gray-400 text-sm font-normal md:text-base">
     <img alt="" onclick="toggleSidebar()" class="fas text-base" src="{{asset('assets/images/icon/sidebar-icon.svg')}}">
      <span class="ml-2 {{ request()->routeIs('kepalaupt.dashboard-page') ? 'text-gray-700 font-semibold ' : '' }}">
            <a href="{{route('kepalaupt.dashboard-page')}}">Kepala PUSTIKOM</a>
        </span>
       @if(request()->routeIs('kepalaupt.dashboard-page'))
            <span class="text-gray-700 font-semibold">/ Dashboard</span>
        @endif
       @if(request()->routeIs('kepalaupt.pengajuan-surat-page'))
            <span class="text-gray-700 font-semibold">/ Pengajuan Surat</span>
        @endif
       @if(request()->routeIs('kepalaupt.kalender'))
            <span class="text-gray-700 font-semibold">/ Kalender</span>
        @endif
    </div>


   <div class="relative">
  <!-- Profile Button -->
  <button id="profile-button" class="flex items-center gap-3 bg-white hover:bg-gray-100 p-3 rounded-lg shadow-sm transition-colors duration-200 focus:outline-none">
  <img alt="Profile picture" class="w-10 h-10 rounded-full object-cover" src="{{ $profile->image ? asset('storage/' . $profile->image) : asset('assets/images/icon/none-profile-icon.svg') }}" />
  <div class="text-right">
    <p class="text-gray-900 font-semibold text-sm leading-tight">{{$profile->name}}</p>
    <p class="text-gray-400 text-xs leading-tight">{{Str::upper($profile->role)}} PUSTIKOM</p>
  </div>
</button>

  <!-- Dropdown Menu -->
<div id="profile-dropdown"
     class="absolute right-0 mt-2 w-44 bg-white rounded-xl shadow-xl ring-1 ring-gray-200 py-2 z-50 opacity-0 scale-95 pointer-events-none transition-all duration-200 ease-out">
  <a href="/profile"
     class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
    <i class="fas fa-user text-gray-400 text-xs"></i> Profile
  </a>
  <form id="logout-form" method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="button" onclick="logoutConfirm()"
            class="flex items-center gap-2 w-full px-4 py-2 text-sm text-red-500 hover:bg-gray-100 transition-colors">
      <i class="fas fa-sign-out-alt text-red-400 text-xs"></i> Logout
    </button>
  </form>
</div>

</div>


   </header>
   <!-- Content -->
   <main id="main-content" class="flex-1 p-6 overflow-auto transition-all duration-1000 ease-in-out">
        @yield('main')
   </main>
  </div>

  <script src="{{asset('assets/js/layout/script.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @yield('js')
 </body>
</html>
