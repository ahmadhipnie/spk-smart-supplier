@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Perhitungan Metode SMART</h3>
                    <div class="card-tools">
                        <a href="{{ route('perhitungan.rumus') }}" class="btn btn-info btn-sm" target="_blank">
                            <i class="fas fa-calculator"></i> Lihat Rumus
                        </a>
                        @if($hasPerhitungan)
                            <form action="{{ route('perhitungan.reset') }}" method="POST" class="d-inline" 
                                  onsubmit="return confirm('Yakin ingin mereset perhitungan? Data perhitungan lama akan dihapus!')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-warning btn-sm">
                                    <i class="fas fa-redo"></i> Reset
                                </button>
                            </form>
                        @endif
                        <form action="{{ route('perhitungan.proses') }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Proses perhitungan metode SMART?\n\nPerhitungan lama akan ditimpa dengan data baru.')">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-cogs"></i> {{ $hasPerhitungan ? 'Hitung Ulang' : 'Proses Perhitungan' }}
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
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> 
                            <strong>Info:</strong> Belum ada data perhitungan. Klik tombol <strong>"Proses Perhitungan"</strong> untuk menghitung nilai SMART.
                        </div>
                    @endif

                    <div class="mb-3">
                        <h5>Tahapan Perhitungan Metode SMART:</h5>
                        <ol>
                            <li>Normalisasi bobot kriteria (Wj = wj / Σwj)</li>
                            <li>Hitung nilai utility (normalisasi nilai 0-1)</li>
                            <li>Hitung nilai akhir per kriteria (ui × Wj)</li>
                            <li>Jumlahkan total nilai untuk ranking</li>
                        </ol>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th rowspan="2" width="5%" class="align-middle text-center">No</th>
                                    <th rowspan="2" class="align-middle">Alternatif</th>
                                    <th colspan="{{ $kriteria->count() }}" class="text-center">Nilai Utility (Normalisasi)</th>
                                    <th colspan="{{ $kriteria->count() }}" class="text-center">Nilai Akhir (Utility × Bobot)</th>
                                    <th rowspan="2" width="10%" class="align-middle text-center">Aksi</th>
                                </tr>
                                <tr>
                                    @foreach($kriteria as $k)
                                    <th class="text-center" title="{{ $k->nama_kriteria }}">
                                        {{ $k->kode_kriteria }}<br>
                                        <small>({{ $k->bobot }}%)</small>
                                    </th>
                                    @endforeach
                                    @foreach($kriteria as $k)
                                    <th class="text-center" title="{{ $k->nama_kriteria }}">
                                        {{ $k->kode_kriteria }}
                                    </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($alternatif as $key => $alt)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td>
                                        <strong>{{ $alt->kode_alternatif }}</strong><br>
                                        <small>{{ $alt->nama_supplier }}</small>
                                    </td>
                                    
                                    <!-- Nilai Utility -->
                                    @foreach($kriteria as $k)
                                        @php
                                            $perhitungan = $alt->perhitungan->where('kriteria_id', $k->id)->first();
                                        @endphp
                                        <td class="text-center">
                                            @if($perhitungan)
                                                <span class="badge badge-info">
                                                    {{ number_format($perhitungan->nilai_utility, 4) }}
                                                </span>
                                            @else
                                                <span class="badge badge-secondary">-</span>
                                            @endif
                                        </td>
                                    @endforeach
                                    
                                    <!-- Nilai Akhir -->
                                    @foreach($kriteria as $k)
                                        @php
                                            $perhitungan = $alt->perhitungan->where('kriteria_id', $k->id)->first();
                                        @endphp
                                        <td class="text-center">
                                            @if($perhitungan)
                                                <span class="badge badge-success">
                                                    {{ number_format($perhitungan->nilai_akhir, 4) }}
                                                </span>
                                            @else
                                                <span class="badge badge-secondary">-</span>
                                            @endif
                                        </td>
                                    @endforeach
                                    
                                    <td class="text-center">
                                        <a href="{{ route('perhitungan.detail', $alt->id) }}" 
                                           class="btn btn-info btn-sm" 
                                           title="Lihat Detail">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="{{ 3 + ($kriteria->count() * 2) }}" class="text-center">
                                        Belum ada data alternatif atau perhitungan.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <small class="text-muted">
                        <i class="fas fa-info-circle"></i> 
                        Nilai Utility: hasil normalisasi nilai (0-1) | 
                        Nilai Akhir: hasil perkalian utility dengan bobot normalisasi
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
