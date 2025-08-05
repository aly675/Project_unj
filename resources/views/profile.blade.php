<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profil - PUSTIKOM</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body class="bg-gray-100">

  <!-- Topbar -->
  <header class="flex flex-wrap items-center justify-between bg-white px-6 py-4 shadow">
    <div class="text-sm text-gray-600">Dashboard / <span class="text-black font-medium">Profil</span></div>
    <div class="flex items-center space-x-3 mt-2 sm:mt-0">
      <img src="https://randomuser.me/api/portraits/men/32.jpg" class="w-10 h-10 rounded-full object-cover" alt="User">
      <div class="text-sm text-right">
        <div class="font-semibold">Rahul Shaw</div>
        <div class="text-xs text-gray-500">Admin PUSTIKOM</div>
      </div>
    </div>
  </header>

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
            <img src="https://randomuser.me/api/portraits/men/32.jpg" class="w-40 h-40 rounded-full border-4 border-white shadow object-cover" alt="Foto Profil">
            <span class="absolute -top-2 -right-2 bg-green-200 text-green-700 text-xs px-2 py-1 rounded-full">Aktif</span>
          </div>
        </div>

        <!-- Form -->
        <div class="bg-gray-200 rounded-lg p-6 w-full lg:w-2/3">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="text-xs text-gray-600 block mb-1">Nama Lengkap:</label>
              <input type="text" class="w-full p-2 rounded border border-gray-300 text-sm" placeholder="Nama Lengkap">
            </div>
            <div>
              <label class="text-xs text-gray-600 block mb-1">Username:</label>
              <input type="text" class="w-full p-2 rounded border border-gray-300 text-sm" placeholder="Username">
            </div>
            <div>
              <label class="text-xs text-gray-600 block mb-1">Email:</label>
              <input type="email" class="w-full p-2 rounded border border-gray-300 text-sm" placeholder="Email">
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

</body>
</html>
