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
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet"/>
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
      <div class="flex items-center gap-3 px-6 py-7 border-b border-teal-700">
        <img alt="logo unj" class="w-8 h-8" src="{{asset('assets/images/icon/logo-unj.svg')}}">
        <div id="sidebar-labels">
          <h1 class="text-white font-bold text-sm uppercase leading-none tracking-wider">PUSTIKOM</h1>
          <p class="text-white text-[0.625rem] mt-1 leading-tight tracking-wider">UNIVERSITAS NEGERI JAKARTA</p>
        </div>
      </div>

      <nav id="sidebar" class="flex flex-col mt-6 text-white/70 text-sm space-y-1 group">
        <a class="flex hover:bg-teal-700 items-center gap-3 px-7 py-6 hover:text-white transition-colors
         {{ request()->routeIs('admin.dashboard-page') ? 'bg-teal-700 text-white' : '' }}"
          href="{{route('admin.dashboard-page')}}">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0 -translate-y-0.5" viewBox="0 0 24 24" fill="currentColor">
          <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
          <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
        </svg>

          <span class="sidebar-text">Dashboard</span>
        </a>

        <a class="flex hover:bg-teal-700 items-center gap-3 px-7 py-6 hover:text-white transition-colors
         {{ request()->routeIs('admin.peminjaman-page') ||
           request()->routeIs('admin.tambah-peminjaman-page') ? 'bg-teal-700 text-white' : '' }}"
          href="{{route('admin.peminjaman-page')}}">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0 -translate-y-0.5" viewBox="0 0 24 24" fill="currentColor">
          <path d="M11.625 16.5a1.875 1.875 0 1 0 0-3.75 1.875 1.875 0 0 0 0 3.75Z" />
          <path fill-rule="evenodd" d="M5.625 1.5H9a3.75 3.75 0 0 1 3.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 0 1 3.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 0 1-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875Zm6 16.5c.66 0 1.277-.19 1.797-.518l1.048 1.048a.75.75 0 0 0 1.06-1.06l-1.047-1.048A3.375 3.375 0 1 0 11.625 18Z" clip-rule="evenodd" />
          <path d="M14.25 5.25a5.23 5.23 0 0 0-1.279-3.434 9.768 9.768 0 0 1 6.963 6.963A5.23 5.23 0 0 0 16.5 7.5h-1.875a.375.375 0 0 1-.375-.375V5.25Z" />
        </svg>

          <span class="sidebar-text">Peminjaman</span>
        </a>

                <!-- Dropdown Daftar Referensi -->
          <button id="dropdownToggle" aria-expanded="false" aria-controls="dropdownMenu" class="flex hover:bg-teal-700 items-center gap-3 px-7 py-6 hover:text-white transition-colors
          {{ request()->routeIs('admin.daftar-referensi-page') ||
            request()->routeIs('admin.daftar-fasilitas-page') ||
            request()->routeIs('admin.tambah-ruangan-page') ? 'bg-teal-700 text-white' : ''}}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="currentColor"><path d="M3 13H21V21.0025C21 21.5534 20.5551 22 20.0066 22H3.9934C3.44476 22 3 21.5537 3 21.0025V13ZM3 2.99754C3 2.44662 3.44495 2 3.9934 2H20.0066C20.5552 2 21 2.44631 21 2.99754V11H3V2.99754ZM9 5V7H15V5H9ZM9 16V18H15V16H9Z"></path></svg>
                <span class="sidebar-text group-[.collapsed]:hidden">Daftar Referensi</span>
            <svg id="dropdownChevron" class="w-5 h-5 ml-auto transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
            </svg>
          </button>

        @php
            $isDropdownOpen = request()->routeIs('admin.daftar-referensi-page') || request()->routeIs('admin.daftar-fasilitas-page') || request()->routeIs('admin.tambah-ruangan-page');
        @endphp

        <div id="dropdownMenu"
            class="overflow-hidden mt-1 ml-8 text-white select-none transition-all duration-300 ease-in-out
            {{ $isDropdownOpen ? 'block max-h-60 opacity-100 pt-1 pb-6' : 'hidden max-h-0 opacity-0 pt-0 pb-0' }}">
            <ul class="relative px-1 space-y-1 max-h-dvh text-white/70">
            <div class="absolute top-0 left-0 h-full border-l border-white ml-2"></div>

            <li class="relative pl-4">
                <div class="absolute top-1/2 left-0 w-2 border-t border-white"></div>
                <a href="{{ route('admin.daftar-referensi-page') }}"
                class="block rounded-full py-2 px-4 transition-colors cursor-pointer
                hover:bg-teal-700 hover:text-white
                {{ request()->routeIs('admin.daftar-referensi-page') || request()->routeIs('admin.tambah-ruangan-page') ? 'bg-teal-700 text-white' : '' }}">
                Daftar Ruangan
                </a>
            </li>

            <li class="relative pl-4">
                <div class="absolute top-1/2 left-0 w-2 border-t border-white"></div>
                <a href="{{ route('admin.daftar-fasilitas-page') }}"
                class="block rounded-full py-2 px-4 transition-colors cursor-pointer
                hover:bg-teal-700 hover:text-white
                {{ request()->routeIs('admin.daftar-fasilitas-page') ? 'bg-teal-700 text-white' : '' }}">
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
   <header class="flex justify-between items-center bg-white px-6 py-3 border-b border-gray-200">
   <div class="flex items-center gap-1.5 text-gray-400 text-sm md:text-base">
        <img alt="Toggle Sidebar" onclick="toggleSidebar()" class="fas text-base" src="{{ asset('assets/images/icon/sidebar-icon.svg') }}">

        {{-- Admin --}}
        <span class="ml-2 {{ request()->routeIs('admin.dashboard-page') ? 'text-gray-700 font-medium ' : '' }}">
            <a href="{{ route('admin.dashboard-page') }}">Admin</a>
        </span>

        {{-- Dashboard --}}
        @if(request()->routeIs('admin.dashboard-page'))
            <span class="text-gray-700 font-medium">/ Dashboard</span>
        @endif

        {{-- Peminjaman --}}
        @if(
            request()->routeIs('admin.peminjaman-page') ||
            request()->routeIs('admin.tambah-peminjaman-page') ||
            request()->routeIs('admin.detail-peminjaman-page') ||
            request()->routeIs('admin.update-peminjaman-page')
        )
            <span class="text-gray-400">/</span>
            <a href="{{ route('admin.peminjaman-page') }}"
               class="{{ request()->routeIs('admin.peminjaman-page') ? 'text-gray-700 font-medium' : '' }}">
              Peminjaman
          </a>
        @endif

        {{-- Tambah / Detail / Update Peminjaman --}}
        @if(request()->routeIs('admin.tambah-peminjaman-page'))
            <span class="text-gray-400">/</span>
            <span class="text-gray-700 font-medium">Tambah Peminjaman</span>
        @elseif(request()->routeIs('admin.detail-peminjaman-page'))
            <span class="text-gray-400">/</span>
            <span class="text-gray-700 font-medium">Detail Peminjaman</span>
        @elseif(request()->routeIs('admin.update-peminjaman-page'))
            <span class="text-gray-400">/</span>
            <span class="text-gray-700 font-medium">Update Peminjaman</span>
        @endif

        {{-- Daftar Referensi --}}
        @if(
            request()->routeIs('admin.daftar-referensi-page') ||
            request()->routeIs('admin.tambah-ruangan-page') ||
            request()->routeIs('admin.daftar-fasilitas-page')
        )
            <span class="text-gray-400">/</span>
                <a href="{{ route('admin.daftar-referensi-page') }}">
                    Daftar Referensi
                </a>
        @endif

        {{-- Tambah / Detail / Update Ruangan --}}
        @if(request()->routeIs('admin.tambah-ruangan-page'))
            <span class="text-gray-400">/</span>
            <a href="{{ route('admin.daftar-referensi-page') }}">Daftar Ruangan</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-700 font-medium">Tambah Ruangan</span>
        @elseif(request()->routeIs('admin.daftar-referensi-page'))
            <span class="text-gray-400">/</span>
            <span class="{{ request()->routeIs('admin.daftar-referensi-page') ? 'text-gray-700 font-medium' : '' }}">
                <a href="{{ route('admin.daftar-referensi-page') }}">Daftar Ruangan</a>
            </span>
        @elseif(request()->routeIs('admin.daftar-fasilitas-page'))
            <span class="text-gray-400">/</span>
            <span class="text-gray-700 font-medium">
                <a href="{{route('admin.daftar-fasilitas-page')}}">Daftar Fasilitas</a>
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
  <form id="logout-form" method="POST" action="{{ route('logout') }}" class="m-0">
    @csrf
    <button type="button" onclick="logoutConfirm()"
            class="flex items-center gap-2 w-full px-4 py-2 text-sm text-red-500 hover:bg-gray-100 transition-colors m-0">
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

  toggleBtn.addEventListener('click', () => {
    const sidebar = document.getElementById('sidebar');

    // Kalau sidebar collapsed, abaikan klik dropdown
    if (sidebar.classList.contains('collapsed')) return;

    const isOpen = toggleBtn.getAttribute('aria-expanded') === 'true';
    toggleBtn.setAttribute('aria-expanded', String(!isOpen));

    if (!isOpen) {
      dropdownMenu.classList.add('block', 'max-h-60', 'opacity-100', 'pt-1', 'pb-6');
      dropdownMenu.classList.remove('hidden', 'max-h-0', 'opacity-0', 'pt-0', 'pb-0');
      chevron.style.transform = 'rotate(180deg)';
    } else {
      dropdownMenu.classList.add('max-h-0', 'opacity-0', 'pt-0', 'pb-0');
      dropdownMenu.classList.remove('max-h-60', 'opacity-100', 'pt-1', 'pb-6');

      chevron.style.transform = 'rotate(0deg)';

      // Tunggu transisi, lalu `hidden` agar benar-benar hilang
      dropdownMenu.addEventListener('transitionend', function handler() {
        if (dropdownMenu.classList.contains('max-h-0')) {
          dropdownMenu.classList.add('hidden');
          dropdownMenu.classList.remove('block');
        }
        dropdownMenu.removeEventListener('transitionend', handler);
      });
    }
  });

  function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const isCollapsed = sidebar.classList.toggle('collapsed');

    if (isCollapsed) {
      // Kalau sidebar ditutup, pastikan dropdown tertutup juga
      toggleBtn.setAttribute('aria-expanded', 'false');
      dropdownMenu.classList.add('max-h-0', 'opacity-0', 'pt-0', 'pb-0');
      dropdownMenu.classList.remove('max-h-60', 'opacity-100', 'pt-1', 'pb-6');
      chevron.style.transform = 'rotate(0deg)';

      dropdownMenu.addEventListener('transitionend', function handler() {
        if (dropdownMenu.classList.contains('max-h-0')) {
          dropdownMenu.classList.add('hidden');
          dropdownMenu.classList.remove('block');
        }
        dropdownMenu.removeEventListener('transitionend', handler);
      });
    }
  }
</script>


  <script src="{{asset('assets/js/layout/script.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @yield('js')
 </body>
</html>
