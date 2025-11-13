<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormLaporanController;
use App\Http\Controllers\ManajemenDataController;

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


// MANAJEMEN DATA (role admin)
Route::prefix('manajemen-data')->name('manajemen-data.')->group(function () {
    Route::get('/', [ManajemenDataController::class, 'index'])->name('index');
    Route::get('/download/{id}', [ManajemenDataController::class, 'download'])->name('download');
    Route::delete('/delete/{id}', [ManajemenDataController::class, 'destroy'])->name('destroy');
});