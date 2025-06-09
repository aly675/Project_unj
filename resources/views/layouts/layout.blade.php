<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Admin | @yield('title')
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet"/>
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
      <div class="flex items-center gap-3 px-6 py-5 border-b border-teal-700">
        <img alt="logo unj" class="w-8 h-8" src="{{asset('assets/images/icon/logo-unj.svg')}}">
        <div id="sidebar-labels">
          <h1 class="text-white font-extrabold text-sm uppercase leading-none">PUSTIKOM</h1>
          <p class="text-teal-300 text-[10px] mt-1 leading-tight">UNIVERSITAS NEGERI JAKARTA</p>
        </div>
      </div>

    </aside>

  <!-- Main content -->
  <div class="flex-1 flex flex-col">
   <!-- Header -->
   <header class="flex justify-between items-center bg-white px-6 py-4 border-b border-gray-200">
    <div class="flex items-center gap-2 text-gray-400 text-sm font-normal">
     <img alt="" onclick="toggleSidebar()" class="fas text-base" src="{{asset('assets/images/icon/sidebar-icon.svg')}}">
    </div>


   <div class="relative">
  <!-- Profile Button -->
  <button id="profile-button" class="flex items-center gap-3 bg-white hover:bg-gray-100 p-3 rounded-lg shadow-sm transition-colors duration-200 focus:outline-none">
  <img alt="Profile picture" class="w-10 h-10 rounded-full object-cover" src="{{asset('assets/images/icon/none-profile-icon.svg')}}" />
  <div class="text-right">
    <p class="text-gray-900 font-semibold text-sm leading-tight">Rahul Shaw</p>
    <p class="text-gray-400 text-xs leading-tight">Admin PUSTIKOM</p>
  </div>
</button>


  <!-- Dropdown Menu -->
<div id="profile-dropdown" class="hidden absolute right-0 mt-2 w-36 bg-white rounded-xl shadow-md ring-1 ring-gray-200 py-1 z-50">
  <a href="/profile" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">
    <i class="fas fa-user text-gray-400 text-xs"></i> Profile
  </a>
  <form id="logout-form" method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="button" onclick="logoutConfirm()" class="flex items-center gap-2 w-full px-4 py-2 text-sm text-red-500 hover:bg-gray-50 transition">
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

  @yield('js')
  <script src="{{asset('assets/js/layout/script.js')}}"></script>
 </body>
</html>
