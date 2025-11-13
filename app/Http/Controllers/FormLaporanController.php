<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class FormLaporanController extends Controller
{
    /**
     * Tampilkan halaman form laporan.
     */
    public function index()
    {
        return view('formlaporan');
    }

    /**
     * Generate PDF dan simpan metadata ke database.
     */
    public function generatePDF(Request $request)
    {
        // 🔍 Validasi data input dari form
        $validated = $request->validate([
            'nama'                => 'required|string|max:255',
            'npp'                 => 'required|string|max:255',
            'pangkat'             => 'required|string|max:255',
            'jabatan'             => 'required|string|max:255',
            'unit_kerja'          => 'required|string|max:255',
            'satuan_kerja'        => 'required|string|max:255',
            'jenis_pembelajaran'  => 'required|string|max:255',
            'nama_pembelajaran'   => 'required|string|max:255',
            'tanggal'             => 'required|date',
            'materi'              => 'required|string|max:255',
            'narasumber'          => 'required|string|max:255',
            'jam_pembelajaran'    => 'required|string|max:50',
            'lesson_learned'      => 'required|string',
        ]);

        // 📄 Nama file PDF
        $filename = 'LessonLearned_' . str_replace(' ', '_', $validated['nama']) . '_' . now()->format('Ymd_His') . '.pdf';
        $dir = storage_path('app/public/laporan');

        // 🔧 Pastikan folder laporan ada
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        // 🧾 Generate PDF berdasarkan template Blade pdf.laporan
        $pdf = Pdf::loadView('pdf.laporan', ['data' => $validated])
            ->setPaper('A4', 'portrait');

        // 💾 Simpan file PDF ke storage
        $pdf->save($dir . '/' . $filename);

        // 🗃️ Simpan metadata ke database (tabel reports)
        $report = Report::create([
            'tanggal'      => $validated['tanggal'],
            'nama'         => $validated['nama'],
            'nip'          => $validated['npp'],
            'jabatan'      => $validated['jabatan'],
            'unit_kerja'   => $validated['unit_kerja'],
            'satuan_kerja' => $validated['satuan_kerja'],
            'judul'        => $validated['nama_pembelajaran'],
            'materi'       => $validated['materi'],
            'ringkasan'    => $validated['lesson_learned'],
            'catatan'      => null,
            'saran'        => null,
            'pdf_path'     => 'storage/laporan/' . $filename,
        ]);

        // 🔁 Jika request AJAX, kirim respon JSON
        if ($request->ajax()) {
            return response()->json([
                'success'       => true,
                'message'       => 'Lesson Learned berhasil dikirim & PDF berhasil dibuat!',
                'filename'      => $filename,
                'download_link' => asset('storage/laporan/' . $filename),
            ]);
        }

        // 📥 Jika non-AJAX (fallback lama)
        return redirect()->back()->with([
            'success' => 'Lesson Learned berhasil dikirim & PDF berhasil dibuat!',
            'download_link' => route('form.download', $report->id),
        ]);
    }

    /**
     * Unduh PDF berdasarkan ID laporan.
     */
    public function downloadPDF($id)
    {
        $report = Report::findOrFail($id);
        $path = storage_path('app/public/laporan/' . basename($report->pdf_path));

        if (!file_exists($path)) {
            abort(404, 'File PDF tidak ditemukan.');
        }

        return response()->download($path);
    }

    /**
     * Bersihkan session notifikasi.
     */
    public function clearSession()
    {
        session()->forget(['success', 'download_link']);
        return response()->noContent();
    }
}