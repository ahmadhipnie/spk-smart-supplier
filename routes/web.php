<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\SubKriteriaController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\HasilAkhirController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini Anda mendaftarkan semua route web aplikasi.
|
*/

/*
|----------------------------------------------------
| ROUTE AUTH (LOGIN / LOGOUT)
|----------------------------------------------------
*/

// Hanya tamu (belum login) yang boleh melihat halaman login
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.post');
});

// Logout untuk user yang sudah login
Route::post('logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');


/*
|----------------------------------------------------
| ROUTE YANG WAJIB LOGIN (auth)
|----------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Dashboard / Home
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', fn () => redirect()->route('dashboard'))->name('home');

    /*
    |-------------------------
    | MASTER DATA & PROSES
    |-------------------------
    */
    Route::resource('kriteria', KriteriaController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('sub-kriteria', SubKriteriaController::class);
    Route::resource('alternatif', AlternatifController::class);

    // Penilaian
    Route::resource('penilaian', PenilaianController::class);
    Route::get('penilaian-alternatif/{alternatif}', [PenilaianController::class, 'penilaianAlternatif'])
        ->name('penilaian.alternatif');
    Route::post('penilaian-alternatif/{alternatif}', [PenilaianController::class, 'savePenilaianAlternatif'])
        ->name('penilaian.alternatif.save');
    Route::get('get-sub-kriteria/{kriteria}', [PenilaianController::class, 'getSubKriteria'])
        ->name('get.sub.kriteria');

    // Perhitungan SMART
    Route::get('perhitungan', [PerhitunganController::class, 'index'])->name('perhitungan.index');
    Route::post('perhitungan/proses', [PerhitunganController::class, 'proses'])->name('perhitungan.proses');
    Route::get('perhitungan/detail/{alternatif}', [PerhitunganController::class, 'detail'])->name('perhitungan.detail');
    Route::delete('perhitungan/reset', [PerhitunganController::class, 'reset'])->name('perhitungan.reset');
    Route::get('perhitungan/rumus', [PerhitunganController::class, 'rumus'])->name('perhitungan.rumus');

    // Hasil Akhir
    Route::get('hasil-akhir', [HasilAkhirController::class, 'index'])->name('hasil-akhir.index');
    Route::post('hasil-akhir/generate', [HasilAkhirController::class, 'generate'])->name('hasil-akhir.generate');
    Route::get('hasil-akhir/detail/{id}', [HasilAkhirController::class, 'detail'])->name('hasil-akhir.detail');
    Route::delete('hasil-akhir/reset', [HasilAkhirController::class, 'reset'])->name('hasil-akhir.reset');
    Route::get('hasil-akhir/export-pdf', [HasilAkhirController::class, 'exportPdf'])->name('hasil-akhir.export-pdf');
    Route::get('hasil-akhir/perbandingan', [HasilAkhirController::class, 'perbandingan'])->name('hasil-akhir.perbandingan');

    /*
    |-------------------------
    | PROFILE USER (semua role)
    |-------------------------
    */
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('profile/change-password', [ProfileController::class, 'editPassword'])->name('profile.edit-password');
    Route::put('profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
    Route::get('profile/activity', [ProfileController::class, 'activity'])->name('profile.activity');

    /*
    |-------------------------
    | DATA USER (HANYA ADMIN)
    |-------------------------
    */
    Route::middleware('admin')->group(function () {
        Route::resource('users', UserController::class);
    });
});
