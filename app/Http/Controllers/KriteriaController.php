<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kriteria = Kriteria::all();
        return view('kriteria.index', compact('kriteria'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kriteria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_kriteria' => 'required|unique:kriteria|max:10',
            'nama_kriteria' => 'required|max:255',
            'jenis_kriteria' => 'required|in:benefit,cost',
            'bobot' => 'required|numeric|min:0|max:100',
            'keterangan' => 'nullable'
        ]);

        Kriteria::create($validated);

        return redirect()->route('kriteria.index')
                         ->with('success', 'Kriteria berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kriteria = Kriteria::findOrFail($id);
        return view('kriteria.show', compact('kriteria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kriteria = Kriteria::findOrFail($id);
        return view('kriteria.edit', compact('kriteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kriteria = Kriteria::findOrFail($id);

        $validated = $request->validate([
            'kode_kriteria' => 'required|max:10|unique:kriteria,kode_kriteria,'.$id,
            'nama_kriteria' => 'required|max:255',
            'jenis_kriteria' => 'required|in:benefit,cost',
            'bobot' => 'required|numeric|min:0|max:100',
            'keterangan' => 'nullable'
        ]);

        $kriteria->update($validated);

        return redirect()->route('kriteria.index')
                         ->with('success', 'Kriteria berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kriteria = Kriteria::findOrFail($id);
        $kriteria->delete();

        return redirect()->route('kriteria.index')
                         ->with('success', 'Kriteria berhasil dihapus!');
    }
}
