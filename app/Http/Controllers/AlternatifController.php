<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alternatif = Alternatif::latest()->get();
        return view('alternatif.index', compact('alternatif'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Generate kode alternatif otomatis
        $lastAlternatif = Alternatif::latest()->first();
        $lastNumber = $lastAlternatif ? (int)substr($lastAlternatif->kode_alternatif, 1) : 0;
        $nextNumber = $lastNumber + 1;
        $kodeAlternatif = 'A' . $nextNumber;
        
        return view('alternatif.create', compact('kodeAlternatif'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_alternatif' => 'required|unique:alternatif|max:10',
            'nama_supplier' => 'required|max:255',
            'alamat' => 'nullable',
            'telepon' => 'nullable|max:20',
            'email' => 'nullable|email|max:255',
            'keterangan' => 'nullable'
        ]);

        Alternatif::create($validated);

        return redirect()->route('alternatif.index')
                         ->with('success', 'Alternatif berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $alternatif = Alternatif::with('penilaian.kriteria', 'penilaian.subKriteria')->findOrFail($id);
        return view('alternatif.show', compact('alternatif'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $alternatif = Alternatif::findOrFail($id);
        return view('alternatif.edit', compact('alternatif'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $alternatif = Alternatif::findOrFail($id);

        $validated = $request->validate([
            'kode_alternatif' => 'required|max:10|unique:alternatif,kode_alternatif,'.$id,
            'nama_supplier' => 'required|max:255',
            'alamat' => 'nullable',
            'telepon' => 'nullable|max:20',
            'email' => 'nullable|email|max:255',
            'keterangan' => 'nullable'
        ]);

        $alternatif->update($validated);

        return redirect()->route('alternatif.index')
                         ->with('success', 'Alternatif berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $alternatif = Alternatif::findOrFail($id);
        $alternatif->delete();

        return redirect()->route('alternatif.index')
                         ->with('success', 'Alternatif berhasil dihapus!');
    }
}
