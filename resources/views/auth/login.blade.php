<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login UNJ</title>

    <link rel="icon" href="/assets/images/logo_unj.svg">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body { font-family: 'Poppins', sans-serif; }
        /* Style lainnya */
        .bg-cover { background-image: url('/assets/images/baground.png'); }
        input:-webkit-autofill { -webkit-box-shadow: 0 0 0px 1000px transparent inset; -webkit-text-fill-color: #fff; transition: background-color 5000s ease-in-out 0s; }
    </style>
</head>
<body class="bg-cover bg-center h-screen flex items-center justify-center">

    <div class="bg-white/30 backdrop-blur-xl p-8 w-full max-w-sm shadow-2xl rounded-2xl">
        <img src="/assets/images/final-logo-terbaru.png" alt="Logo UNJ" class="w-65 mx-auto mb-6" />

        <form id="loginForm" class="space-y-8 relative">
            <div class="relative z-0 w-full group">
                <input type="email" name="email" id="email" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-white/50 appearance-none focus:outline-none focus:ring-0 focus:border-[#006569] peer" placeholder=" " required />
                <label for="email" class="absolute text-sm text-white/70 duration-300 transform -translate-y-6 scale-100 top-3 -z-10 origin-[0] peer-focus:text-[#006569] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-100 peer-focus:-translate-y-6">Email</label>
            </div>

            <div class="relative z-0 w-full group">
                <input type="password" name="password" id="password" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-white/50 appearance-none focus:outline-none focus:ring-0 focus:border-[#006569] peer pr-10" placeholder=" " required />
                <label for="password" class="absolute text-sm text-white/70 duration-300 transform -translate-y-6 scale-100 top-3 -z-10 origin-[0] peer-focus:text-[#006569] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-100 peer-focus:-translate-y-6">Password</label>
                <button type="button" id="togglePassword" class="absolute right-0 top-1/2 transform -translate-y-1/2 text-white/70 hover:text-white transition-colors focus:outline-none">
                    <i data-lucide="eye" class="w-5 h-5"></i>
                </button>
            </div>

            <button type="submit" class="w-full h-12 bg-[#006569] text-white text-sm font-semibold rounded-full transition duration-300 hover:bg-[#004f52] hover:-translate-y-0.5 hover:shadow-lg">
                Login
            </button>
        </form>
    </div>

    <script>
        lucide.createIcons();

        const passwordInput = document.getElementById('password');
        const togglePasswordBtn = document.getElementById('togglePassword');
        const loginForm = document.getElementById('loginForm');

        // Toggle password visibility
        let passwordVisible = false;
        togglePasswordBtn.addEventListener('click', () => {
            passwordVisible = !passwordVisible;
            passwordInput.type = passwordVisible ? 'text' : 'password';
            const icon = togglePasswordBtn.querySelector('i');
            icon.setAttribute('data-lucide', passwordVisible ? 'eye-off' : 'eye');
            lucide.createIcons();
        });

        // Event listener untuk form submission
        loginForm.addEventListener('submit', async (e) => {
            e.preventDefault(); // Mencegah form memuat ulang halaman

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            // Pastikan URL API Anda sudah benar
            const apiUrl = 'http://127.0.0.1:8000/api/login';

            try {
                const response = await fetch(apiUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ email, password })
                });

                const data = await response.json();

                if (response.ok) {
                    // Login berhasil
                    Swal.fire({
                        toast: true,
                        position: 'bottom-end',
                        icon: 'success',
                        title: 'Login Berhasil',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 2000
                    });

                    // Simpan token dan data user ke localStorage
                    localStorage.setItem('sanctum_token', data.token);
                    localStorage.setItem('user_data', JSON.stringify(data.user));

                    // Arahkan ke halaman berdasarkan peran (role)
                    setTimeout(() => {
                        const userRole = data.user.role;
                        if (userRole === 'admin') {
                            window.location.href = '/admin';
                        } else if (userRole === 'superadmin') {
                            window.location.href = '/superadmin';
                        } else if (userRole === 'kepalaupt') {
                            window.location.href = '/kepala-upt';
                        } else if (userRole === 'supkorla') {
                            window.location.href = '/supkorla';
                        } else {
                            // Default redirect jika role tidak dikenali
                            window.location.href = '/dashboard';
                        }
                    }, 1000); // Tunggu SweetAlert selesai
                } else {
                    // Login gagal
                    Swal.fire({
                        toast: true,
                        position: 'bottom-end',
                        icon: 'error',
                        title: 'Login Gagal',
                        text: data.message || 'Email atau password salah.',
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            } catch (error) {
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    icon: 'error',
                    title: 'Koneksi Gagal',
                    text: 'Tidak dapat terhubung ke server. Coba lagi.',
                    showConfirmButton: false,
                    timer: 3000
                });
                console.error('Error:', error);
            }
        });
    </script>
</body>
</html>
