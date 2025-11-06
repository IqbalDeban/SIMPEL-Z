<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormLaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini kamu dapat mendaftarkan semua rute web untuk aplikasi kamu.
| Rute ini dimuat oleh RouteServiceProvider dan semuanya akan
| ditugaskan ke grup middleware "web". Buatlah sesuatu yang hebat!
|
*/

// === Halaman Utama ===
Route::get('/', function () {
    return view('welcome');
});

// === Form Laporan Zoom ===

// Menampilkan halaman form input laporan (formlaporan.blade.php)
Route::get('/form-laporan', [FormLaporanController::class, 'index'])
    ->name('form.laporan');

// Setelah form disubmit, validasi data & tampilkan halaman preview konfirmasi
Route::post('/form-laporan/preview', [FormLaporanController::class, 'preview'])
    ->name('form.preview');

// Setelah dikonfirmasi, generate PDF otomatis dari template resmi instansi
Route::post('/form-laporan/generate', [FormLaporanController::class, 'generatePDF'])
    ->name('form.generate');

