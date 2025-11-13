@extends('layouts.app')

@section('title', 'Form Lesson Learned - Wajar Patuh')

@section('content')
<style>
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
label {
    font-weight: 600;
    color: #374151;
}
input, textarea {
    width: 100%;
}
</style>

<div id="notif"></div>

<div class="flex justify-center items-start min-h-screen py-10 px-6 bg-gray-100">
    <div class="w-full max-w-5xl">
        <div class="rounded-2xl shadow-xl p-8 bg-white">
            <div class="flex items-center mb-6">
                <div class="bg-gradient-to-r from-purple-500 to-indigo-500 p-3 rounded-lg mr-4">
                    <i class="fas fa-book-open text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Form Lesson Learned - Wajar Patuh</h2>
                    <p class="text-gray-600 text-sm">Isi data pembelajaran dan hasil lesson learned Anda</p>
                </div>
            </div>

            <div id="errorBox" class="hidden bg-red-100 text-red-800 p-3 rounded mb-4"></div>

            <form id="lessonForm" action="{{ route('form.generate') }}" method="POST" class="space-y-6">
                @csrf

                <!-- I. Data Pegawai -->
                <div class="bg-purple-50 p-5 rounded-lg">
                    <h3 class="font-semibold text-purple-800 mb-4 flex items-center">
                        <i class="fas fa-user-tie mr-2"></i>I. Data Diri Pegawai
                    </h3>

                    {{-- Nama + NPP --}}
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="nama">Nama</label>
                            <input type="text" id="nama" name="nama" class="border p-3 rounded-lg mt-1" required>
                        </div>
                        <div>
                            <label for="npp">NPP</label>
                            <input type="text" id="npp" name="npp" class="border p-3 rounded-lg mt-1" required>
                        </div>
                    </div>

                    {{-- Pangkat + Jabatan --}}
                    <div class="grid md:grid-cols-2 gap-6 mt-4">
                        <div>
                            <label for="pangkat">Pangkat</label>
                            <input type="text" id="pangkat" name="pangkat" class="border p-3 rounded-lg mt-1" required>
                        </div>
                        <div>
                            <label for="jabatan">Jabatan</label>
                            <input type="text" id="jabatan" name="jabatan" class="border p-3 rounded-lg mt-1" required>
                        </div>
                    </div>

                    {{-- Unit Kerja --}}
                    <div class="mt-4">
                        <label for="unit_kerja">Unit Kerja</label>
                        <input type="text" id="unit_kerja" name="unit_kerja" class="border p-3 rounded-lg mt-1" required>
                    </div>

                    {{-- Satuan Kerja --}}
                    <div class="mt-4">
                        <label for="satuan_kerja">Satuan Kerja</label>
                        <input type="text" id="satuan_kerja" name="satuan_kerja" class="border p-3 rounded-lg mt-1" required>
                    </div>
                </div>

                <!-- II. Pembelajaran -->
                <div class="bg-indigo-50 p-5 rounded-lg">
                    <h3 class="font-semibold text-indigo-800 mb-4 flex items-center">
                        <i class="fas fa-chalkboard-teacher mr-2"></i>II. Pembelajaran
                    </h3>

                    {{-- Jenis Pembelajaran --}}
                    <div>
                        <label for="jenis_pembelajaran">Jenis Pembelajaran</label>
                        <input type="text" id="jenis_pembelajaran" name="jenis_pembelajaran"
                               class="border p-3 rounded-lg mt-1"
                               placeholder="Contoh: 3. Pembelajaran Informal - Sharing Session - Communitity of
Practice/Bicarain" required>
                    </div>

                    {{-- Nama Pembelajaran + Jam Pembelajaran --}}
                    <div class="grid md:grid-cols-2 gap-6 mt-4">
                        <div>
                            <label for="nama_pembelajaran">Nama Pembelajaran</label>
                            <input type="text" id="nama_pembelajaran" name="nama_pembelajaran"
                                   class="border p-3 rounded-lg mt-1"
                                   placeholder="Contoh: Bicarain" required>
                        </div>
                        <div>
                            <label for="jam_pembelajaran">Jam Pembelajaran</label>
                            <input type="text" id="jam_pembelajaran" name="jam_pembelajaran"
                                   class="border p-3 rounded-lg mt-1"
                                   placeholder="Misal: 2 JP" required>
                        </div>
                    </div>

                    {{-- Materi --}}
                    <div class="mt-4">
                        <label for="materi">Materi</label>
                        <input type="text" id="materi" name="materi"
                               class="border p-3 rounded-lg mt-1" required>
                    </div>

                    {{-- Tanggal + Narasumber --}}
                    <div class="grid md:grid-cols-2 gap-6 mt-4">
                        <div>
                            <label for="tanggal">Tanggal</label>
                            <input type="date" id="tanggal" name="tanggal"
                                   class="border p-3 rounded-lg mt-1" required>
                        </div>
                        <div>
                            <label for="narasumber">Narasumber</label>
                            <input type="text" id="narasumber" name="narasumber"
                                   class="border p-3 rounded-lg mt-1" required>
                        </div>
                    </div>
                </div>

                <!-- III. Lesson Learned -->
                <div class="bg-green-50 p-5 rounded-lg">
                    <h3 class="font-semibold text-green-800 mb-4 flex items-center">
                        <i class="fas fa-lightbulb mr-2"></i>III. Lesson Learned
                    </h3>
                    <div>
                        <label for="lesson_learned">Poin Pembelajaran</label>
                        <textarea id="lesson_learned" name="lesson_learned" rows="6"
                                  class="border p-3 rounded-lg mt-1"
                                  placeholder="Tuliskan poin-poin pembelajaran yang Anda dapatkan..."
                                  required></textarea>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="flex items-center justify-between pt-4">
                    <div class="flex items-center gap-3">
                        <button type="submit" id="btnSubmit"
                            class="bg-green-500 hover:bg-green-600 text-white py-3 px-6 rounded-lg font-semibold">
                            <i class="fas fa-paper-plane mr-2"></i> Konfirmasi & Generate PDF
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

{{-- Script AJAX (tetap sama) --}}
<script>
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("lessonForm");
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

                downloadBtn.href = result.download_link;
                downloadBtn.download = result.filename;
                downloadBtn.classList.remove("hidden");

                const link = document.createElement('a');
                link.href = downloadBtn.href;
                link.download = result.filename;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

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
