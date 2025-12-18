<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\Supplier;
use App\Models\Penilaian;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKriteria = Kriteria::count();
        $totalSupplier = Supplier::count();
        $totalPenilaian = Penilaian::count();

        return view('dashboard', compact('totalKriteria', 'totalSupplier', 'totalPenilaian'));
    }
}
