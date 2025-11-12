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
        // 🔍 Validasi data
        $validated = $request->validate([
            'nama'       => 'required|string|max:255',
            'nip'        => 'required|string|max:255',
            'jabatan'    => 'required|string|max:255',
            'unitKerja'  => 'required|string|max:255',
            'tanggal'    => 'required|date',
            'judul'      => 'required|string|max:255',
            'narasumber' => 'required|string|max:255',
            'ringkasan'  => 'required|string',
            'catatan'    => 'required|string',
            'saran'      => 'required|string',
        ]);

        // 📄 Nama file PDF
        $filename = 'Laporan_' . str_replace(' ', '_', $validated['nama']) . '_' . now()->format('Ymd_His') . '.pdf';
        $dir = storage_path('app/public/laporan');

        // 🔧 Pastikan folder laporan ada
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        // 🧾 Generate PDF
        $pdf = Pdf::loadView('pdf.laporan', ['data' => $validated])
            ->setPaper('A4', 'portrait');

        // 💾 Simpan ke storage
        $pdf->save($dir . '/' . $filename);

        // 🗃️ Simpan metadata ke database
        $report = Report::create([
            'tanggal'    => $validated['tanggal'],
            'nama'       => $validated['nama'],
            'nip'        => $validated['nip'],
            'jabatan'    => $validated['jabatan'],
            'unit_kerja' => $validated['unitKerja'],
            'judul'      => $validated['judul'],
            'narasumber' => $validated['narasumber'],
            'ringkasan'  => $validated['ringkasan'],
            'catatan'    => $validated['catatan'],
            'saran'      => $validated['saran'],
            'pdf_path'   => 'storage/laporan/' . $filename,
        ]);

        // 🔁 Jika request AJAX, kirim JSON
        if ($request->ajax()) {
            return response()->json([
                'success'       => true,
                'message'       => 'Laporan berhasil dikirim & PDF berhasil dibuat!',
                'filename'      => $filename,
                'download_link' => asset('storage/laporan/' . $filename),
            ]);
        }

        // 📥 Jika non-AJAX (fallback lama)
        return redirect()->back()->with([
            'success' => 'Laporan berhasil dikirim & PDF berhasil dibuat!',
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
