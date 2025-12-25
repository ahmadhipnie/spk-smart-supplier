@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Perhitungan SMART</h3>
                    <div class="card-tools">
                        <a href="{{ route('perhitungan.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Informasi Alternatif -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="text-primary">
                                <i class="fas fa-user"></i> Informasi Alternatif
                            </h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="35%">Kode</th>
                                    <td>: <span class="badge badge-primary">{{ $alternatif->kode_alternatif }}</span></td>
                                </tr>
                                <tr>
                                    <th>Nama Supplier</th>
                                    <td>: <strong>{{ $alternatif->nama_supplier }}</strong></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>: {{ $alternatif->alamat ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-success">
                                <div class="card-body text-center">
                                    <h6 class="text-success mb-2">
                                        <i class="fas fa-trophy"></i> Total Nilai SMART
                                    </h6>
                                    <h3 class="text-success mb-0">
                                        <strong>{{ number_format($totalNilai, 4) }}</strong>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Perhitungan per Kriteria -->
                    <h5 class="text-success mb-3">
                        <i class="fas fa-calculator"></i> Detail Perhitungan per Kriteria
                    </h5>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Kriteria</th>
                                    <th>Jenis</th>
                                    <th>Bobot (%)</th>
                                    <th>Bobot Normal (Wj)</th>
                                    <th>Sub Kriteria</th>
                                    <th>Nilai Asli</th>
                                    <th>Nilai Utility (ui)</th>
                                    <th>Nilai Akhir (ui × Wj)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $totalNilaiAkhir = 0; @endphp
                                @foreach($alternatif->perhitungan as $key => $calc)
                                    @php
                                        $penilaian = $alternatif->penilaian->where('kriteria_id', $calc->kriteria_id)->first();
                                        $totalNilaiAkhir += $calc->nilai_akhir;
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>
                                            <span class="badge badge-info">{{ $calc->kriteria->kode_kriteria }}</span>
                                            {{ $calc->kriteria->nama_kriteria }}
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $calc->kriteria->jenis_kriteria == 'benefit' ? 'success' : 'warning' }}">
                                                {{ ucfirst($calc->kriteria->jenis_kriteria) }}
                                            </span>
                                        </td>
                                        <td class="text-center">{{ $calc->kriteria->bobot }}</td>
                                        <td class="text-center">
                                            <strong>{{ number_format($calc->bobot_kriteria, 4) }}</strong>
                                        </td>
                                        <td>
                                            @if($penilaian)
                                                {{ $penilaian->subKriteria->nama_sub_kriteria }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($penilaian)
                                                <strong>{{ $penilaian->nilai_kriteria }}</strong>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-info" style="font-size: 0.95em;">
                                                {{ number_format($calc->nilai_utility, 4) }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-success" style="font-size: 0.95em;">
                                                {{ number_format($calc->nilai_akhir, 4) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-light">
                                <tr>
                                    <th colspan="8" class="text-right">Total Nilai SMART:</th>
                                    <th class="text-center">
                                        <span class="badge badge-primary" style="font-size: 1.2em;">
                                            {{ number_format($totalNilaiAkhir, 4) }}
                                        </span>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Penjelasan Perhitungan -->
                    <div class="alert alert-info mt-4">
                        <h6><i class="fas fa-info-circle"></i> Penjelasan Perhitungan:</h6>
                        <ul class="mb-0">
                            <li><strong>Bobot Normal (Wj):</strong> Hasil normalisasi bobot (bobot kriteria / total semua bobot)</li>
                            <li><strong>Nilai Utility (ui):</strong> Hasil normalisasi nilai ke skala 0-1
                                <ul>
                                    <li>Benefit: (Cout - Cmin) / (Cmax - Cmin)</li>
                                    <li>Cost: (Cmax - Cout) / (Cmax - Cmin)</li>
                                </ul>
                            </li>
                            <li><strong>Nilai Akhir:</strong> ui × Wj (perkalian utility dengan bobot normalisasi)</li>
                            <li><strong>Total Nilai SMART:</strong> Σ(ui × Wj) - Penjumlahan semua nilai akhir</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
