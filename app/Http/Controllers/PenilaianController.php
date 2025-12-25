<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alternatif = Alternatif::with(['penilaian.kriteria', 'penilaian.subKriteria'])->get();
        $kriteria = Kriteria::all();
        
        return view('penilaian.index', compact('alternatif', 'kriteria'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $alternatif = Alternatif::all();
        $kriteria = Kriteria::with('subKriteria')->get();
        
        return view('penilaian.create', compact('alternatif', 'kriteria'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'alternatif_id' => 'required|exists:alternatif,id',
            'kriteria_id' => 'required|exists:kriteria,id',
            'sub_kriteria_id' => 'required|exists:sub_kriteria,id'
        ]);

        // Cek apakah penilaian untuk alternatif dan kriteria ini sudah ada
        $existing = Penilaian::where('alternatif_id', $validated['alternatif_id'])
                             ->where('kriteria_id', $validated['kriteria_id'])
                             ->first();

        if ($existing) {
            return redirect()->back()
                           ->with('error', 'Penilaian untuk alternatif dan kriteria ini sudah ada! Silakan edit data yang ada.');
        }

        // Ambil nilai dari sub kriteria
        $subKriteria = SubKriteria::find($validated['sub_kriteria_id']);
        $validated['nilai_kriteria'] = $subKriteria->nilai;

        Penilaian::create($validated);

        return redirect()->route('penilaian.index')
                         ->with('success', 'Penilaian berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $alternatif = Alternatif::with(['penilaian.kriteria', 'penilaian.subKriteria'])->findOrFail($id);
        return view('penilaian.show', compact('alternatif'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $penilaian = Penilaian::with(['alternatif', 'kriteria.subKriteria'])->findOrFail($id);
        $subKriteria = SubKriteria::where('kriteria_id', $penilaian->kriteria_id)->get();
        
        return view('penilaian.edit', compact('penilaian', 'subKriteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $penilaian = Penilaian::findOrFail($id);

        $validated = $request->validate([
            'sub_kriteria_id' => 'required|exists:sub_kriteria,id'
        ]);

        // Ambil nilai dari sub kriteria
        $subKriteria = SubKriteria::find($validated['sub_kriteria_id']);
        $validated['nilai_kriteria'] = $subKriteria->nilai;

        $penilaian->update($validated);

        return redirect()->route('penilaian.index')
                         ->with('success', 'Penilaian berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penilaian = Penilaian::findOrFail($id);
        $penilaian->delete();

        return redirect()->route('penilaian.index')
                         ->with('success', 'Penilaian berhasil dihapus!');
    }

    /**
     * Get sub kriteria by kriteria (untuk AJAX)
     */
    public function getSubKriteria($kriteriaId)
    {
        $subKriteria = SubKriteria::where('kriteria_id', $kriteriaId)->get();
        return response()->json($subKriteria);
    }

    /**
     * Penilaian per alternatif
     */
    public function penilaianAlternatif($alternatifId)
    {
        $alternatif = Alternatif::findOrFail($alternatifId);
        $kriteria = Kriteria::with('subKriteria')->get();
        $penilaian = Penilaian::where('alternatif_id', $alternatifId)->get()->keyBy('kriteria_id');
        
        return view('penilaian.alternatif', compact('alternatif', 'kriteria', 'penilaian'));
    }

    /**
     * Save penilaian per alternatif
     */
    public function savePenilaianAlternatif(Request $request, $alternatifId)
    {
        $alternatif = Alternatif::findOrFail($alternatifId);
        
        $validated = $request->validate([
            'penilaian' => 'required|array',
            'penilaian.*' => 'required|exists:sub_kriteria,id'
        ]);

        foreach ($validated['penilaian'] as $kriteriaId => $subKriteriaId) {
            $subKriteria = SubKriteria::find($subKriteriaId);
            
            Penilaian::updateOrCreate(
                [
                    'alternatif_id' => $alternatifId,
                    'kriteria_id' => $kriteriaId
                ],
                [
                    'sub_kriteria_id' => $subKriteriaId,
                    'nilai_kriteria' => $subKriteria->nilai
                ]
            );
        }

        return redirect()->route('penilaian.index')
                         ->with('success', 'Penilaian untuk ' . $alternatif->nama_supplier . ' berhasil disimpan!');
    }
}
