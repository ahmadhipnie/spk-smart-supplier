<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\HasilController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('kriteria', KriteriaController::class);
Route::resource('supplier', SupplierController::class);
Route::resource('penilaian', PenilaianController::class);

Route::get('/perhitungan', [PerhitunganController::class, 'index'])->name('perhitungan');
Route::post('/perhitungan/hitung', [PerhitunganController::class, 'hitung'])->name('perhitungan.hitung');
Route::get('/hasil', [HasilController::class, 'index'])->name('hasil');

