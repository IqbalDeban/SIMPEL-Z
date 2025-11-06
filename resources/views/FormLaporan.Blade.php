@extends('layouts.app')

@section('title', 'Form Laporan Zoom')

@section('content')
<style>
.modal {
    position: fixed;
    inset: 0;
    display: none;
    align-items: center;
    justify-content: center;
    background: rgba(0, 0, 0, 0.5);
    z-index: 50;
}
.modal.active {
    display: flex;
}
</style>

<div class="container mx-auto py-10 px-6">

    <!-- Form Section -->
    <div id="formSection" class="animate-slide-in">
        <div class="grid lg:grid-cols-2 gap-8">
            <div class="glass-effect rounded-2xl shadow-xl p-8 card-hover bg-white">
                <div class="flex items-center mb-6">
                    <div class="bg-gradient-to-r from-purple-500 to-indigo-500 p-3 rounded-lg mr-4">
                        <i class="fas fa-user-edit text-white text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Formulir Laporan</h2>
                        <p class="text-gray-600 text-sm">Isi data kegiatan Zoom Anda</p>
                    </div>
                </div>

                <form id="laporanForm" class="space-y-4">
                    @csrf

                    <!-- Data Pegawai -->
                    <div class="bg-purple-50 p-4 rounded-lg">
                        <h3 class="font-semibold text-purple-800 mb-3 flex items-center">
                            <i class="fas fa-user-tie mr-2"></i>Data Pegawai
                        </h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <input type="text" name="nama" placeholder="Nama Pegawai" required class="border p-3 rounded-lg w-full">
                            <input type="text" name="nip" placeholder="NIP/NIK" required class="border p-3 rounded-lg w-full">
                            <input type="text" name="jabatan" placeholder="Jabatan" required class="border p-3 rounded-lg w-full">
                            <input type="text" name="unitKerja" placeholder="Unit Kerja" required class="border p-3 rounded-lg w-full">
                        </div>
                    </div>

                    <!-- Detail Kegiatan -->
                    <div class="bg-indigo-50 p-4 rounded-lg">
                        <h3 class="font-semibold text-indigo-800 mb-3 flex items-center">
                            <i class="fas fa-video mr-2"></i>Detail Kegiatan
                        </h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <input type="date" name="tanggal" required class="border p-3 rounded-lg w-full">
                            <input type="text" name="judul" placeholder="Judul Pemaparan" required class="border p-3 rounded-lg w-full">
                            <input type="text" name="narasumber" placeholder="Narasumber" required class="border p-3 rounded-lg w-full">
                        </div>
                    </div>

                    <!-- Evaluasi -->
                    <div class="bg-green-50 p-4 rounded-lg">
                        <h3 class="font-semibold text-green-800 mb-3 flex items-center">
                            <i class="fas fa-clipboard-check mr-2"></i>Evaluasi & Catatan
                        </h3>
                        <textarea name="ringkasan" placeholder="Ringkasan Materi" class="border p-3 rounded-lg w-full" required></textarea>
                        <textarea name="catatan" placeholder="Catatan / Evaluasi Pribadi" class="border p-3 rounded-lg w-full" required></textarea>
                        <textarea name="saran" placeholder="Saran atau Feedback" class="border p-3 rounded-lg w-full" required></textarea>
                    </div>

                    <!-- Tombol -->
                    <div class="flex justify-between pt-4">
                        <button type="button" id="previewBtn"
                            class="bg-green-500 hover:bg-green-600 text-white py-3 px-6 rounded-lg font-semibold">
                            <i class="fas fa-eye mr-2"></i> Preview & Generate
                        </button>
                        <button type="reset"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-3 px-6 rounded-lg font-semibold">
                            <i class="fas fa-undo mr-2"></i> Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Preview -->
    <div id="previewModal" class="modal">
        <div class="bg-white rounded-xl shadow-lg w-11/12 md:w-3/4 p-6 overflow-y-auto max-h-[90vh]">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-700">
                    <i class="fas fa-file-alt mr-2"></i> Preview Laporan
                </h3>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div id="previewContent"></div>

            <!-- 🧩 Tombol Unduh & Konfirmasi -->
            <form id="generateForm" action="{{ route('form.generate') }}" method="POST" class="flex justify-between mt-6">
                @csrf
                <button type="submit" name="download" value="1"
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-semibold">
                    <i class="fas fa-download mr-2"></i> Unduh PDF
                </button>

                <button type="submit" name="confirm"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold">
                    <i class="fas fa-paper-plane mr-2"></i> Konfirmasi & Kirim
                </button>
            </form>
        </div>
    </div>
</div>

<script>
const previewBtn = document.getElementById('previewBtn');
const closeModal = document.getElementById('closeModal');
const form = document.getElementById('laporanForm');
const modal = document.getElementById('previewModal');

previewBtn.addEventListener('click', async () => {
    const formData = new FormData(form);

    try {
        const response = await fetch("{{ route('form.preview') }}", {
            method: "POST",
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: formData
        });

        if (!response.ok) throw new Error("Gagal memuat preview.");

        const html = await response.text();
        document.getElementById('previewContent').innerHTML = html;
        modal.classList.add('active');
    } catch (err) {
        alert(err.message);
    }
});

closeModal.addEventListener('click', () => modal.classList.remove('active'));
</script>
@endsection
