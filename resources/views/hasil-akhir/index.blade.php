@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Hasil Akhir Pemilihan Supplier Terbaik</h3>
                    <div class="card-tools">
                        @if($hasHasil)
                            <a href="{{ route('hasil-akhir.perbandingan') }}" class="btn btn-info btn-sm">
                                <i class="fas fa-chart-bar"></i> Perbandingan
                            </a>
                            <a href="{{ route('hasil-akhir.export-pdf') }}" class="btn btn-danger btn-sm">
                                <i class="fas fa-file-pdf"></i> Preview PDF
                            </a>
                            <form action="{{ route('hasil-akhir.reset') }}" method="POST" class="d-inline" 
                                  onsubmit="return confirm('Yakin ingin mereset hasil akhir?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-warning btn-sm">
                                    <i class="fas fa-redo"></i> Reset
                                </button>
                            </form>
                        @endif
                        <form action="{{ route('hasil-akhir.generate') }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Generate hasil akhir dan ranking?\n\nData hasil akhir lama akan ditimpa.')">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm" {{ !$hasPerhitungan ? 'disabled' : '' }}>
                                <i class="fas fa-trophy"></i> {{ $hasHasil ? 'Generate Ulang' : 'Generate Hasil' }}
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(!$hasPerhitungan)
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i> 
                            <strong>Perhatian:</strong> Belum ada data perhitungan. Silakan proses perhitungan terlebih dahulu di menu <strong>Data Perhitungan</strong>.
                        </div>
                    @endif

                    @if(!$hasHasil && $hasPerhitungan)
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> 
                            <strong>Info:</strong> Klik tombol <strong>"Generate Hasil"</strong> untuk membuat ranking supplier berdasarkan hasil perhitungan SMART.
                        </div>
                    @endif

                    @if($hasHasil)
                        <div class="alert alert-success">
                            <i class="fas fa-trophy"></i> 
                            <strong>Supplier Terbaik:</strong> 
                            {{ $hasilAkhir->first()->alternatif->nama_supplier }} 
                            dengan nilai SMART <strong>{{ number_format($hasilAkhir->first()->total_nilai, 4) }}</strong>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="10%" class="text-center">Ranking</th>
                                        <th width="12%">Kode</th>
                                        <th>Nama Supplier</th>
                                        <th width="15%" class="text-center">Total Nilai SMART</th>
                                        <th width="12%" class="text-center">Tanggal</th>
                                        <th width="12%" class="text-center">Status</th>
                                        <th width="10%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($hasilAkhir as $hasil)
                                    <tr class="{{ $hasil->ranking == 1 ? 'table-success' : '' }}">
                                        <td class="text-center">
                                            @if($hasil->ranking == 1)
                                                <span class="badge badge-warning" style="font-size: 1.2em;">
                                                    <i class="fas fa-trophy"></i> #{{ $hasil->ranking }}
                                                </span>
                                            @elseif($hasil->ranking == 2)
                                                <span class="badge badge-secondary" style="font-size: 1.1em;">
                                                    <i class="fas fa-medal"></i> #{{ $hasil->ranking }}
                                                </span>
                                            @elseif($hasil->ranking == 3)
                                                <span class="badge badge-info" style="font-size: 1.1em;">
                                                    <i class="fas fa-medal"></i> #{{ $hasil->ranking }}
                                                </span>
                                            @else
                                                <span class="badge badge-dark" style="font-size: 1em;">
                                                    #{{ $hasil->ranking }}
                                                </span>
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
                                            <h5 class="mb-0">
                                                <span class="badge badge-{{ $hasil->ranking == 1 ? 'success' : 'primary' }}" style="font-size: 1.1em;">
                                                    {{ number_format($hasil->total_nilai, 4) }}
                                                </span>
                                            </h5>
                                        </td>
                                        <td class="text-center">
                                            <small>{{ $hasil->tanggal_perhitungan->format('d/m/Y') }}</small>
                                        </td>
                                        <td class="text-center">
                                            @if($hasil->ranking <= 3)
                                                <span class="badge badge-success" style="font-size: 0.9rem; padding: 0.5rem 0.8rem;">
                                                    <i class="fas fa-check-circle"></i> Direkomendasikan
                                                </span>
                                            @else
                                                <span class="badge badge-secondary" style="font-size: 0.9rem; padding: 0.5rem 0.8rem;">
                                                    <i class="fas fa-info-circle"></i> Standar
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('hasil-akhir.detail', $hasil->id) }}" 
                                               class="btn btn-info btn-sm" 
                                               title="Lihat Detail">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Statistik -->
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="card border-success">
                                    <div class="card-body text-center">
                                        <div class="mb-2">
                                            <i class="fas fa-trophy fa-3x text-success"></i>
                                        </div>
                                        <h6 class="text-muted mb-1">Supplier Terbaik</h6>
                                        <h5 class="text-success mb-0">
                                            <strong>{{ $hasilAkhir->first()->alternatif->nama_supplier }}</strong>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-info">
                                    <div class="card-body text-center">
                                        <div class="mb-2">
                                            <i class="fas fa-star fa-3x text-info"></i>
                                        </div>
                                        <h6 class="text-muted mb-1">Nilai Tertinggi</h6>
                                        <h5 class="text-info mb-0">
                                            <strong>{{ number_format($hasilAkhir->first()->total_nilai, 4) }}</strong>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-warning">
                                    <div class="card-body text-center">
                                        <div class="mb-2">
                                            <i class="fas fa-users fa-3x text-warning"></i>
                                        </div>
                                        <h6 class="text-muted mb-1">Total Alternatif</h6>
                                        <h5 class="text-warning mb-0">
                                            <strong>{{ $hasilAkhir->count() }}</strong>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-trophy fa-5x text-muted mb-3"></i>
                            <h4 class="text-muted">Belum Ada Hasil Akhir</h4>
                            <p>Silakan generate hasil akhir untuk melihat ranking supplier terbaik</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
