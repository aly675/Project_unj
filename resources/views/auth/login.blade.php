<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login UNJ</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
      body {
        font-family: 'Poppins', sans-serif;
      }
    </style>
  </head>
  <body
    class="bg-cover bg-center h-screen flex items-center justify-center"
    style="background-image: url('{{ asset('assets/images/baground.png') }}')"
  >
    <!-- Kotak Blur -->
    <div class="bg-white/30 backdrop-blur-xl p-8 w-full max-w-sm shadow-2xl rounded-2xl">
      <!-- Logo Besar -->
      <img src="{{ asset('assets/images/final-logo-terbaru.png') }}" alt="Logo UNJ" class="w-65 mx-auto mb-6" />

      <!-- Form -->
      <form action="{{ route('login.submit') }}" method="POST" id="loginForm" class="space-y-8 relative">
        @csrf

        <!-- Email -->
        <div class="relative z-0 w-full group">
          <input
            type="email"
            name="email"
            id="email"
            value="{{ old('email') }}"
            class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-white/50 appearance-none focus:outline-none focus:ring-0 focus:border-[#006569] peer"
            placeholder=" "
            required
          />
          <label
            for="email"
            class="absolute text-sm text-white/70 duration-300 transform -translate-y-6 scale-100 top-3 -z-10 origin-[0] peer-focus:text-[#006569] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-100 peer-focus:-translate-y-6"
            >Email</label
          >
        </div>

        <!-- Password -->
        <div class="relative z-0 w-full group">
          <input
            type="password"
            name="password"
            id="password"
            class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-white/50 appearance-none focus:outline-none focus:ring-0 focus:border-[#006569] peer pr-10"
            placeholder=" "
            required
          />
          <label
            for="password"
            class="absolute text-sm text-white/70 duration-300 transform -translate-y-6 scale-100 top-3 -z-10 origin-[0] peer-focus:text-[#006569] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-100 peer-focus:-translate-y-6"
            >Password</label
          >
          <button
            type="button"
            id="togglePassword"
            class="absolute right-0 top-1/2 transform -translate-y-1/2 text-white/70 hover:text-white transition-colors focus:outline-none"
          >
            <i data-lucide="eye" class="w-5 h-5"></i>
          </button>
        </div>

        <!-- Tombol Login -->
        <button
          type="submit"
          class="w-full h-12 bg-[#006569] text-white text-sm font-semibold rounded-full transition duration-300 hover:bg-[#004f52] hover:-translate-y-0.5 hover:shadow-lg"
        >
          Login
        </button>
      </form>
    </div>

    <script>
      lucide.createIcons();

      const passwordInput = document.getElementById('password');
      const togglePasswordBtn = document.getElementById('togglePassword');

      let passwordVisible = false;
      togglePasswordBtn.addEventListener('click', () => {
        passwordVisible = !passwordVisible;
        passwordInput.type = passwordVisible ? 'text' : 'password';
        const icon = togglePasswordBtn.querySelector('i');
        icon.setAttribute('data-lucide', passwordVisible ? 'eye-off' : 'eye');
        lucide.createIcons();
      });
    </script>

    @if(session('error'))
  <script>
    setTimeout(() => {
      Swal.fire({
        toast: true,
        position: 'bottom-end',
        icon: 'error',
        title: 'Login Gagal',
        text: '{{ session('error') }}',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        showClass: {
          popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
          popup: 'animate__animated animate__fadeOutUp'
        }
      });
    }, 200);
  </script>
@endif


  </body>
</html>
