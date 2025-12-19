<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::latest()->get();
        return view('supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_supplier' => 'required|unique:suppliers|max:10',
            'nama_supplier' => 'required|max:255',
            'nama_perusahaan' => 'nullable|max:255',
            'alamat' => 'nullable',
            'kota' => 'nullable|max:100',
            'telepon' => 'nullable|max:20',
            'email' => 'nullable|email',
            'kontak_person' => 'nullable|max:100',
            'keterangan' => 'nullable',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        Supplier::create($validated);

        return redirect()->route('supplier.index')
                         ->with('success', 'Data supplier berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('supplier.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $supplier = Supplier::findOrFail($id);

        $validated = $request->validate([
            'kode_supplier' => 'required|max:10|unique:suppliers,kode_supplier,'.$id,
            'nama_supplier' => 'required|max:255',
            'nama_perusahaan' => 'nullable|max:255',
            'alamat' => 'nullable',
            'kota' => 'nullable|max:100',
            'telepon' => 'nullable|max:20',
            'email' => 'nullable|email',
            'kontak_person' => 'nullable|max:100',
            'keterangan' => 'nullable',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        $supplier->update($validated);

        return redirect()->route('supplier.index')
                         ->with('success', 'Data supplier berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('supplier.index')
                         ->with('success', 'Data supplier berhasil dihapus!');
    }
}
