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
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    .font-poppins {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body class="m-0 p-0 font-poppins bg-cover bg-center h-screen relative" style="background-image: url({{asset('assets/images/baground.png')}});">
  <div class="absolute top-0 left-0 w-full h-full bg-green-500 bg-opacity-10 z-10"></div>
  <div class="flex justify-center items-center h-full">
    <div class="bg-gray-700 bg-opacity-40 backdrop-blur-md rounded-lg p-6 sm:p-8 max-w-sm w-full z-20 text-white text-center">
      <img src="{{asset('assets/images/logo_unj.svg')}}" class="w-36 mx-auto mb-5" alt="Logo Universitas">
      <h5 class="mb-3 text-white font-bold text-lg">MENCERDASKAN DAN MEMARTABATKAN BANGSA</h5>
      <form action="{{route('login.submit')}}" method="post">
        @csrf
        <div class="mb-4">
          <input type="email" name="email" class="form-input bg-white bg-opacity-20 text-white placeholder-white placeholder-opacity-70 rounded-lg h-10 w-full p-2 focus:outline-none focus:ring-0 focus:border-transparent text-sm" placeholder="Email">
        </div>
        <div class="mb-6">
          <input type="password" name="password" class="form-input bg-white bg-opacity-20 text-white placeholder-white placeholder-opacity-70 rounded-lg h-10 w-full p-2 focus:outline-none focus:ring-0 focus:border-transparent text-sm" placeholder="Password">
        </div>
        <button style="font-size: 0.9rem;" class="w-full font-poppins font-semibold bg-teal-800 text-white px-4 rounded-lg py-2">Login</button>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
