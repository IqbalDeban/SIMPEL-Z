<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class FormLaporanController extends Controller
{
    public function index()
    {
        // Tampilkan form laporan
        return view('formlaporan');
    }

    public function preview(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'unitKerja' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'judul' => 'required|string|max:255',
            'narasumber' => 'required|string|max:255',
            'ringkasan' => 'required|string',
            'catatan' => 'required|string',
            'saran' => 'required|string',
        ]);

        // Simpan sementara ke session
        session(['laporan_data' => $validated]);

        // Kirim HTML template untuk preview
        return view('partials.template_laporan', ['data' => $validated]);
    }

    public function generatePDF(Request $request)
    {
        $data = session('laporan_data');

        if (!$data) {
            return response()->json(['error' => 'Data laporan tidak ditemukan'], 400);
        }

        $pdf = Pdf::loadView('pdf.laporan', ['data' => $data])
            ->setPaper('A4', 'portrait');

        $filename = 'Laporan_' . $data['nama'] . '_' . now()->format('Ymd_His') . '.pdf';
        $path = 'public/laporan/' . $filename;

        // Simpan file PDF ke storage
        Storage::put($path, $pdf->output());

        // Jika tombol "Unduh PDF" ditekan
        if ($request->has('download')) {
            return response()->download(storage_path('app/' . $path))
                             ->deleteFileAfterSend(false);
        }

        // Jika tombol "Konfirmasi & Kirim" ditekan
        return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil dikirim ke admin!',
            'filename' => $filename
        ]);
    }
}
