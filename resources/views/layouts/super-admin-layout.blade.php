<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>
   SuperAdmin | @yield('title')
  </title>
  <link rel="icon" href="{{asset('assets/images/logo_unj.svg')}}">
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
  <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'teal-custom': '#1a9b8e',
                        'teal-dark': '#0f766e'
                    }
                }
            }
        }
    </script>
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
         {{ request()->routeIs('superadmin.dashboard-page') ? 'bg-teal-700 text-white' : '' }}"
          href="{{route('superadmin.dashboard-page')}}">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0 -translate-y-0.5" viewBox="0 0 24 24" fill="currentColor">
          <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
          <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
        </svg>

          <span class="sidebar-text">Dashboard</span>
        </a>

        <a class="flex hover:bg-teal-700 items-center gap-3 px-7 py-6 hover:text-white transition-colors
         {{ request()->routeIs('superadmin.manejemen-users-page') ? 'bg-teal-700 text-white' : '' }}"
          href="{{route('superadmin.manejemen-users-page')}}">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0 translate-x-0.5" viewBox="0 0 16 16" fill="currentColor">
          <path d="M8.5 4.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0ZM10 13c.552 0 1.01-.452.9-.994a5.002 5.002 0 0 0-9.802 0c-.109.542.35.994.902.994h8ZM12.5 3.5a.75.75 0 0 1 .75.75v1h1a.75.75 0 0 1 0 1.5h-1v1a.75.75 0 0 1-1.5 0v-1h-1a.75.75 0 0 1 0-1.5h1v-1a.75.75 0 0 1 .75-.75Z" />
         </svg>

          <span class="sidebar-text">Manajemen Pengguna</span>
        </a>
      </nav>
    </aside>

  <!-- Main content -->
  <div class="flex-1 flex flex-col">
   <!-- Header -->
   <header class="flex justify-between items-center bg-white px-6 py-3 border-b border-gray-200">
   <div class="flex items-center gap-1.5 text-gray-400 text-sm md:text-base">
        <img alt="Toggle Sidebar" onclick="toggleSidebar()" class="fas text-base" src="{{ asset('assets/images/icon/sidebar-icon.svg') }}">
           {{-- Super Admin --}}
        <span class="{{ request()->routeIs('superadmin.dashboard-page') ? 'text-gray-900 font-semibold' : '' }}">
            <a href="{{ route('superadmin.dashboard-page') }}">Super Admin</a>
        </span>

        {{-- Dashboard --}}
        @if(request()->routeIs('superadmin.dashboard-page'))
            <span class="text-gray-900 font-semibold">/ Dashboard</span>
        @endif

        {{-- Manejemen Users --}}
        @if(
            request()->routeIs('superadmin.manejemen-users-page') ||
            request()->routeIs('superadmin.tambah-user-page')
        )
            <span class="text-gray-900 font-semibold">/</span>
            <span class="{{ request()->routeIs('superadmin.manejemen-users-page') ? 'text-gray-900 font-semibold' : '' }}">
                <a href="{{ route('superadmin.manejemen-users-page') }}">Manejemen Users</a>
            </span>
        @endif

        {{-- Tambah / Update User --}}
        @if(request()->routeIs('superadmin.tambah-user-page'))
            <span class="text-gray-900 font-semibold">/ Tambah Peminjaman</span>
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
  <script src="https://unpkg.com/lucide@latest"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @yield('js')
 </body>
</html>
