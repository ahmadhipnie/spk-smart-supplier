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
                    <!-- Informasi Supplier dan Hasil Penilaian -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="text-primary mb-3">
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
                            <!-- Card Hasil Penilaian User Friendly -->
                            <div class="card border-0" style="border-radius: 15px;">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-trophy fa-2x text-success mr-2"></i>
                                        <span class="h5 font-weight-bold text-success mb-0">Hasil Penilaian</span>
                                    </div>
                                    
                                    <!-- Ranking Card -->
                                    <div class="rounded mb-2 p-3 d-flex align-items-center justify-content-between" style="background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%); color: #fff; box-shadow: 0 3px 8px rgba(46, 204, 113, 0.3);">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-medal fa-lg mr-2"></i>
                                            <span class="font-weight-bold" style="font-size: 1.1rem;">Ranking #{{ $hasilAkhir->ranking }}</span>
                                        </div>
                                        @if($hasilAkhir->ranking == 1)
                                            <i class="fas fa-crown fa-lg"></i>
                                        @endif
                                    </div>
                                    
                                    <!-- Nilai SMART Card -->
                                    <div class="rounded mb-2 p-3 d-flex align-items-center" style="background: linear-gradient(135deg, #f6c23e 0%, #f4b400 100%); color: #fff; box-shadow: 0 3px 8px rgba(246, 194, 62, 0.3);">
                                        <i class="fas fa-star fa-lg mr-2"></i>
                                        <span style="font-size: 1rem;">Total Nilai SMART <b style="font-size: 1.1rem;">{{ number_format($hasilAkhir->total_nilai, 4) }}</b></span>
                                    </div>
                                    
                                    <!-- Tanggal Card -->
                                    <div class="rounded p-3 d-flex align-items-center" style="background: #f8f9fc; color: #5a5c69; border: 1px solid #e3e6f0;">
                                        <i class="fas fa-calendar fa-lg mr-2" style="color: #858796;"></i>
                                        <span><b>Tanggal Perhitungan:</b> {{ $hasilAkhir->tanggal_perhitungan->format('d F Y') }}</span>
                                    </div>
                                </div>
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
