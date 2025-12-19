<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\Supplier;
use App\Models\Alternatif;
use App\Models\Penilaian;
use App\Models\Perhitungan;
use App\Models\HasilAkhir;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik Umum
        $totalKriteria = Kriteria::count();
        $totalSupplier = Alternatif::count();
        $totalPenilaian = Penilaian::count();
        $hasPerhitungan = Perhitungan::exists();
        $hasHasil = HasilAkhir::exists();

        // Top 5 Suppliers (jika ada hasil)
        $topSuppliers = [];
        $supplierTerbaik = null;
        if ($hasHasil) {
            $topSuppliers = HasilAkhir::with('alternatif')
                ->orderBy('ranking', 'asc')
                ->limit(5)
                ->get();
            $supplierTerbaik = $topSuppliers->first();
        }

        // Data untuk chart - Distribusi Kriteria berdasarkan Jenis
        $kriteriaBenefit = Kriteria::where('jenis_kriteria', 'benefit')->count();
        $kriteriaCost = Kriteria::where('jenis_kriteria', 'cost')->count();

        // Data untuk chart - Bobot Kriteria
        $kriteriaData = Kriteria::select('kode_kriteria', 'nama_kriteria', 'bobot')
            ->orderBy('bobot', 'desc')
            ->get();

        // Status Kelengkapan Data
        $totalAlternatif = Alternatif::count();
        $expectedPenilaian = $totalAlternatif * $totalKriteria;
        $kelengkapanPenilaian = $expectedPenilaian > 0
            ? round(($totalPenilaian / $expectedPenilaian) * 100, 1)
            : 0;

        return view('dashboard', compact(
            'totalKriteria',
            'totalSupplier',
            'totalPenilaian',
            'hasPerhitungan',
            'hasHasil',
            'topSuppliers',
            'supplierTerbaik',
            'kriteriaBenefit',
            'kriteriaCost',
            'kriteriaData',
            'kelengkapanPenilaian'
        ));
    }
}
