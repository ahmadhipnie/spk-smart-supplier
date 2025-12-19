@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Hasil Akhir - Ranking #{{ $hasilAkhir->ranking }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('hasil-akhir.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Informasi Supplier -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="text-primary">
                                <i class="fas fa-user"></i> Informasi Supplier
                            </h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="35%">Kode Alternatif</th>
                                    <td>: <span class="badge badge-primary">{{ $hasilAkhir->alternatif->kode_alternatif }}</span></td>
                                </tr>
                                <tr>
                                    <th>Nama Supplier</th>
                                    <td>: <strong>{{ $hasilAkhir->alternatif->nama_supplier }}</strong></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>: {{ $hasilAkhir->alternatif->alamat ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Telepon</th>
                                    <td>: {{ $hasilAkhir->alternatif->telepon ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>: {{ $hasilAkhir->alternatif->email ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-success">
                                <i class="fas fa-trophy"></i> Hasil Penilaian
                            </h5>
                            <div class="info-box bg-{{ $hasilAkhir->ranking == 1 ? 'success' : 'info' }}">
                                <span class="info-box-icon">
                                    @if($hasilAkhir->ranking == 1)
                                        <i class="fas fa-trophy"></i>
                                    @else
                                        <i class="fas fa-medal"></i>
                                    @endif
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Ranking</span>
                                    <span class="info-box-number">#{{ $hasilAkhir->ranking }}</span>
                                </div>
                            </div>
                            <div class="info-box bg-warning">
                                <span class="info-box-icon"><i class="fas fa-star"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Nilai SMART</span>
                                    <span class="info-box-number">{{ number_format($hasilAkhir->total_nilai, 4) }}</span>
                                </div>
                            </div>
                            <div class="alert alert-light border">
                                <i class="fas fa-calendar"></i> 
                                <strong>Tanggal Perhitungan:</strong> {{ $hasilAkhir->tanggal_perhitungan->format('d F Y') }}
                            </div>
                        </div>
                    </div>

                    <!-- Detail Penilaian per Kriteria -->
                    <h5 class="text-success mb-3">
                        <i class="fas fa-clipboard-list"></i> Detail Penilaian & Perhitungan
                    </h5>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Kriteria</th>
                                    <th>Jenis</th>
                                    <th width="10%">Bobot (%)</th>
                                    <th>Sub Kriteria Terpilih</th>
                                    <th width="10%">Nilai</th>
                                    <th width="10%">Utility</th>
                                    <th width="12%">Nilai Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kriteria as $key => $k)
                                    @php
                                        $penilaian = $hasilAkhir->alternatif->penilaian->where('kriteria_id', $k->id)->first();
                                        $perhitungan = $hasilAkhir->alternatif->perhitungan->where('kriteria_id', $k->id)->first();
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>
                                            <span class="badge badge-info">{{ $k->kode_kriteria }}</span>
                                            {{ $k->nama_kriteria }}
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $k->jenis_kriteria == 'benefit' ? 'success' : 'warning' }}">
                                                {{ ucfirst($k->jenis_kriteria) }}
                                            </span>
                                        </td>
                                        <td class="text-center">{{ $k->bobot }}%</td>
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
                                            @if($perhitungan)
                                                <span class="badge badge-info">
                                                    {{ number_format($perhitungan->nilai_utility, 4) }}
                                                </span>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($perhitungan)
                                                <span class="badge badge-success">
                                                    {{ number_format($perhitungan->nilai_akhir, 4) }}
                                                </span>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-light">
                                <tr>
                                    <th colspan="7" class="text-right">Total Nilai SMART:</th>
                                    <th class="text-center">
                                        <span class="badge badge-primary" style="font-size: 1.2em;">
                                            {{ number_format($hasilAkhir->total_nilai, 4) }}
                                        </span>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Kesimpulan -->
                    <div class="alert alert-{{ $hasilAkhir->ranking == 1 ? 'success' : 'info' }} mt-4">
                        <h5><i class="fas fa-lightbulb"></i> Kesimpulan:</h5>
                        <p class="mb-0">
                            Supplier <strong>{{ $hasilAkhir->alternatif->nama_supplier }}</strong> 
                            mendapatkan ranking <strong>#{{ $hasilAkhir->ranking }}</strong> 
                            dengan total nilai SMART sebesar <strong>{{ number_format($hasilAkhir->total_nilai, 4) }}</strong>.
                            
                            @if($hasilAkhir->ranking == 1)
                                <br><br>
                                <i class="fas fa-check-circle"></i> 
                                <strong>Supplier ini merupakan PILIHAN TERBAIK</strong> berdasarkan metode SMART dengan mempertimbangkan semua kriteria yang telah ditentukan.
                            @elseif($hasilAkhir->ranking <= 3)
                                <br><br>
                                <i class="fas fa-thumbs-up"></i> 
                                Supplier ini termasuk dalam <strong>3 BESAR</strong> dan direkomendasikan untuk dipertimbangkan.
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
