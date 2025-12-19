<?php

namespace App\Http\Controllers;

use App\Models\Perhitungan;
use App\Models\Penilaian;
use App\Models\Alternatif;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerhitunganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alternatif = Alternatif::with(['perhitungan.kriteria'])->get();
        $kriteria = Kriteria::all();
        
        // Cek apakah sudah ada perhitungan
        $hasPerhitungan = Perhitungan::exists();
        
        return view('perhitungan.index', compact('alternatif', 'kriteria', 'hasPerhitungan'));
    }

    /**
     * Proses perhitungan SMART
     */
    public function proses()
    {
        try {
            DB::beginTransaction();
            
            // Hapus perhitungan lama
            Perhitungan::truncate();
            
            $kriteria = Kriteria::all();
            $alternatif = Alternatif::all();
            
            // Validasi: pastikan semua alternatif sudah dinilai untuk semua kriteria
            foreach ($alternatif as $alt) {
                $jumlahPenilaian = Penilaian::where('alternatif_id', $alt->id)->count();
                if ($jumlahPenilaian < $kriteria->count()) {
                    DB::rollBack();
                    return redirect()->back()->with('error', 
                        'Alternatif "' . $alt->nama_supplier . '" belum lengkap penilaiannya. ' .
                        'Harap lengkapi penilaian untuk semua kriteria terlebih dahulu.'
                    );
                }
            }
            
            // Step 1: Normalisasi Bobot Kriteria
            $totalBobot = $kriteria->sum('bobot');
            
            // Step 2: Hitung Nilai Utility untuk setiap kriteria
            foreach ($kriteria as $k) {
                // Ambil semua nilai untuk kriteria ini
                $nilaiKriteria = Penilaian::where('kriteria_id', $k->id)
                    ->pluck('nilai_kriteria', 'alternatif_id');
                
                $cMax = $nilaiKriteria->max();
                $cMin = $nilaiKriteria->min();
                
                // Normalisasi bobot
                $bobotNormalisasi = $totalBobot > 0 ? ($k->bobot / $totalBobot) : 0;
                
                // Hitung utility untuk setiap alternatif
                foreach ($alternatif as $alt) {
                    $penilaian = Penilaian::where('alternatif_id', $alt->id)
                        ->where('kriteria_id', $k->id)
                        ->first();
                    
                    if ($penilaian) {
                        $cOut = $penilaian->nilai_kriteria;
                        
                        // Hitung utility berdasarkan jenis kriteria
                        if ($cMax == $cMin) {
                            // Jika semua nilai sama
                            $utility = 1;
                        } else {
                            if ($k->jenis_kriteria == 'benefit') {
                                // Benefit: semakin tinggi semakin baik
                                $utility = ($cOut - $cMin) / ($cMax - $cMin);
                            } else {
                                // Cost: semakin rendah semakin baik
                                $utility = ($cMax - $cOut) / ($cMax - $cMin);
                            }
                        }
                        
                        // Hitung nilai akhir
                        $nilaiAkhir = $utility * $bobotNormalisasi;
                        
                        // Simpan ke tabel perhitungan
                        Perhitungan::create([
                            'alternatif_id' => $alt->id,
                            'kriteria_id' => $k->id,
                            'nilai_utility' => $utility,
                            'bobot_kriteria' => $bobotNormalisasi,
                            'nilai_akhir' => $nilaiAkhir
                        ]);
                    }
                }
            }
            
            DB::commit();
            
            return redirect()->route('perhitungan.index')
                ->with('success', 'Perhitungan metode SMART berhasil diproses!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Detail perhitungan per alternatif
     */
    public function detail($alternatifId)
    {
        $alternatif = Alternatif::with(['perhitungan.kriteria', 'penilaian.kriteria', 'penilaian.subKriteria'])
            ->findOrFail($alternatifId);
        
        // Hitung total nilai SMART
        $totalNilai = Perhitungan::where('alternatif_id', $alternatifId)->sum('nilai_akhir');
        
        return view('perhitungan.detail', compact('alternatif', 'totalNilai'));
    }

    /**
     * Reset perhitungan
     */
    public function reset()
    {
        try {
            Perhitungan::truncate();
            
            return redirect()->route('perhitungan.index')
                ->with('success', 'Data perhitungan berhasil direset!');
                
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Lihat detail rumus perhitungan
     */
    public function rumus()
    {
        $kriteria = Kriteria::all();
        $totalBobot = $kriteria->sum('bobot');
        
        return view('perhitungan.rumus', compact('kriteria', 'totalBobot'));
    }
}
