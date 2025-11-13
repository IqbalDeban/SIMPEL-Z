<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen Data | SIMPEL-Z</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/a2d9d6f6f5.js" crossorigin="anonymous"></script>
  <style>
    /* Animasi notifikasi */
    #notif {
      position: fixed;
      top: 1.5rem;
      right: 1.5rem;
      z-index: 50;
      opacity: 0;
      transform: translateY(-20px);
      transition: all 0.6s ease;
    }
    #notif.show {
      opacity: 1;
      transform: translateY(0);
    }
  </style>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col items-center py-10">

  <!-- Notifikasi -->
  <div id="notif" class="hidden px-5 py-3 rounded-lg shadow-lg text-white font-medium"></div>

  <div class="w-full max-w-6xl bg-white shadow-lg rounded-2xl p-8">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8 flex-wrap gap-3">
      <h1 class="text-2xl md:text-3xl font-bold text-gray-800 flex items-center gap-2">
        <i class="fa-solid fa-database text-indigo-600"></i> Manajemen Data Laporan
      </h1>

      <a href="{{ url('/') }}" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-md font-semibold text-sm">
        <i class="fa-solid fa-home mr-1"></i> Kembali ke Beranda
      </a>
    </div>

    <!-- Tabel -->
    <div class="overflow-x-auto">
      <table class="w-full border-collapse text-left rounded-lg overflow-hidden">
        <thead>
          <tr class="bg-indigo-50 border-b">
            <th class="p-3 font-semibold text-gray-700">Nama</th>
            <th class="p-3 font-semibold text-gray-700">Judul</th>
            <th class="p-3 font-semibold text-gray-700">Tanggal</th>
            <th class="p-3 font-semibold text-gray-700">Unit Kerja</th>
            <th class="p-3 font-semibold text-gray-700 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($reports as $report)
          <tr class="border-b hover:bg-gray-50 transition">
            <td class="p-3">{{ $report->nama }}</td>
            <td class="p-3">{{ $report->judul }}</td>
            <td class="p-3">{{ \Carbon\Carbon::parse($report->tanggal)->format('d M Y') }}</td>
            <td class="p-3">{{ $report->unit_kerja }}</td>
            <td class="p-3 text-center">
              <div class="flex justify-center gap-2">
                @if($report->pdf_path)
                  <a href="{{ route('manajemen-data.download', $report->id) }}" 
                     class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-md text-sm flex items-center gap-1 transition">
                    <i class="fa-solid fa-download"></i> PDF
                  </a>
                @else
                  <span class="text-gray-400 text-sm italic">Belum ada PDF</span>
                @endif

                <form action="{{ route('manajemen-data.destroy', $report->id) }}" method="POST" 
                      onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" 
                          class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-md text-sm flex items-center gap-1 transition">
                    <i class="fa-solid fa-trash"></i> Hapus
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="text-center p-5 text-gray-500 italic">Belum ada data laporan.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
      {{ $reports->links() }}
    </div>
  </div>

  <!-- Script notifikasi -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const notif = document.getElementById('notif');
      const success = @json(session('success'));
      const error = @json(session('error'));

      if (success || error) {
        notif.textContent = success || error;
        notif.classList.remove('hidden');
        notif.classList.add('show', success ? 'bg-green-500' : 'bg-red-500');

        setTimeout(() => notif.classList.remove('show'), 4000);
      }
    });
  </script>

</body>
</html>