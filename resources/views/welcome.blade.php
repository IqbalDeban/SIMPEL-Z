<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIMPEL-Z | Sistem Informasi Pelaporan Zoom</title>
  <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/2921/2921222.png" type="image/png"> <!-- icon dokumen -->
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-8px); }
    }
  </style>
</head>
<body class="bg-gradient-to-br from-white via-slate-50 to-indigo-100 min-h-screen flex flex-col justify-center items-center overflow-hidden relative">

  <!-- Efek latar -->
  <div class="absolute w-80 h-80 bg-indigo-200/30 rounded-full blur-3xl top-20 left-10"></div>
  <div class="absolute w-[500px] h-[500px] bg-blue-200/20 rounded-full blur-3xl bottom-10 right-10"></div>

  <!-- Header -->
  <header class="absolute top-6 left-8 flex items-center gap-2">
    <img src="https://cdn-icons-png.flaticon.com/512/2921/2921222.png" alt="Dokumen Icon"
         class="w-7 h-7">
    <span class="text-lg font-semibold text-gray-700">SIMPEL-Z</span>
  </header>

  <!-- Konten Utama -->
  <main class="relative z-10 flex flex-col md:flex-row items-center justify-center gap-12 px-6 max-w-6xl">

    <!-- Kiri: Teks -->
    <div class="text-center md:text-left max-w-md">
      <h1 class="text-5xl font-extrabold text-gray-800 mb-4 leading-tight">
        Laporan Zoom Jadi <span class="text-indigo-600">Lebih Teratur</span>
      </h1>
      <p class="text-lg text-gray-600 mb-8">
        <span class="font-semibold text-indigo-700">SIMPEL-Z</span> membantu Anda mencatat, mengelola, dan memantau laporan kegiatan Zoom secara modern, cepat, dan rapi.
      </p>
      <a href="#"
         class="px-8 py-3 bg-indigo-600 text-white font-semibold rounded-full shadow-md hover:bg-indigo-700 transition duration-300">
         Masuk Sekarang
      </a>
    </div>

    <div class="relative animate-[float_5s_ease-in-out_infinite]">
    <div class="absolute inset-0 bg-indigo-200/30 blur-2xl rounded-3xl -z-10"></div>
    <!-- Ganti ilustrasi karakter dengan dokumen -->
    <img src="https://cdn-icons-png.flaticon.com/512/4149/4149677.png"
        alt="Ilustrasi Dokumen Laporan"
        class="w-80 md:w-96 drop-shadow-xl">
    </div>
  </main>

  <!-- Footer -->
  <footer class="absolute bottom-6 text-gray-500 text-sm">
    © {{ date('Y') }} SIMPEL-Z 
  </footer>
</body>
</html>
