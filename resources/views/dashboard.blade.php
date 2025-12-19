@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-tachometer-alt"></i> Dashboard SPK SMART</h1>
    
    <!-- Alert Selamat Datang -->
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong><i class="fas fa-info-circle"></i> Selamat datang!</strong> Sistem Pendukung Keputusan Pemilihan Supplier Terbaik menggunakan Metode SMART
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    
    <!-- Card Statistik Utama -->
    <div class="row">
        <!-- Total Kriteria -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Kriteria</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalKriteria }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-database fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Total Supplier -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Supplier</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalSupplier }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Total Penilaian -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Penilaian</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPenilaian }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-edit fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Kelengkapan Data -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Kelengkapan Data</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $kelengkapanPenilaian }}%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-warning" role="progressbar" 
                                             style="width: {{ $kelengkapanPenilaian }}%" 
                                             aria-valuenow="{{ $kelengkapanPenilaian }}" 
                                             aria-valuemin="0" 
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <!-- Grafik Distribusi Kriteria -->
        <div class="col-xl-4 col-lg-5 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Distribusi Jenis Kriteria</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2" style="height: 200px;">
                        <canvas id="kriteriaPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Benefit ({{ $kriteriaBenefit }})
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-warning"></i> Cost ({{ $kriteriaCost }})
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Grafik Bobot Kriteria -->
        <div class="col-xl-8 col-lg-7 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Bobot Kriteria</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar" style="height: 250px;">
                        <canvas id="kriteriaBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Ranking Supplier Terbaik -->
    @if($hasHasil && $topSuppliers->count() > 0)
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">
                        <i class="fas fa-trophy"></i> Top 5 Supplier Terbaik
                    </h6>
                </div>
                <div class="card-body">
                    @if($supplierTerbaik)
                    <div class="alert alert-success mb-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <strong><i class="fas fa-award"></i> Supplier Terbaik:</strong> 
                                {{ $supplierTerbaik->alternatif->nama_supplier }}
                            </div>
                            <div class="col-auto">
                                <span class="badge badge-success" style="font-size: 1.1rem;">
                                    Nilai SMART: {{ number_format($supplierTerbaik->total_nilai, 4) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th width="10%" class="text-center">Ranking</th>
                                    <th width="15%">Kode</th>
                                    <th>Nama Supplier</th>
                                    <th width="20%" class="text-center">Nilai SMART</th>
                                    <th width="15%" class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($topSuppliers as $hasil)
                                <tr class="{{ $hasil->ranking == 1 ? 'table-success' : '' }}">
                                    <td class="text-center">
                                        @if($hasil->ranking == 1)
                                            <span class="badge badge-warning" style="font-size: 1.1em;">
                                                <i class="fas fa-trophy"></i> #{{ $hasil->ranking }}
                                            </span>
                                        @elseif($hasil->ranking == 2)
                                            <span class="badge badge-secondary" style="font-size: 1em;">
                                                <i class="fas fa-medal"></i> #{{ $hasil->ranking }}
                                            </span>
                                        @elseif($hasil->ranking == 3)
                                            <span class="badge badge-info" style="font-size: 1em;">
                                                <i class="fas fa-medal"></i> #{{ $hasil->ranking }}
                                            </span>
                                        @else
                                            <span class="badge badge-dark">#{{ $hasil->ranking }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-primary">{{ $hasil->alternatif->kode_alternatif }}</span>
                                    </td>
                                    <td>
                                        <strong>{{ $hasil->alternatif->nama_supplier }}</strong>
                                        @if($hasil->ranking == 1)
                                            <span class="badge badge-success ml-2">TERBAIK</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-{{ $hasil->ranking == 1 ? 'success' : 'primary' }}" style="font-size: 1em;">
                                            {{ number_format($hasil->total_nilai, 4) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @if($hasil->ranking <= 3)
                                            <span class="badge badge-success">
                                                <i class="fas fa-check-circle"></i> Direkomendasikan
                                            </span>
                                        @else
                                            <span class="badge badge-secondary">
                                                <i class="fas fa-info-circle"></i> Standar
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="text-center mt-3">
                        <a href="{{ route('hasil-akhir.index') }}" class="btn btn-primary">
                            <i class="fas fa-list"></i> Lihat Semua Hasil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card shadow border-left-warning">
                <div class="card-body">
                    <div class="text-center py-4">
                        <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                        <h5 class="text-warning">Belum Ada Hasil Perhitungan</h5>
                        <p class="text-muted mb-3">Silakan lakukan perhitungan dan generate hasil untuk melihat ranking supplier terbaik</p>
                        <a href="{{ route('perhitungan.index') }}" class="btn btn-primary">
                            <i class="fas fa-calculator"></i> Mulai Perhitungan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    
    <!-- Status Sistem -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-tasks"></i> Status Proses
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span><i class="fas fa-check-circle text-{{ $totalKriteria > 0 ? 'success' : 'secondary' }}"></i> Input Kriteria</span>
                            <span class="badge badge-{{ $totalKriteria > 0 ? 'success' : 'secondary' }}">{{ $totalKriteria > 0 ? 'Selesai' : 'Belum' }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span><i class="fas fa-check-circle text-{{ $totalSupplier > 0 ? 'success' : 'secondary' }}"></i> Input Supplier</span>
                            <span class="badge badge-{{ $totalSupplier > 0 ? 'success' : 'secondary' }}">{{ $totalSupplier > 0 ? 'Selesai' : 'Belum' }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span><i class="fas fa-check-circle text-{{ $kelengkapanPenilaian >= 100 ? 'success' : 'warning' }}"></i> Penilaian</span>
                            <span class="badge badge-{{ $kelengkapanPenilaian >= 100 ? 'success' : 'warning' }}">{{ $kelengkapanPenilaian }}%</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span><i class="fas fa-check-circle text-{{ $hasPerhitungan ? 'success' : 'secondary' }}"></i> Perhitungan SMART</span>
                            <span class="badge badge-{{ $hasPerhitungan ? 'success' : 'secondary' }}">{{ $hasPerhitungan ? 'Selesai' : 'Belum' }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span><i class="fas fa-check-circle text-{{ $hasHasil ? 'success' : 'secondary' }}"></i> Hasil & Ranking</span>
                            <span class="badge badge-{{ $hasHasil ? 'success' : 'secondary' }}">{{ $hasHasil ? 'Selesai' : 'Belum' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-book"></i> Tentang Metode SMART
                    </h6>
                </div>
                <div class="card-body">
                    <p class="mb-2">
                        <strong>SMART</strong> (Simple Multi Attribute Rating Technique) adalah metode pengambilan keputusan multi kriteria.
                    </p>
                    <p class="mb-2"><strong>Tahapan Metode SMART:</strong></p>
                    <ol class="mb-0 small">
                        <li>Normalisasi bobot kriteria</li>
                        <li>Hitung nilai utility (0-1)</li>
                        <li>Hitung nilai akhir per kriteria</li>
                        <li>Jumlahkan untuk mendapat total nilai</li>
                        <li>Ranking berdasarkan nilai tertinggi</li>
                    </ol>
                    <div class="mt-3">
                        <a href="{{ route('perhitungan.rumus') }}" class="btn btn-sm btn-info">
                            <i class="fas fa-calculator"></i> Lihat Rumus
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
// Pie Chart - Distribusi Kriteria
var ctxPie = document.getElementById('kriteriaPieChart').getContext('2d');
var kriteriaPieChart = new Chart(ctxPie, {
    type: 'doughnut',
    data: {
        labels: ['Benefit', 'Cost'],
        datasets: [{
            data: [{{ $kriteriaBenefit }}, {{ $kriteriaCost }}],
            backgroundColor: ['#28a745', '#ffc107'],
            hoverBackgroundColor: ['#218838', '#e0a800'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
    },
    options: {
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                backgroundColor: "rgb(255,255,255)",
                bodyColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                displayColors: false,
                caretPadding: 10,
            }
        },
        cutout: '70%',
    },
});

// Bar Chart - Bobot Kriteria
var ctxBar = document.getElementById('kriteriaBarChart').getContext('2d');
var kriteriaBarChart = new Chart(ctxBar, {
    type: 'bar',
    data: {
        labels: [@foreach($kriteriaData as $k)'{{ $k->kode_kriteria }}',@endforeach],
        datasets: [{
            label: 'Bobot (%)',
            data: [@foreach($kriteriaData as $k){{ $k->bobot }},@endforeach],
            backgroundColor: '#4e73df',
            hoverBackgroundColor: '#2e59d9',
            borderColor: '#4e73df',
        }]
    },
    options: {
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return value + '%';
                    }
                }
            }
        },
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return 'Bobot: ' + context.parsed.y + '%';
                    }
                }
            }
        }
    }
});
</script>
@endpush
@endsection
