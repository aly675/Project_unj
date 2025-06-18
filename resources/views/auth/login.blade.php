<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Page</title>
  <!-- Tailwind CSS -->
   <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
  <style>
    .font-poppins {
      font-family: 'Poppins', sans-serif;
    }
        /* Custom floating label styles */
        .floating-input {
            position: relative;
        }

        .floating-input input {
            font-size: 0.9rem
        }

        .floating-input label {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            transition: all 0.3s ease;
            pointer-events: none;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.875rem;
        }

        .floating-input input:focus + label,
        .floating-input input.has-value + label {
            top: 0.5rem;
            transform: translateY(-110%);
            font-size: 1rem;
            color: #5eead4;
        }

        /* Loading spinner */
        .spinner {
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top: 2px solid white;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Backdrop blur fallback */
        .backdrop-blur-fallback {
            background: rgba(17, 24, 39, 0.8);
        }

        @supports (backdrop-filter: blur(12px)) {
            .backdrop-blur-fallback {
                backdrop-filter: blur(12px);
                background: rgba(17, 24, 39, 0.6);
            }
        }
  </style>
</head>
<body class="m-0 p-0 font-poppins bg-cover bg-center h-screen relative" style="background-image: url({{asset('assets/images/baground.png')}});">
 <div class="absolute top-0 left-0 w-full h-full bg-green-500 bg-opacity-10 z-10"></div>
  <div class="flex justify-center items-center h-full">
    <div class="bg-gray-800 bg-opacity-50 backdrop-blur-lg rounded-xl p-8 max-w-sm w-full z-20 text-white text-center shadow-xl">
      <img src="{{asset('assets/images/logo_unj.svg')}}" class="w-36 mx-auto mb-5" alt="Logo Universitas">
      <h5 class="mb-5 text-white font-bold text-lg">MENCERDASKAN DAN MEMARTABATKAN BANGSA</h5>

      <form action="{{route('login.submit')}}"  id="loginForm"  method="post" class="space-y-6">
        @csrf

        <!-- Email Field -->
        <div class="floating-input">
            <input type="email" name="email" id="email" value="{{old('email')}}"
                class="w-full h-10 px-4 bg-white bg-opacity-10 border border-white border-opacity-20 rounded-sm text-white placeholder-transparent focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-300"
                placeholder="Email" required />
            <label for="email">Email</label>
        </div>

        <!-- Password Field -->
        <div class="floating-input">
            <input type="password" name="password" id="password"
                class="w-full h-10 px-4 pr-12 bg-white bg-opacity-10 border border-white border-opacity-20 rounded-sm text-white placeholder-transparent focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-300"
                placeholder="Password" required />
            <label for="password">Password</label>
             <button
                    type="button"
                    id="togglePassword"
                    class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white text-opacity-70 hover:text-white transition-colors focus:outline-none"
                >
                <i data-lucide="eye" class="w-5 h-5"></i>
            </button>
        </div>

        <button type="submit"
                class="w-full font-poppins font-semibold bg-teal-700 hover:bg-teal-800 text-white px-4 rounded-lg py-3 transition duration-300">
          Login
        </button>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
       lucide.createIcons();

          // DOM elements
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const togglePasswordBtn = document.getElementById('togglePassword');
        const loginForm = document.getElementById('loginForm');
        const loginBtn = document.getElementById('loginBtn');
        const btnText = document.getElementById('btnText');
        const btnSpinner = document.getElementById('btnSpinner');


        // Floating label functionality
        function handleFloatingLabel(input) {
            const updateLabel = () => {
                if (input.value.trim() !== '' || input === document.activeElement) {
                    input.classList.add('has-value');
                } else {
                    input.classList.remove('has-value');
                }
            };

            input.addEventListener('input', updateLabel);
            input.addEventListener('focus', updateLabel);
            input.addEventListener('blur', updateLabel);

            // Check initial value
            updateLabel();
        }

        // Initialize floating labels
        handleFloatingLabel(emailInput);
        handleFloatingLabel(passwordInput);

        // Toggle password visibility
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
            setTimeout(function(){
                Swal.fire({
                    icon: 'error',
                    title: 'Login Gagal',
                    text: '{{ session('error') }}',
                    showClass: { popup: 'animate__animated animate__zoomIn' },
                    hideClass: { popup: 'animate__animated animate__fadeOut' }
                });
            }, 150); // kasih delay 300ms setelah reload
        </script>
    @endif



</body>
</html>
