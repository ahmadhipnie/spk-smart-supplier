<?php

namespace App\Http\Controllers;

use App\Models\SubKriteria;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class SubKriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subKriteria = SubKriteria::with('kriteria')->latest()->get();
        return view('sub-kriteria.index', compact('subKriteria'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kriteria = Kriteria::all();
        return view('sub-kriteria.create', compact('kriteria'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kriteria_id' => 'required|exists:kriteria,id',
            'nama_sub_kriteria' => 'required|max:255',
            'nilai' => 'required|numeric|min:0|max:100',
            'keterangan' => 'nullable'
        ]);

        SubKriteria::create($validated);

        return redirect()->route('sub-kriteria.index')
                         ->with('success', 'Sub kriteria berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subKriteria = SubKriteria::with('kriteria')->findOrFail($id);
        return view('sub-kriteria.show', compact('subKriteria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subKriteria = SubKriteria::findOrFail($id);
        $kriteria = Kriteria::all();
        return view('sub-kriteria.edit', compact('subKriteria', 'kriteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subKriteria = SubKriteria::findOrFail($id);

        $validated = $request->validate([
            'kriteria_id' => 'required|exists:kriteria,id',
            'nama_sub_kriteria' => 'required|max:255',
            'nilai' => 'required|numeric|min:0|max:100',
            'keterangan' => 'nullable'
        ]);

        $subKriteria->update($validated);

        return redirect()->route('sub-kriteria.index')
                         ->with('success', 'Sub kriteria berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subKriteria = SubKriteria::findOrFail($id);
        $subKriteria->delete();

        return redirect()->route('sub-kriteria.index')
                         ->with('success', 'Sub kriteria berhasil dihapus!');
    }
}
