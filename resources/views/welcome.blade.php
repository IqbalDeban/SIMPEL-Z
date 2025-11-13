<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIMPEL-Z | Sistem Informasi Pelaporan Zoom</title>
  <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/4149/4149677.png" type="image/png">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body { font-family: 'Inter', sans-serif; }
    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-6px); }
    }
  </style>
</head>
<body class="relative min-h-screen bg-gradient-to-br from-white via-slate-50 to-indigo-100 flex flex-col md:flex-row justify-center items-center overflow-hidden">

  <!-- Efek latar -->
  <div class="absolute w-72 h-72 bg-indigo-200/30 rounded-full blur-3xl top-20 left-12"></div>
  <div class="absolute w-[400px] h-[400px] bg-blue-200/20 rounded-full blur-3xl bottom-10 right-10"></div>

  <!-- Header tetap di pojok kiri -->
  <header class="absolute top-5 left-5 flex items-center gap-2 sm:gap-3 bg-white/70 backdrop-blur-md px-3 py-2 rounded-full shadow-sm">
    <img src="https://cdn-icons-png.flaticon.com/512/4149/4149677.png" alt="Logo SIMPEL-Z"
         class="w-5 h-5 sm:w-6 sm:h-6 md:w-7 md:h-7">
    <span class="text-sm sm:text-base font-semibold text-gray-800 tracking-tight">SIMPEL-Z</span>
  </header>

  <!-- Versi mobile (aktif di bawah md) -->
  <main class="relative z-10 flex flex-col items-center text-center px-6 max-w-lg mx-auto mt-10 sm:mt-16 md:hidden">

    <!-- Ilustrasi -->
    <div class="relative mb-8 animate-[float_5s_ease-in-out_infinite]">
      <div class="absolute inset-0 bg-indigo-200/30 blur-2xl rounded-3xl -z-10"></div>
      <img src="https://cdn-icons-png.flaticon.com/512/4149/4149677.png"
           alt="Ilustrasi Dokumen Laporan"
           class="w-40 sm:w-52 drop-shadow-xl">
    </div>

    <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-800 mb-3 leading-snug">
      Laporan Zoom Jadi <span class="text-indigo-600">Lebih Teratur</span>
    </h1>

    <p class="text-sm sm:text-base text-gray-600 mb-8 max-w-md">
      <span class="font-semibold text-indigo-700">SIMPEL-Z</span> membantu Anda mencatat, mengelola, dan memantau laporan kegiatan Zoom secara modern, cepat, dan rapi.
    </p>

    <a href="#"
       class="px-6 sm:px-8 py-3 bg-indigo-600 text-white font-semibold rounded-full shadow-md hover:bg-indigo-700 hover:shadow-lg transition duration-300">
       Masuk Sekarang
    </a>
  </main>

  <!-- Versi desktop (aktif di md ke atas) -->
  <main class="hidden md:flex relative z-10 items-center justify-between px-16 w-full max-w-6xl">
    <div class="flex-1 pr-12">
      <h1 class="text-4xl xl:text-5xl font-extrabold text-gray-800 mb-4 leading-tight">
        Sistem Informasi Pelaporan <span class="text-indigo-600">Zoom Meeting</span>
      </h1>
      <p class="text-lg text-gray-600 mb-10 max-w-lg">
        <span class="font-semibold text-indigo-700">SIMPEL-Z</span> memudahkan Anda membuat laporan kegiatan Zoom dengan tampilan rapi, modern, dan otomatis.
      </p>
      <a href="#"
         class="px-8 py-3 bg-indigo-600 text-white font-semibold rounded-full shadow-md hover:bg-indigo-700 hover:shadow-lg transition duration-300">
         Masuk Sekarang
      </a>
    </div>

    <div class="flex-1 flex justify-center">
      <div class="relative animate-[float_6s_ease-in-out_infinite]">
        <div class="absolute inset-0 bg-indigo-200/30 blur-2xl rounded-3xl -z-10"></div>
        <img src="https://cdn-icons-png.flaticon.com/512/4149/4149677.png"
             alt="Ilustrasi Laporan"
             class="w-72 xl:w-96 drop-shadow-2xl">
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="absolute bottom-4 text-gray-500 text-xs sm:text-sm text-center w-full">
    © {{ date('Y') }} SIMPEL-Z
  </footer>

</body>
</html>