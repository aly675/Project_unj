<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>
   Admin | @yield('title')
  </title>
  <link rel="icon" href="{{asset('assets/images/logo_unj.svg')}}">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet"/>
    <!-- Toastify -->
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <style>
   body
    {
      font-family: 'Poppins', sans-serif;
    }

      /* Custom transition for dropdown showing with delay */
    .dropdown-enter {
      max-height: 0;
      opacity: 0;
      transform-origin: top;
      transition:
        max-height 0.3s ease,
        opacity 0.3s ease 0.2s,
        padding-top 0.3s ease 0.2s,
        padding-bottom 0.3s ease 0.2s;
      overflow: hidden;
      padding-top: 0;
      padding-bottom: 0;
    }
    .dropdown-enter-active {
      max-height: 200px; /* enough to show content */
      opacity: 1;
      padding-top: 0.25rem; /* 1 */
      padding-bottom: 0.25rem; /* 1 */
    }
    .dropdown-leave {
      max-height: 200px;
      opacity: 1;
      padding-top: 0.25rem;
      padding-bottom: 0.25rem;
      transform-origin: top;
      transition:
        max-height 0.3s ease,
        opacity 0.3s ease,
        padding-top 0.3s ease,
        padding-bottom 0.3s ease;
    }
    .dropdown-leave-active {
      max-height: 0;
      opacity: 0;
      padding-top: 0;
      padding-bottom: 0;
    }

    </style>

    @yield('style')

 </head>
 <body class="bg-gray-100 min-h-screen flex">
  <!-- Sidebar -->
     <aside id="sidebar" class="bg-teal-800 w-64 transition-all duration-300 ease-in-out min-h-screen flex flex-col">
      <div class="flex items-center gap-3 px-6 py-8 border-b border-teal-700">
        <img alt="logo unj" class="w-8 h-8" src="{{asset('assets/images/icon/logo-unj.svg')}}">
        <div id="sidebar-labels">
          <h1 class="text-white font-extrabold text-sm uppercase leading-none">PUSTIKOM</h1>
          <p class="text-teal-300 text-[10px] mt-1 leading-tight">UNIVERSITAS NEGERI JAKARTA</p>
        </div>
      </div>

      <nav class="flex flex-col mt-6 text-teal-300 text-sm font-medium">
        <a class="flex hover:bg-teal-700 items-center gap-3 px-7 py-3 hover:text-white transition-colors
         {{ request()->routeIs('admin.dashboard-page') ? 'bg-teal-700 text-white font-semibold' : '' }}"
          href="{{route('admin.dashboard-page')}}">
          <img alt="" src="{{asset('assets/images/icon/home-icon.svg')}}" class="w-5 h-5"/>
          <span class="sidebar-text">Dashboard</span>
        </a>

        <a class="flex hover:bg-teal-700 items-center gap-3 px-7 py-3 hover:text-white transition-colors
         {{ request()->routeIs('admin.peminjaman-page') ? 'bg-teal-700 text-white font-semibold' : '' }}"
          href="{{route('admin.peminjaman-page')}}">
          <img alt="" src="{{asset('assets/images/icon/peminjaman-icon.svg')}}" class="w-5 h-5"/>
          <span class="sidebar-text">Peminjaman</span>
        </a>

                <!-- Dropdown Daftar Referensi -->
          <button id="dropdownToggle" aria-expanded="false" aria-controls="dropdownMenu" class="flex hover:bg-teal-700 items-center gap-3 px-7 py-3 hover:text-white transition-colors
          {{ request()->routeIs('admin.daftar-referensi-page') ||
            request()->routeIs('admin.daftar-fasilitas-page') ||
            request()->routeIs('admin.tambah-ruangan-page') ? 'bg-teal-700 text-white font-semibold' : ''}}">
                <img alt="" src="{{asset('assets/images/icon/referensi-icon.svg')}}" class="w-5 h-5"/>
                <span class="sidebar-text">Daftar Referensi</span>
            <svg id="dropdownChevron" class="w-5 h-5 ml-auto transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
            </svg>
          </button>

        @php
            $isDropdownOpen = request()->routeIs('admin.daftar-referensi-page') || request()->routeIs('admin.daftar-fasilitas-page') || request()->routeIs('admin.tambah-ruangan-page');
        @endphp

        <div id="dropdownMenu"
            class="overflow-hidden max-h-60 mt-1 ml-8 text-teal-200 select-none {{ $isDropdownOpen ? '' : 'opacity-0' }}"
            style="transition: max-height 0.3s ease, opacity 0.3s ease 0.2s, padding-top 0.3s ease 0.2s, padding-bottom 0.3s ease 0.2s;
            {{ $isDropdownOpen ? 'display: block; max-height: 1000px; opacity: 1; padding-top: 0.25rem; padding-bottom: 1.45rem;' : 'display: none; padding-top: 0; padding-bottom: 0; max-height: 0;' }}">
                <ul class="relative px-1 space-y-1 max-h-dvh">
                    <div class="absolute top-0 left-0 h-full border-l border-teal-400 ml-2"></div>
                    <li class="relative pl-4">
                        <div class="absolute top-1/2 left-0 w-2 border-t  border-teal-400"></div>
                        <a href="{{route('admin.daftar-referensi-page')}}" class="block hover:bg-teal-700 rounded-full py-1 px-4 hover:text-white transition-colors cursor-pointer
                        {{ request()->routeIs('admin.daftar-referensi-page') || request()->routeIs('admin.tambah-ruangan-page') ? 'bg-teal-700 text-white font-semibold' : ''}}">
                         Daftar Ruangan</a>
                    </li>
                    <li class="relative pl-4">
                        <div class="absolute top-1/2 left-0 w-2 border-t border-teal-400"></div>
                        <a href="{{route('admin.daftar-fasilitas-page')}}" class="block hover:bg-teal-700 rounded-full py-1 px-4 cursor-pointer hover:text-white transition-colors
                        {{ request()->routeIs('admin.daftar-fasilitas-page') ? 'bg-teal-700 text-white font-semibold' : ''}}">
                         Daftar Fasilitas
                        </a>
                    </li>
                </ul>
            </div>
      </nav>
    </aside>

  <!-- Main content -->
  <div class="flex-1 flex flex-col">
   <!-- Header -->
   <header class="flex justify-between items-center bg-white px-6 py-4 border-b border-gray-200">
   <div class="flex items-center gap-2 text-gray-400 text-sm font-normal">
        <img alt="" onclick="toggleSidebar()" class="fas text-base" src="{{ asset('assets/images/icon/sidebar-icon.svg') }}">

        {{-- Admin --}}
        <span class="{{ request()->routeIs('admin.dashboard-page') ? 'text-gray-900 font-semibold' : '' }}">
            <a href="{{ route('admin.dashboard-page') }}">Admin</a>
        </span>

        {{-- Dashboard --}}
        @if(request()->routeIs('admin.dashboard-page'))
            <span class="text-gray-900 font-semibold">/ Dashboard</span>
        @endif

        {{-- Peminjaman --}}
        @if(
            request()->routeIs('admin.peminjaman-page') ||
            request()->routeIs('admin.tambah-peminjaman-page') ||
            request()->routeIs('admin.detail-peminjaman-page') ||
            request()->routeIs('admin.update-peminjaman-page')
        )
            <span class="text-gray-900 font-semibold">/</span>
            <span class="{{ request()->routeIs('admin.peminjaman-page') ? 'text-gray-900 font-semibold' : '' }}">
                <a href="{{ route('admin.peminjaman-page') }}">Peminjaman</a>
            </span>
        @endif

        {{-- Tambah / Detail / Update Peminjaman --}}
        @if(request()->routeIs('admin.tambah-peminjaman-page'))
            <span class="text-gray-900 font-semibold">/ Tambah Peminjaman</span>
        @elseif(request()->routeIs('admin.detail-peminjaman-page'))
            <span class="text-gray-900 font-semibold">/ Detail Peminjaman</span>
        @elseif(request()->routeIs('admin.update-peminjaman-page'))
            <span class="text-gray-900 font-semibold">/ Update Peminjaman</span>
        @endif

        {{-- Daftar Referensi --}}
        @if(
            request()->routeIs('admin.daftar-referensi-page') ||
            request()->routeIs('admin.tambah-ruangan-page') ||
            request()->routeIs('admin.daftar-fasilitas-page')
        )
            <span class="">
                <a href="{{ route('admin.daftar-referensi-page') }}">
                    / Daftar Referensi
                </a>
            </span>
        @endif

        {{-- Tambah / Detail / Update Ruangan --}}
        @if(request()->routeIs('admin.tambah-ruangan-page'))
            <span><a href="{{ route('admin.daftar-referensi-page') }}"> / Daftar Ruangan</a></span>
            <span class="text-gray-900 font-semibold">/ Tambah Ruangan</span>
        @elseif(request()->routeIs('admin.daftar-referensi-page'))
            <span class="{{ request()->routeIs('admin.daftar-referensi-page') ? 'text-gray-900 font-semibold' : '' }}">
                <a href="{{ route('admin.daftar-referensi-page') }}"> / Daftar Ruangan</a>
            </span>
        @elseif(request()->routeIs('admin.daftar-fasilitas-page'))
            <span class="text-gray-900 font-semibold">
                <a href="{{route('admin.daftar-fasilitas-page')}}">
                    / Daftar Fasilitas
                </a>
            </span>
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
  <script>
    const toggleBtn = document.getElementById('dropdownToggle');
    const dropdownMenu = document.getElementById('dropdownMenu');
    const chevron = document.getElementById('dropdownChevron');

    const isOpenInitially = dropdownMenu.style.display === 'block';
    if (isOpenInitially) {
        chevron.style.transform = 'rotate(180deg)';
    }

    toggleBtn.addEventListener('click', () => {
        const expanded = toggleBtn.getAttribute('aria-expanded') === 'true';
        toggleBtn.setAttribute('aria-expanded', String(!expanded));

        if (!expanded) {
            dropdownMenu.style.display = 'block';
            void dropdownMenu.offsetWidth;
            dropdownMenu.style.maxHeight = '1000px';
            dropdownMenu.style.opacity = '1';
            dropdownMenu.style.paddingTop = '0.25rem';
            dropdownMenu.style.paddingBottom = '1.45rem';
            chevron.style.transform = 'rotate(180deg)';
        } else {
            dropdownMenu.style.maxHeight = '0';
            dropdownMenu.style.opacity = '0';
            dropdownMenu.style.paddingTop = '0';
            dropdownMenu.style.paddingBottom = '0';
            chevron.style.transform = 'rotate(0deg)';

            dropdownMenu.addEventListener('transitionend', function handler() {
                if (dropdownMenu.style.maxHeight === '0px') {
                    dropdownMenu.style.display = 'none';
                }
                dropdownMenu.removeEventListener('transitionend', handler);
            });
        }
    });

  </script>
  <script src="{{asset('assets/js/layout/script.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @yield('js')
 </body>
</html>
