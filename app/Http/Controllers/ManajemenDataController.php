<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class ManajemenDataController extends Controller
{
    /**
     * Tampilkan semua data laporan (halaman admin)
     */
    public function index()
    {
        $reports = Report::latest()->paginate(10);
        return view('manajemen_data.index', compact('reports'));
    }

    /**
     * Unduh PDF laporan yang sudah dibuat
     */
    public function download($id)
    {
        $report = Report::findOrFail($id);

        // Pastikan kolom pdf_path berisi seperti: storage/laporan/NamaFile.pdf
        $filePath = public_path($report->pdf_path);

        if (!$report->pdf_path || !file_exists($filePath)) {
            return back()->with('error', 'File PDF tidak ditemukan di server.');
        }

        // Unduh file dengan nama asli
        return response()->download($filePath);
    }

    /**
     * Hapus data laporan dan file PDF-nya (jika ada)
     */
    public function destroy($id)
    {
        $report = Report::findOrFail($id);

        // Hapus file PDF dari public/storage/laporan
        if ($report->pdf_path) {
            $filePath = public_path($report->pdf_path);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // Hapus data dari database
        $report->delete();

        return redirect()->route('manajemen-data.index')->with('success', 'Data laporan berhasil dihapus.');
    }
}