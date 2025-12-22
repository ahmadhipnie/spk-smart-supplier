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

    // Dashboard / Home (Semua role bisa akses)
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', fn () => redirect()->route('dashboard'))->name('home');

    /*
    |-------------------------
    | MASTER DATA - READ ONLY (Semua role bisa lihat)
    |-------------------------
    */
    
    // Kriteria - Index untuk semua role
    Route::get('kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
    
    // Supplier - Index untuk semua role
    Route::get('supplier', [SupplierController::class, 'index'])->name('supplier.index');
    
    // Sub Kriteria - Index untuk semua role
    Route::get('sub-kriteria', [SubKriteriaController::class, 'index'])->name('sub-kriteria.index');
    
    // Alternatif - Index untuk semua role
    Route::get('alternatif', [AlternatifController::class, 'index'])->name('alternatif.index');

    /*
    |-------------------------
    | MASTER DATA - CRUD (HANYA ADMIN)
    |-------------------------
    */
    Route::middleware('admin')->group(function () {
        // Kriteria - Create, Store, Edit, Update, Delete
        Route::get('kriteria/create', [KriteriaController::class, 'create'])->name('kriteria.create');
        Route::post('kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');
        Route::get('kriteria/{kriteria}/edit', [KriteriaController::class, 'edit'])->name('kriteria.edit');
        Route::put('kriteria/{kriteria}', [KriteriaController::class, 'update'])->name('kriteria.update');
        Route::delete('kriteria/{kriteria}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');

        // Supplier - Create, Store, Edit, Update, Delete
        Route::get('supplier/create', [SupplierController::class, 'create'])->name('supplier.create');
        Route::post('supplier', [SupplierController::class, 'store'])->name('supplier.store');
        Route::get('supplier/{supplier}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
        Route::put('supplier/{supplier}', [SupplierController::class, 'update'])->name('supplier.update');
        Route::delete('supplier/{supplier}', [SupplierController::class, 'destroy'])->name('supplier.destroy');

        // Sub Kriteria - Create, Store, Edit, Update, Delete
        Route::get('sub-kriteria/create', [SubKriteriaController::class, 'create'])->name('sub-kriteria.create');
        Route::post('sub-kriteria', [SubKriteriaController::class, 'store'])->name('sub-kriteria.store');
        Route::get('sub-kriteria/{sub_kriteria}/edit', [SubKriteriaController::class, 'edit'])->name('sub-kriteria.edit');
        Route::put('sub-kriteria/{sub_kriteria}', [SubKriteriaController::class, 'update'])->name('sub-kriteria.update');
        Route::delete('sub-kriteria/{sub_kriteria}', [SubKriteriaController::class, 'destroy'])->name('sub-kriteria.destroy');

        // Alternatif - Create, Store, Edit, Update, Delete
        Route::get('alternatif/create', [AlternatifController::class, 'create'])->name('alternatif.create');
        Route::post('alternatif', [AlternatifController::class, 'store'])->name('alternatif.store');
        Route::get('alternatif/{alternatif}/edit', [AlternatifController::class, 'edit'])->name('alternatif.edit');
        Route::put('alternatif/{alternatif}', [AlternatifController::class, 'update'])->name('alternatif.update');
        Route::delete('alternatif/{alternatif}', [AlternatifController::class, 'destroy'])->name('alternatif.destroy');
    });

    /*
    |-------------------------
    | DETAIL/SHOW ROUTES (dengan parameter dinamis)
    | Harus di bawah route spesifik seperti create/edit
    |-------------------------
    */
    
    // Kriteria - Show untuk semua role
    Route::get('kriteria/{kriteria}', [KriteriaController::class, 'show'])->name('kriteria.show');
    
    // Supplier - Show untuk semua role
    Route::get('supplier/{supplier}', [SupplierController::class, 'show'])->name('supplier.show');
    
    // Sub Kriteria - Show untuk semua role
    Route::get('sub-kriteria/{sub_kriteria}', [SubKriteriaController::class, 'show'])->name('sub-kriteria.show');
    
    // Alternatif - Show untuk semua role
    Route::get('alternatif/{alternatif}', [AlternatifController::class, 'show'])->name('alternatif.show');

    /*
    |-------------------------
    | PENILAIAN (Semua role - untuk saat ini)
    |-------------------------
    */
    Route::resource('penilaian', PenilaianController::class);
    Route::get('penilaian-alternatif/{alternatif}', [PenilaianController::class, 'penilaianAlternatif'])
        ->name('penilaian.alternatif');
    Route::post('penilaian-alternatif/{alternatif}', [PenilaianController::class, 'savePenilaianAlternatif'])
        ->name('penilaian.alternatif.save');
    Route::get('get-sub-kriteria/{kriteria}', [PenilaianController::class, 'getSubKriteria'])
        ->name('get.sub.kriteria');

    /*
    |-------------------------
    | PERHITUNGAN SMART (Semua role)
    |-------------------------
    */
    Route::get('perhitungan', [PerhitunganController::class, 'index'])->name('perhitungan.index');
    Route::post('perhitungan/proses', [PerhitunganController::class, 'proses'])->name('perhitungan.proses');
    Route::get('perhitungan/detail/{alternatif}', [PerhitunganController::class, 'detail'])->name('perhitungan.detail');
    Route::delete('perhitungan/reset', [PerhitunganController::class, 'reset'])->name('perhitungan.reset');
    Route::get('perhitungan/rumus', [PerhitunganController::class, 'rumus'])->name('perhitungan.rumus');

    /*
    |-------------------------
    | HASIL AKHIR (Semua role)
    |-------------------------
    */
    Route::get('hasil-akhir', [HasilAkhirController::class, 'index'])->name('hasil-akhir.index');
    Route::post('hasil-akhir/generate', [HasilAkhirController::class, 'generate'])->name('hasil-akhir.generate');
    Route::get('hasil-akhir/detail/{id}', [HasilAkhirController::class, 'detail'])->name('hasil-akhir.detail');
    Route::delete('hasil-akhir/reset', [HasilAkhirController::class, 'reset'])->name('hasil-akhir.reset');
    Route::get('hasil-akhir/export-pdf', [HasilAkhirController::class, 'exportPdf'])->name('hasil-akhir.export-pdf');
    Route::get('hasil-akhir/perbandingan', [HasilAkhirController::class, 'perbandingan'])->name('hasil-akhir.perbandingan');

    /*
    |-------------------------
    | PROFILE USER (Semua role)
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
        Route::post('users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
    });
});
