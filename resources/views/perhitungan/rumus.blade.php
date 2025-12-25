@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">
                        <i class="fas fa-book"></i> Rumus Metode SMART (Simple Multi Attribute Rating Technique)
                    </h3>
                </div>
                <div class="card-body">
                    
                    <!-- Step 1 -->
                    <div class="card mb-3">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">Step 1: Normalisasi Bobot Kriteria</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Rumus:</strong></p>
                            <div class="alert alert-light border">
                                <h5 class="text-center">Wj = wj / Σwj</h5>
                            </div>
                            <p><strong>Keterangan:</strong></p>
                            <ul>
                                <li><strong>Wj</strong> = Bobot ternormalisasi kriteria ke-j</li>
                                <li><strong>wj</strong> = Bobot kriteria ke-j</li>
                                <li><strong>Σwj</strong> = Total semua bobot kriteria</li>
                            </ul>
                            
                            <p><strong>Contoh Perhitungan dengan Data Saat Ini:</strong></p>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Kode</th>
                                            <th>Kriteria</th>
                                            <th>Bobot (wj)</th>
                                            <th>Bobot Normalisasi (Wj)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kriteria as $k)
                                        <tr>
                                            <td>{{ $k->kode_kriteria }}</td>
                                            <td>{{ $k->nama_kriteria }}</td>
                                            <td>{{ $k->bobot }}</td>
                                            <td>
                                                {{ $k->bobot }} / {{ $totalBobot }} = 
                                                <strong>{{ number_format($k->bobot / $totalBobot, 4) }}</strong>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="bg-light">
                                        <tr>
                                            <th colspan="2">Total</th>
                                            <th>{{ $totalBobot }}</th>
                                            <th>{{ number_format($kriteria->sum(function($k) use ($totalBobot) { return $k->bobot / $totalBobot; }), 4) }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="card mb-3">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">Step 2: Hitung Nilai Utility (Normalisasi 0-1)</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-success">Untuk Kriteria BENEFIT (Semakin Tinggi Semakin Baik):</h6>
                                    <div class="alert alert-light border">
                                        <h5 class="text-center">ui(ai) = (Cout - Cmin) / (Cmax - Cmin)</h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-warning">Untuk Kriteria COST (Semakin Rendah Semakin Baik):</h6>
                                    <div class="alert alert-light border">
                                        <h5 class="text-center">ui(ai) = (Cmax - Cout) / (Cmax - Cmin)</h5>
                                    </div>
                                </div>
                            </div>
                            
                            <p><strong>Keterangan:</strong></p>
                            <ul>
                                <li><strong>ui(ai)</strong> = Nilai utility alternatif i pada kriteria ke-j</li>
                                <li><strong>Cout</strong> = Nilai kriteria untuk alternatif yang sedang dihitung</li>
                                <li><strong>Cmax</strong> = Nilai maksimum dari kriteria tersebut (dari semua alternatif)</li>
                                <li><strong>Cmin</strong> = Nilai minimum dari kriteria tersebut (dari semua alternatif)</li>
                            </ul>

                            <p><strong>Contoh Perhitungan:</strong></p>
                            <div class="alert alert-warning">
                                <strong>Kriteria Harga (COST):</strong><br>
                                Alternatif A = Rp 6.000.000, Alternatif B = Rp 5.500.000, Alternatif C = Rp 7.000.000<br>
                                Cmax = 7.000.000, Cmin = 5.500.000<br><br>
                                <strong>Utility A:</strong> (7.000.000 - 6.000.000) / (7.000.000 - 5.500.000) = 1.000.000 / 1.500.000 = <strong>0.6667</strong><br>
                                <strong>Utility B:</strong> (7.000.000 - 5.500.000) / (7.000.000 - 5.500.000) = 1.500.000 / 1.500.000 = <strong>1.0000</strong><br>
                                <strong>Utility C:</strong> (7.000.000 - 7.000.000) / (7.000.000 - 5.500.000) = 0 / 1.500.000 = <strong>0.0000</strong>
                            </div>

                            <div class="alert alert-success">
                                <strong>Kriteria Kualitas (BENEFIT):</strong><br>
                                Alternatif A = 75, Alternatif B = 100, Alternatif C = 50<br>
                                Cmax = 100, Cmin = 50<br><br>
                                <strong>Utility A:</strong> (75 - 50) / (100 - 50) = 25 / 50 = <strong>0.5000</strong><br>
                                <strong>Utility B:</strong> (100 - 50) / (100 - 50) = 50 / 50 = <strong>1.0000</strong><br>
                                <strong>Utility C:</strong> (50 - 50) / (100 - 50) = 0 / 50 = <strong>0.0000</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="card mb-3">
                        <div class="card-header bg-warning">
                            <h5 class="mb-0">Step 3: Hitung Nilai Akhir per Kriteria</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Rumus:</strong></p>
                            <div class="alert alert-light border">
                                <h5 class="text-center">Nilai Akhir = ui(ai) × Wj</h5>
                            </div>
                            <p><strong>Contoh:</strong></p>
                            <p>Jika Utility Alternatif A pada Kriteria Harga = 0.6667 dan Bobot Normalisasi = 0.25, maka:</p>
                            <div class="alert alert-info">
                                Nilai Akhir = 0.6667 × 0.25 = <strong>0.1667</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="card mb-3">
                        <div class="card-header bg-danger text-white">
                            <h5 class="mb-0">Step 4: Hitung Total Nilai SMART</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Rumus:</strong></p>
                            <div class="alert alert-light border">
                                <h5 class="text-center">Total Nilai SMART = Σ(ui(ai) × Wj)</h5>
                            </div>
                            <p>Jumlahkan semua nilai akhir dari semua kriteria untuk mendapatkan total nilai SMART.</p>
                            
                            <p><strong>Contoh untuk Alternatif A:</strong></p>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Kriteria</th>
                                            <th>Utility (ui)</th>
                                            <th>Bobot (Wj)</th>
                                            <th>Nilai Akhir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Harga</td>
                                            <td>0.6667</td>
                                            <td>0.25</td>
                                            <td>0.1667</td>
                                        </tr>
                                        <tr>
                                            <td>Kualitas</td>
                                            <td>0.5000</td>
                                            <td>0.30</td>
                                            <td>0.1500</td>
                                        </tr>
                                        <tr>
                                            <td>Pelayanan</td>
                                            <td>0.7500</td>
                                            <td>0.20</td>
                                            <td>0.1500</td>
                                        </tr>
                                        <tr>
                                            <td>Pengiriman</td>
                                            <td>1.0000</td>
                                            <td>0.15</td>
                                            <td>0.1500</td>
                                        </tr>
                                        <tr>
                                            <td>Garansi</td>
                                            <td>0.5000</td>
                                            <td>0.10</td>
                                            <td>0.0500</td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="bg-light">
                                        <tr>
                                            <th colspan="3">Total Nilai SMART</th>
                                            <th><strong>0.6667</strong></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Step 5 -->
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0">Step 5: Ranking</h5>
                        </div>
                        <div class="card-body">
                            <p>Setelah mendapatkan total nilai SMART untuk semua alternatif, urutkan dari nilai tertinggi ke terendah.</p>
                            <p><strong>Alternatif dengan nilai SMART tertinggi adalah supplier terbaik.</strong></p>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <a href="{{ route('perhitungan.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali ke Perhitungan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
