@extends('layouts.app')

@section('title', 'Form Laporan Zoom')

@section('content')
<style>
/* 🔹 Notifikasi di tengah layar */
#notif {
    position: fixed;
    top: 2rem;
    left: 50%;
    transform: translateX(-50%) translateY(-20px);
    background-color: #22c55e;
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    font-weight: 500;
    opacity: 0;
    transition: opacity 0.7s ease, transform 0.7s ease;
    z-index: 9999;
}
#notif.show {
    opacity: 1;
    transform: translateX(-50%) translateY(0);
}
</style>

<div id="notif"></div>

<div class="flex justify-center items-start min-h-screen py-10 px-6 bg-gray-100">
    <div class="w-full max-w-4xl">
        <div class="rounded-2xl shadow-xl p-8 bg-white">
            <div class="flex items-center mb-6">
                <div class="bg-gradient-to-r from-purple-500 to-indigo-500 p-3 rounded-lg mr-4">
                    <i class="fas fa-user-edit text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Formulir Laporan</h2>
                    <p class="text-gray-600 text-sm">Isi data kegiatan Zoom Anda</p>
                </div>
            </div>

            {{-- Error list --}}
            <div id="errorBox" class="hidden bg-red-100 text-red-800 p-3 rounded mb-4"></div>

            {{-- Form --}}
            <form id="laporanForm" action="{{ route('form.generate') }}" method="POST" class="space-y-4">
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
                <div class="flex items-center justify-between pt-4">
                    <div class="flex items-center gap-3">
                        <button type="submit" id="btnSubmit"
                            class="bg-green-500 hover:bg-green-600 text-white py-3 px-6 rounded-lg font-semibold">
                            <i class="fas fa-paper-plane mr-2"></i> Kirim & Generate PDF
                        </button>

                        <a id="downloadBtn" href="#" download
                           class="hidden bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-lg font-semibold">
                            <i class="fas fa-download mr-2"></i> Unduh PDF
                        </a>
                    </div>

                    <button type="button" id="resetBtn"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-3 px-6 rounded-lg font-semibold">
                        <i class="fas fa-undo mr-2"></i> Reset
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Script AJAX --}}
<script>
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("laporanForm");
    const notif = document.getElementById("notif");
    const errorBox = document.getElementById("errorBox");
    const downloadBtn = document.getElementById("downloadBtn");
    const resetBtn = document.getElementById("resetBtn");

    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const formData = new FormData(form);

        try {
            const response = await fetch(form.action, {
                method: "POST",
                body: formData,
                headers: { "X-Requested-With": "XMLHttpRequest" },
            });

            const result = await response.json();

            if (result.success) {
                notif.textContent = result.message;
                notif.classList.add("show");
                errorBox.classList.add("hidden");

                // Munculkan tombol unduh
                downloadBtn.href = `/storage/laporan/${result.filename}`;
                downloadBtn.download = result.filename;
                downloadBtn.classList.remove("hidden");

                // Otomatis unduh
                const link = document.createElement('a');
                link.href = downloadBtn.href;
                link.download = result.filename;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

                // Hilangkan notif setelah 4 detik
                setTimeout(() => notif.classList.remove("show"), 4000);
            } else {
                const errors = result.errors || [result.error];
                errorBox.innerHTML = `<ul>${errors.map(e => `<li>${e}</li>`).join('')}</ul>`;
                errorBox.classList.remove("hidden");
            }
        } catch (err) {
            console.error(err);
            errorBox.textContent = "Terjadi kesalahan tak terduga.";
            errorBox.classList.remove("hidden");
        }
    });

    resetBtn.addEventListener("click", () => {
        form.reset();
        notif.classList.remove("show");
        downloadBtn.classList.add("hidden");
        errorBox.classList.add("hidden");
    });
});
</script>
@endsection
