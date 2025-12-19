<?php

namespace App\Http\Controllers;

use App\Models\HasilAkhir;
use App\Models\Perhitungan;
use App\Models\Alternatif;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class HasilAkhirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hasilAkhir = HasilAkhir::with('alternatif')
            ->orderBy('ranking', 'asc')
            ->get();
        
        $hasHasil = HasilAkhir::exists();
        $hasPerhitungan = Perhitungan::exists();
        
        return view('hasil-akhir.index', compact('hasilAkhir', 'hasHasil', 'hasPerhitungan'));
    }

    /**
     * Proses generate hasil akhir
     */
    public function generate()
    {
        try {
            DB::beginTransaction();
            
            // Cek apakah sudah ada perhitungan
            if (!Perhitungan::exists()) {
                return redirect()->back()->with('error', 
                    'Belum ada data perhitungan. Silakan proses perhitungan terlebih dahulu di menu Data Perhitungan.'
                );
            }
            
            // Hapus hasil akhir lama
            HasilAkhir::truncate();
            
            // Ambil semua alternatif
            $alternatif = Alternatif::all();
            $hasilData = [];
            
            // Hitung total nilai untuk setiap alternatif
            foreach ($alternatif as $alt) {
                $totalNilai = Perhitungan::where('alternatif_id', $alt->id)
                    ->sum('nilai_akhir');
                
                $hasilData[] = [
                    'alternatif_id' => $alt->id,
                    'total_nilai' => $totalNilai,
                    'tanggal_perhitungan' => now()->toDateString()
                ];
            }
            
            // Urutkan berdasarkan total nilai (descending)
            usort($hasilData, function($a, $b) {
                return $b['total_nilai'] <=> $a['total_nilai'];
            });
            
            // Beri ranking
            foreach ($hasilData as $key => $data) {
                HasilAkhir::create([
                    'alternatif_id' => $data['alternatif_id'],
                    'total_nilai' => $data['total_nilai'],
                    'ranking' => $key + 1,
                    'tanggal_perhitungan' => $data['tanggal_perhitungan']
                ]);
            }
            
            DB::commit();
            
            return redirect()->route('hasil-akhir.index')
                ->with('success', 'Hasil akhir berhasil di-generate! Supplier terbaik telah ditentukan.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Detail hasil akhir per alternatif
     */
    public function detail($id)
    {
        $hasilAkhir = HasilAkhir::with(['alternatif.perhitungan.kriteria', 'alternatif.penilaian.kriteria', 'alternatif.penilaian.subKriteria'])
            ->findOrFail($id);
        
        $kriteria = Kriteria::all();
        
        return view('hasil-akhir.detail', compact('hasilAkhir', 'kriteria'));
    }

    /**
     * Reset hasil akhir
     */
    public function reset()
    {
        try {
            HasilAkhir::truncate();
            
            return redirect()->route('hasil-akhir.index')
                ->with('success', 'Data hasil akhir berhasil direset!');
                
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Export to PDF
     */
    public function exportPdf()
    {
        $hasilAkhir = HasilAkhir::with('alternatif')->orderBy('ranking', 'asc')->get();
        $kriteria = Kriteria::all();
        $tanggal = now()->format('d/m/Y');
        
        $pdf = Pdf::loadView('hasil-akhir.pdf', compact('hasilAkhir', 'kriteria', 'tanggal'));
        $pdf->setPaper('a4', 'portrait');
        
        return $pdf->download('Laporan_Hasil_SMART_' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Perbandingan alternatif
     */
    public function perbandingan()
    {
        $hasilAkhir = HasilAkhir::with(['alternatif.perhitungan.kriteria'])
            ->orderBy('ranking', 'asc')
            ->get();
        
        $kriteria = Kriteria::all();
        
        return view('hasil-akhir.perbandingan', compact('hasilAkhir', 'kriteria'));
    }
}
