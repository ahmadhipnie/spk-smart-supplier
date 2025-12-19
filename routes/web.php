<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\SubKriteriaController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\HasilAkhirController;

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
Route::resource('sub-kriteria', SubKriteriaController::class);
Route::resource('alternatif', AlternatifController::class);

Route::resource('penilaian', PenilaianController::class);
Route::get('penilaian-alternatif/{alternatif}', [PenilaianController::class, 'penilaianAlternatif'])->name('penilaian.alternatif');
Route::post('penilaian-alternatif/{alternatif}', [PenilaianController::class, 'savePenilaianAlternatif'])->name('penilaian.alternatif.save');
Route::get('get-sub-kriteria/{kriteria}', [PenilaianController::class, 'getSubKriteria'])->name('get.sub.kriteria');

Route::get('perhitungan', [PerhitunganController::class, 'index'])->name('perhitungan.index');
Route::post('perhitungan/proses', [PerhitunganController::class, 'proses'])->name('perhitungan.proses');
Route::get('perhitungan/detail/{alternatif}', [PerhitunganController::class, 'detail'])->name('perhitungan.detail');
Route::delete('perhitungan/reset', [PerhitunganController::class, 'reset'])->name('perhitungan.reset');
Route::get('perhitungan/rumus', [PerhitunganController::class, 'rumus'])->name('perhitungan.rumus');


Route::get('hasil-akhir', [HasilAkhirController::class, 'index'])->name('hasil-akhir.index');
Route::post('hasil-akhir/generate', [HasilAkhirController::class, 'generate'])->name('hasil-akhir.generate');
Route::get('hasil-akhir/detail/{id}', [HasilAkhirController::class, 'detail'])->name('hasil-akhir.detail');
Route::delete('hasil-akhir/reset', [HasilAkhirController::class, 'reset'])->name('hasil-akhir.reset');
Route::get('hasil-akhir/export-pdf', [HasilAkhirController::class, 'exportPdf'])->name('hasil-akhir.export-pdf');
Route::get('hasil-akhir/perbandingan', [HasilAkhirController::class, 'perbandingan'])->name('hasil-akhir.perbandingan');

