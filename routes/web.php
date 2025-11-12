<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormLaporanController;

// Halaman utama (opsional)
Route::get('/', function () {
    return view('welcome');
});

// Form laporan utama
Route::get('/form-laporan', [FormLaporanController::class, 'index'])
    ->name('form.laporan');

// Submit form → langsung generate PDF
Route::post('/form-laporan/generate', [FormLaporanController::class, 'generatePDF'])
    ->name('form.generate');

// Unduh file PDF berdasarkan ID laporan
Route::get('/form-laporan/download/{id}', [FormLaporanController::class, 'downloadPDF'])
    ->name('form.download');

// Clear Session
Route::get('/form-laporan/clear-session', [FormLaporanController::class, 'clearSession'])
    ->name('form.clearSession');