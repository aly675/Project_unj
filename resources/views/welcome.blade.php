<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PUSTIKOM UNJ - Informasi Ruangan</title>
    <link rel="icon" href="{{asset('assets/images/landing-page/logo-unj-browser.png')}}" type="image/png" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
      html {
        scroll-behavior: smooth;
      }
      body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #f0fdf4 0%, #f0fdf4 50%, #ecfdf5 50%, #ecfdf5 100%);
      }
      .hero-bg {
        background: linear-gradient(rgba(0, 101, 105, 0.5), rgba(0, 101, 105, 0.5)), url("{{ asset('assets/images/landing-page/bg-pustikom.jpg') }}");
        background-size: cover;
        background-position: center;
      }
      .room-card {
        transition: all 0.3s ease;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.03);
        background: white;
        display: flex;
        flex-direction: column;
      }
      .room-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
      }
      .stat-card {
        transition: all 0.3s ease;
        border-radius: 16px;
        background: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
      }
      .stat-card:hover {
        transform: translateY(-3px);
      }
      .section-title {
        position: relative;
        display: inline-block;
        padding-bottom: 10px;
        margin-bottom: 30px;
      }
      .section-title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 4px;
        background: #006569;
        border-radius: 2px;
      }
      .facility-tag {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        background-color: #d0ebeb;
        color: #006569;
        font-size: 0.875rem;
        gap: 0.25rem;
      }
      .status-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        padding: 6px 14px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
        z-index: 10;
      }
      .navbar {
        -webkit-backdrop-filter: blur(10px);
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.9);
      }
      .room-image {
        height: 220px;
        object-fit: cover;
        width: 100%;
        transition: transform 0.3s ease;
      }
      .room-card:hover .room-image {
        transform: scale(1.03);
      }
    </style>
  </head>
  <body class="text-gray-800 scroll-smooth overflow-x-hidden">
    <!-- HEADER -->
    <header class="navbar shadow-sm sticky top-0 z-50">
      <div class="container max-w-screen-xl mx-auto flex justify-between items-center py-4 px-4 md:px-6">
        <div class="flex items-center">
          <img src="{{ asset('assets/images/landing-page/logo-unj.png') }}" alt="Logo UNJ" class="h-12 object-contain mr-4" />
          <div>
            <h1 class="text-xl font-bold text-[#006569]">PUSTIKOM</h1>
            <p class="text-sm font-medium text-[#006569]">UNIVERSITAS NEGERI JAKARTA</p>
          </div>
        </div>
        <nav class="hidden md:flex space-x-6 text-sm items-center">
          <a href="#beranda" class="hover:text-[#006569] font-medium hover:border-b-2 hover:border-[#006569] pb-1"><i class="fas fa-home mr-1"></i> Beranda</a>
          <a href="#tentang" class="hover:text-[#006569] font-medium hover;border-b-2 hover:border-[#006569] pb-1"><i class="fas fa-info-circle mr-1"></i> Tentang</a>
          <a href="#ruangan" class="hover:text-[#006569] font-medium hover;border-b-2 hover;border-[#006569] pb-1"><i class="fas fa-door-open mr-1"></i> Ruangan</a>
          <a href="#kontak" class="hover:text-[#006569] font-medium hover;border-b-2 hover;border-[#006569] pb-1"><i class="fas fa-phone-alt mr-1"></i> Kontak</a>
        </nav>
        <!-- Tombol Toggle -->
        <div class="flex md:hidden">
        <button id="menu-toggle" class="text-[#006569] fixed top-5 right-4 z-50">
          <!-- Ikon Hamburger -->
          <svg id="hamburger-icon" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <!-- Ikon Silang -->
          <svg id="close-icon" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <!-- Mobile Nav -->
      <nav id="mobile-nav" class="opacity-0 pointer-events-none transition-all duration-150 transform scale-95 absolute top-16 right-4 w-56 bg-white shadow-2xl border border-gray-200 text-[#0f172a] flex flex-col space-y-4 text-base px-6 py-6 rounded-lg z-40">
        <a href="#beranda" class="block hover:underline">Beranda</a>
        <a href="#tentang" class="block hover:underline">Tentang</a>
        <a href="#ruangan" class="block hover:underline">Ruangan</a>
        <a href="#kontak" class="block hover:underline">Kontak</a>
      </nav>
    </header>

    <!-- HERO -->
    <section id="beranda" class="hero-bg text-white min-h-screen md:min-h-[500px] xl:min-h-screen flex flex-col items-center justify-center text-center px-4 py-12 xl:py-0 scroll-mt-20">
      <h2 class="text-5xl md:text-5xl xl:text-7xl font-extrabold mb-2 tracking-widest">PUSTIKOM</h2>
      <p class="text-base md:text-base xl:text-lg uppercase tracking-wide mb-2 font-medium">
        PUSAT TEKNOLOGI INFORMASI DAN KOMUNIKASI <br />
        UNIVERSITAS NEGERI JAKARTA
      </p>
      <p class="max-w-4xl text-sm md:text-sm xl:text-base mb-8">
        PUSTIKOM menyediakan berbagai ruangan modern yang dapat digunakan untuk kegiatan akademik, penelitian, pelatihan, dan pertemuan, lengkap dengan fasilitas pendukung terbaik di lingkungan kampus.
      </p>
      <div class="inline-flex flex-wrap justify-center gap-4">
        <a href="#ruangan" class="bg-white text-[#006569] font-semibold px-6 py-3 md:px-8 md:py-4 rounded-md hover:bg-gray-100 transition duration-300 shadow-lg"><i class="fas fa-door-open mr-2"></i> Lihat Ruangan</a>
        <a href="https://maps.app.goo.gl/QS2rr2FMBNVdbt5YA" target="_blank" class="bg-transparent border border-white text-white font-semibold px-6 py-3 md:px-8 md:py-4 rounded-md hover:bg-white hover:text-[#006569] transition duration-300"></i> Lokasi Kami</a>
      </div>
    </section>

    <!-- TENTANG KAMI -->
    <section id="tentang" class="w-full max-w-screen-xl mx-auto px-4 md:px-6 py-16 scroll-mt-20">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
        <div class="w-full aspect-video">
          <iframe class="w-full h-full" src="https://www.youtube.com/embed/8bgm6eXvHFo?autoplay=1&mute=1&loop=1&playlist=8bgm6eXvHFo" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="text-left">
          <h3 class="text-[#006569] font-medium mb-2">Tentang Kami</h3>
          <h2 class="text-3xl font-bold text-[#006569] mb-4">PUSAT TEKNOLOGI INFORMASI DAN KOMUNIKASI</h2>
          <p class="text-gray-600 mb-4">
            PUSTIKOM UNJ menyediakan layanan Teknologi Informasi dan Komunikasi di Universitas Negeri Jakarta. Kami terus mengikuti perkembangan teknologi dan memperbarui infrastruktur untuk mendukung kegiatan akademik, administratif, dan layanan peminjaman ruangan yang nyaman dan modern, serta memastikan semua kebutuhan teknologi kampus berjalan lancar dan efisien.
          </p>
          <!-- Tombol Hubungi Kami -->
          <a href="tel:+621234567890" class="inline-flex items-center bg-[#006569] text-white px-5 py-3 rounded-full hover:bg-[#004f52] transition-colors">
          <!-- Icon Telepon Heroicons Solid -->
           <span class="h-4 w-4 mr-2.5 mb-1.5">
             <i class="fa-solid fa-phone"></i>
           </span>
          Hubungi Kami
        </a>

        </div>
      </div>
    </section>

    <!-- RINGKASAN FASILITAS -->
    <section class="w-full max-w-screen-xl mx-auto px-4 md:px-6 py-16">
      <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-3">Fasilitas Kami</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">Pustikom UNJ menyediakan berbagai ruangan modern dengan fasilitas lengkap untuk kegiatan akademik</p>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        <div class="stat-card bg-white p-6 text-center border-t-4 border-[#006569]">
          <div class="bg-[#E0F2F1] w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4"><i class="fas fa-door-open text-[#006569] text-2xl"></i></div>
          <h3 class="text-3xl font-bold text-[#006569] mb-2">-</h3>
          <p class="text-gray-600 font-medium">Total Ruangan</p>
        </div>
        <div class="stat-card bg-white p-6 text-center border-t-4 border-[#006569]">
          <div class="bg-[#E0F2F1] w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4"><i class="fas fa-cogs text-[#006569] text-2xl"></i></div>
          <h3 class="text-3xl font-bold text-[#006569] mb-2">-</h3>
          <p class="text-gray-600 font-medium">Fasilitas Total</p>
        </div>
        <div class="stat-card bg-white p-6 text-center border-t-4 border-[#006569]">
          <div class="bg-[#E0F2F1] w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4"><i class="fas fa-desktop text-[#006569] text-2xl"></i></div>
          <h3 class="text-3xl font-bold text-[#006569] mb-2">-</h3>
          <p class="text-gray-600 font-medium">Komputer</p>
        </div>
        <div class="stat-card bg-white p-6 text-center border-t-4 border-[#006569]">
          <div class="bg-[#E0F2F1] w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4"><i class="fas fa-users text-[#006569] text-2xl"></i></div>
          <h3 class="text-3xl font-bold text-[#006569] mb-2">-</h3>
          <p class="text-gray-600 font-medium">Kapasitas Total</p>
        </div>
      </div>
    </section>

    <!-- DAFTAR RUANGAN -->
    <section id="ruangan" class="container max-w-screen-xl mx-auto px-4 md:px-6 pb-16 scroll-mt-24">
      <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-3">Daftar Ruangan</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">Temukan ruangan yang sesuai kebutuhan kegiatan akademik Anda</p>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-6">
          <!-- Ruang 1 -->
          <div class="room-card flex flex-col h-full bg-white rounded-lg shadow-md overflow-hidden">
            <div class="relative overflow-hidden">
              <img src="https://images.unsplash.com/photo-1497366754035-f200968a6e72?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Lab Komputer 1" class="room-image w-full" />
              <span class="status-badge bg-[#d0ebeb] text-[#006569]"> <i class="fas fa-check-circle mr-1"></i> Tersedia </span>
            </div>
            <div class="p-6 flex-grow">
              <div class="flex justify-between items-start mb-3">
                <div>
                  <h4 class="text-xl font-bold text-gray-800 mb-1">Lab Komputer 1</h4>
                  <div class="flex items-center text-sm text-gray-500 mb-2"><i class="fas fa-map-marker-alt mr-2 text-[#006569]"></i> Gedung A, Lantai 2</div>
                </div>
                <div class="bg-[#d0ebeb] text-[#006569] px-3 py-1 rounded-lg text-sm font-bold"><i class="fas fa-user-friends mr-1"></i> 30</div>
              </div>
              <p class="text-gray-600 mb-4">Ruangan dengan 30 unit komputer terbaru untuk praktikum dan pelatihan.</p>
              <div class="flex flex-wrap gap-2 mb-4">
                <span class="facility-tag"><i class="fas fa-desktop"></i> 30 PC</span>
                <span class="facility-tag"><i class="fas fa-snowflake"></i> AC</span>
                <span class="facility-tag"><i class="fas fa-video"></i> Proyektor</span>
                <span class="facility-tag"><i class="fas fa-wifi"></i> WiFi</span>
              </div>
              <div class="mt-auto pt-3 border-t border-gray-100 text-sm text-gray-500"><i class="fas fa-clock mr-2 text-[#006569]"></i> Senin-Jumat: 08.00-21.00 | Sabtu: 09.00-17.00</div>
            </div>
          </div>

          <!-- Ruang 2 -->
          <div class="room-card flex flex-col h-full bg-white rounded-lg shadow-md overflow-hidden">
            <div class="relative overflow-hidden">
              <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Ruang Rapat" class="room-image" />
              <span class="status-badge bg-red-100 text-red-700"> <i class="fas fa-times-circle mr-1"></i> Terpakai </span>
            </div>
            <div class="p-6 flex-grow">
              <div class="flex justify-between items-start mb-3">
                <div>
                  <h4 class="text-xl font-bold text-gray-800 mb-1">Ruang Rapat</h4>
                  <div class="flex items-center text-sm text-gray-500 mb-2"><i class="fas fa-map-marker-alt mr-2 text-[#006569]"></i> Gedung B, Lantai 1</div>
                </div>
                <div class="bg-[#d0ebeb] text-[#006569] px-3 py-1 rounded-lg text-sm font-bold"><i class="fas fa-user-friends mr-1"></i> 20</div>
              </div>
              <p class="text-gray-600 mb-4">Ruang rapat eksekutif dengan fasilitas presentasi lengkap untuk pertemuan penting.</p>
              <div class="flex flex-wrap gap-2 mb-4">
                <span class="facility-tag"><i class="fas fa-tv"></i> LCD TV 65"</span>
                <span class="facility-tag"><i class="fas fa-microphone"></i> Sound System</span>
                <span class="facility-tag"><i class="fas fa-video"></i> Konferensi Video</span>
                <span class="facility-tag"><i class="fas fa-coffee"></i> Coffee Maker</span>
              </div>
              <div class="mt-auto pt-3 border-t border-gray-100 text-sm text-gray-500"><i class="fas fa-clock mr-2 text-[#006569]"></i> Senin-Jumat: 08.00-21.00 | Sabtu: 09.00-17.00</div>
            </div>
          </div>

          <!-- Ruang 3 -->
          <div class="room-card flex flex-col h-full bg-white rounded-lg shadow-md overflow-hidden">
            <div class="relative overflow-hidden">
              <img src="https://images.unsplash.com/photo-1497366811353-6870744d04b2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Auditorium" class="room-image" />
              <span class="status-badge bg-[#d0ebeb] text-[#006569]"> <i class="fas fa-check-circle mr-1"></i> Tersedia </span>
            </div>
            <div class="p-6 flex-grow">
              <div class="flex justify-between items-start mb-3">
                <div>
                  <h4 class="text-xl font-bold text-gray-800 mb-1">Auditorium</h4>
                  <div class="flex items-center text-sm text-gray-500 mb-2"><i class="fas fa-map-marker-alt mr-2 text-[#006569]"></i> Gedung Utama, Lantai 3</div>
                </div>
                <div class="bg-[#d0ebeb] text-[#006569] px-3 py-1 rounded-lg text-sm font-bold"><i class="fas fa-user-friends mr-1"></i> 100</div>
              </div>
              <p class="text-gray-600 mb-4">Auditorium modern dengan kapasitas besar untuk seminar, workshop, dan acara kampus.</p>
              <div class="flex flex-wrap gap-2 mb-4">
                <span class="facility-tag"><i class="fas fa-microphone-alt"></i> Sound System</span>
                <span class="facility-tag"><i class="fas fa-projector"></i> Proyektor HD</span>
                <span class="facility-tag"><i class="fas fa-couch"></i> Panggung</span>
                <span class="facility-tag"><i class="fas fa-snowflake"></i> AC Sentral</span>
              </div>
              <div class="mt-auto pt-3 border-t border-gray-100 text-sm text-gray-500"><i class="fas fa-clock mr-2 text-[#006569]"></i> Senin-Jumat: 08.00-21.00 | Sabtu: 09.00-17.00</div>
            </div>
          </div>

          <!-- Ruang 4 -->
          <div class="room-card flex flex-col h-full bg-white rounded-lg shadow-md overflow-hidden">
            <div class="relative overflow-hidden">
              <img src="https://images.unsplash.com/photo-1522542550221-31fd19575a2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Lab Komputer 2" class="room-image" />
              <span class="status-badge bg-[#d0ebeb] text-[#006569]"> <i class="fas fa-check-circle mr-1"></i> Tersedia </span>
            </div>
            <div class="p-6 flex-grow">
              <div class="flex justify-between items-start mb-3">
                <div>
                  <h4 class="text-xl font-bold text-gray-800 mb-1">Lab Komputer 2</h4>
                  <div class="flex items-center text-sm text-gray-500 mb-2"><i class="fas fa-map-marker-alt mr-2 text-[#006569]"></i> Gedung A, Lantai 2</div>
                </div>
                <div class="bg-[#d0ebeb] text-[#006569] px-3 py-1 rounded-lg text-sm font-bold"><i class="fas fa-user-friends mr-1"></i> 25</div>
              </div>
              <p class="text-gray-600 mb-4">Ruangan dengan spesifikasi tinggi untuk pemrograman dan desain grafis.</p>
              <div class="flex flex-wrap gap-2 mb-4">
                <span class="facility-tag"><i class="fas fa-desktop"></i> 25 PC</span>
                <span class="facility-tag"><i class="fas fa-microchip"></i> i7/16GB RAM</span>
                <span class="facility-tag"><i class="fas fa-projector"></i> Proyektor</span>
                <span class="facility-tag"><i class="fas fa-print"></i> Printer</span>
              </div>
              <div class="mt-auto pt-3 border-t border-gray-100 text-sm text-gray-500"><i class="fas fa-clock mr-2 text-[#006569]"></i> Senin-Jumat: 08.00-21.00 | Sabtu: 09.00-17.00</div>
            </div>
          </div>

          <!-- Ruang 5 -->
          <div class="room-card flex flex-col h-full bg-white rounded-lg shadow-md overflow-hidden">
            <div class="relative overflow-hidden">
              <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Studio Multimedia" class="room-image" />
              <span class="status-badge bg-yellow-100 text-yellow-700"> <i class="fas fa-tools mr-1"></i> Perawatan </span>
            </div>
            <div class="p-6 flex-grow">
              <div class="flex justify-between items-start mb-3">
                <div>
                  <h4 class="text-xl font-bold text-gray-800 mb-1">Studio Multimedia</h4>
                  <div class="flex items-center text-sm text-gray-500 mb-2"><i class="fas fa-map-marker-alt mr-2 text-[#006569]"></i> Gedung C, Lantai 1</div>
                </div>
                <div class="bg-[#d0ebeb] text-[#006569] px-3 py-1 rounded-lg text-sm font-bold"><i class="fas fa-user-friends mr-1"></i> 10</div>
              </div>
              <p class="text-gray-600 mb-4">Studio lengkap untuk produksi konten video, audio, dan fotografi.</p>
              <div class="flex flex-wrap gap-2 mb-4">
                <span class="facility-tag"><i class="fas fa-video"></i> Kamera Profesional</span>
                <span class="facility-tag"><i class="fas fa-lightbulb"></i> Lighting Setup</span>
                <span class="facility-tag"><i class="fas fa-headphones"></i> Ruang Audio</span>
                <span class="facility-tag"><i class="fas fa-laptop"></i> Editing Station</span>
              </div>
              <div class="mt-auto pt-3 border-t border-gray-100 text-sm text-gray-500"><i class="fas fa-clock mr-2 text-[#006569]"></i> Khusus dengan perjanjian</div>
            </div>
          </div>

          <!-- Ruang 6 -->
          <div class="room-card flex flex-col h-full bg-white rounded-lg shadow-md overflow-hidden">
            <div class="relative overflow-hidden">
              <img src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Ruang Kelas Digital" class="room-image" />
              <span class="status-badge bg-[#d0ebeb] text-[#006569]"> <i class="fas fa-check-circle mr-1"></i> Tersedia </span>
            </div>
            <div class="p-6 flex-grow">
              <div class="flex justify-between items-start mb-3">
                <div>
                  <h4 class="text-xl font-bold text-gray-800 mb-1">Ruang Kelas Digital</h4>
                  <div class="flex items-center text-sm text-gray-500 mb-2"><i class="fas fa-map-marker-alt mr-2 text-[#006569]"></i> Gedung A, Lantai 1</div>
                </div>
                <div class="bg-[#d0ebeb] text-[#006569] px-3 py-1 rounded-lg text-sm font-bold"><i class="fas fa-user-friends mr-1"></i> 40</div>
              </div>
              <p class="text-gray-600 mb-4">Ruang kelas modern dengan teknologi pembelajaran terintegrasi.</p>
              <div class="flex flex-wrap gap-2 mb-4">
                <span class="facility-tag"><i class="fas fa-tv"></i> Smartboard</span>
                <span class="facility-tag"><i class="fas fa-projector"></i> Proyektor</span>
                <span class="facility-tag"><i class="fas fa-wifi"></i> WiFi</span>
                <span class="facility-tag"><i class="fas fa-video"></i> Sistem Recording</span>
              </div>
              <div class="mt-auto pt-3 border-t border-gray-100 text-sm text-gray-500"><i class="fas fa-clock mr-2 text-[#006569]"></i> Senin-Jumat: 08.00-21.00 | Sabtu: 09.00-17.00</div>
            </div>
          </div>
        </div>
      <div class="text-center mt-12">
        <button class="bg-[#006569] text-white font-semibold px-8 py-3 rounded-lg hover:bg-[#004f50] transition duration-300 inline-flex items-center"><i class="fas fa-list mr-2"></i>Tampilkan Semua Ruangan</button>
      </div>
    </section>

    <!-- FASILITAS -->
    <section class="bg-white py-16">
      <div class="container max-w-screen-xl mx-auto px-6">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-gray-800 mb-3">Fasilitas Pendukung</h2>
          <p class="text-gray-600 max-w-2xl mx-auto">Pustikom UNJ dilengkapi berbagai fasilitas pendukung agar aktivitas berjalan lancar</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-8">
          <div class="bg-[#d0ebeb] rounded-xl p-6 flex items-start">
            <div class="bg-[#006569] text-white p-3 rounded-lg mr-4">
              <i class="fas fa-wifi text-xl"></i>
            </div>
            <div>
              <h4 class="text-lg font-bold text-gray-800 mb-2">Tim Keamanan</h4>
              <p class="text-gray-600">Petugas keamanan standby 24 jam di area Pustikom UNJ</p>
            </div>
          </div>

          <div class="bg-[#d0ebeb] rounded-xl p-6 flex items-start">
            <div class="bg-[#006569] text-white p-3 rounded-lg mr-4">
              <i class="fas fa-print text-xl"></i>
            </div>
            <div>
              <h4 class="text-lg font-bold text-gray-800 mb-2">Layanan Cetak</h4>
              <p class="text-gray-600">Layanan pencetakan dokumen dengan kualitas tinggi</p>
            </div>
          </div>

          <div class="bg-[#d0ebeb] rounded-xl p-6 flex items-start">
            <div class="bg-[#006569] text-white p-3 rounded-lg mr-4">
              <i class="fas fa-headset text-xl"></i>
            </div>
            <div>
              <h4 class="text-lg font-bold text-gray-800 mb-2">Dukungan Teknis</h4>
              <p class="text-gray-600">Tim teknis siap membantu selama jam operasional</p>
            </div>
          </div>

          <div class="bg-[#d0ebeb] rounded-xl p-6 flex items-start">
            <div class="bg-[#006569] text-white p-3 rounded-lg mr-4">
              <i class="fas fa-book text-xl"></i>
            </div>
            <div>
              <h4 class="text-lg font-bold text-gray-800 mb-2">Perpustakaan Digital</h4>
              <p class="text-gray-600">Akses ke ribuan jurnal dan buku digital</p>
            </div>
          </div>

          <div class="bg-[#d0ebeb] rounded-xl p-6 flex items-start">
            <div class="bg-[#006569] text-white p-3 rounded-lg mr-4">
              <i class="fas fa-coffee text-xl"></i>
            </div>
            <div>
              <h4 class="text-lg font-bold text-gray-800 mb-2">Area Istirahat</h4>
              <p class="text-gray-600">Ruang tunggu dan kafe dengan minuman gratis</p>
            </div>
          </div>

          <div class="bg-[#d0ebeb] rounded-xl p-6 flex items-start">
            <div class="bg-[#006569] text-white p-3 rounded-lg mr-4">
              <i class="fas fa-shield-alt text-xl"></i>
            </div>
            <div>
              <h4 class="text-lg font-bold text-gray-800 mb-2">Keamanan</h4>
              <p class="text-gray-600">Sistem keamanan 24 jam dan CCTV di seluruh area</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-[#006569] text-white pt-12">
      <div class="container max-w-screen-xl mx-auto px-4 md:px-6 pb-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-4 gap-8">
          <div>
            <img src="{{asset('assets/images/landing-page/logo-unj.png')}}" alt="Logo UNJ" class="w-auto max-w-[100px] h-25" />
            <h2 class="text-xl font-bold">PUSTIKOM</h2>
            <p class="uppercase text-sm tracking-wider">UNIVERSITAS NEGERI JAKARTA</p>
          </div>
          <div>
            <h4 class="text-lg font-semibold mb-4">Jam Operasional</h4>
            <ul class="space-y-2 text-gray-200">
              <li class="flex justify-between"><span>Senin - Jumat</span><span>08:00 - 16:00</span></li>
              <li class="flex justify-between"><span>Sabtu & Minggu</span><span class="text-red-400">Tutup</span></li>
            </ul>
          </div>
          <div>
            <h4 class="text-lg font-semibold mb-4">Kontak Kami</h4>
            <ul class="space-y-3 text-gray-200">
              <li class="flex items-center"><i class="fas fa-envelope mr-3 text-yellow-400"></i><span>pustikom@unj.ac.id</span></li>
              <li class="flex items-start"><i class="fas fa-map-marker-alt mt-1 mr-3 text-yellow-400"></i><span>Gd. Pustikom Lt.2 Kampus A, Rawamangun Muka, Jakarta Timur</span></li>
            </ul>
          </div>
          <div>
            <h4 class="text-lg font-semibold mb-4">Peta Lokasi</h4>
            <div class="w-full h-48 rounded-xl overflow-hidden border-2 border-dashed"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126931.52733035664!2d106.7294546390625!3d-6.182890070062429!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f53d8fffd327%3A0xae4a18357e4644ff!2sPustikom!5e0!3m2!1sid!2sid!4v1751874737207!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="w-full h-full"></iframe></div>
          </div>
        </div>
      </div>
      <div class="bg-yellow-400 text-[#006569] text-center py-4">&copy; 2025 PUSTIKOM UNJ</div>
    </footer>

    <script>
      // Intersection Observer for nav highlight
      document.addEventListener('DOMContentLoaded', function () {
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('nav a');
        const observer = new IntersectionObserver(
          (entries) => {
            entries.forEach((entry) => {
              const id = entry.target.getAttribute('id');
              const navLink = document.querySelector(`nav a[href="#${id}"]`);
              if (entry.isIntersecting) {
                navLinks.forEach((link) => link.classList.remove('text-[#006569]', 'border-b-2', 'border-[#006569]'));
                navLink.classList.add('text-[#006569]', 'border-b-2', 'border-[#006569]');
              }
            });
          },
          { root: null, rootMargin: '-50% 0px -50% 0px', threshold: 0 }
        );
        sections.forEach((section) => observer.observe(section));
      });

      // Mobile menu toggle dengan animasi + hamburger ↔ silang
      const toggle = document.getElementById('menu-toggle');
      const mobileNav = document.getElementById('mobile-nav');
      const hamburgerIcon = document.getElementById('hamburger-icon');
      const closeIcon = document.getElementById('close-icon');

      toggle.addEventListener('click', () => {
        const isOpen = mobileNav.classList.contains('opacity-100');

        if (isOpen) {
          closeMenu();
        } else {
          openMenu();
        }
      });

      // Fungsi buka nav
      function openMenu() {
        mobileNav.classList.add('opacity-100', 'pointer-events-auto', 'scale-100');
        mobileNav.classList.remove('opacity-0', 'pointer-events-none', 'scale-95');
        hamburgerIcon.classList.add('hidden');
        closeIcon.classList.remove('hidden');
      }

      // Fungsi tutup nav
      function closeMenu() {
        mobileNav.classList.remove('opacity-100', 'pointer-events-auto', 'scale-100');
        mobileNav.classList.add('opacity-0', 'pointer-events-none', 'scale-95');
        hamburgerIcon.classList.remove('hidden');
        closeIcon.classList.add('hidden');
      }

      // Tutup nav jika link di klik
      document.querySelectorAll('#mobile-nav a').forEach((link) => {
        link.addEventListener('click', closeMenu);
      });

      // Tutup nav otomatis saat scroll
      window.addEventListener('scroll', () => {
        const isOpen = mobileNav.classList.contains('opacity-100');
        if (isOpen) {
          closeMenu();
        }
      });

      // Tutup nav jika klik di luar nav & tombol toggle
      window.addEventListener('click', (event) => {
        const isOpen = mobileNav.classList.contains('opacity-100');
        const isClickInsideNav = mobileNav.contains(event.target);
        const isClickToggle = toggle.contains(event.target);

        if (isOpen && !isClickInsideNav && !isClickToggle) {
          closeMenu();
        }
      });
    </script>
  </body>
</html>
