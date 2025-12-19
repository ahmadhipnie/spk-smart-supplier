@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Perbandingan Supplier</h3>
                    <div class="card-tools">
                        <a href="{{ route('hasil-akhir.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="mb-3">Grafik Perbandingan Total Nilai SMART</h5>
                    
                    <div class="chart-container" style="position: relative; height:400px;">
                        <canvas id="chartNilaiSMART"></canvas>
                    </div>

                    <hr class="my-4">

                    <h5 class="mb-3">Perbandingan Detail per Kriteria</h5>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th rowspan="2" width="5%" class="align-middle text-center">Rank</th>
                                    <th rowspan="2" class="align-middle">Supplier</th>
                                    <th colspan="{{ $kriteria->count() }}" class="text-center">Nilai Akhir per Kriteria</th>
                                    <th rowspan="2" width="12%" class="align-middle text-center">Total</th>
                                </tr>
                                <tr>
                                    @foreach($kriteria as $k)
                                    <th class="text-center">{{ $k->kode_kriteria }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hasilAkhir as $hasil)
                                <tr class="{{ $hasil->ranking == 1 ? 'table-success' : '' }}">
                                    <td class="text-center">
                                        <strong>#{{ $hasil->ranking }}</strong>
                                    </td>
                                    <td>
                                        <strong>{{ $hasil->alternatif->nama_supplier }}</strong>
                                        @if($hasil->ranking == 1)
                                            <span class="badge badge-success ml-2">TERBAIK</span>
                                        @endif
                                    </td>
                                    @foreach($kriteria as $k)
                                        @php
                                            $perhitungan = $hasil->alternatif->perhitungan->where('kriteria_id', $k->id)->first();
                                        @endphp
                                        <td class="text-center">
                                            @if($perhitungan)
                                                {{ number_format($perhitungan->nilai_akhir, 4) }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                    @endforeach
                                    <td class="text-center">
                                        <strong class="text-primary">{{ number_format($hasil->total_nilai, 4) }}</strong>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartNilaiSMART').getContext('2d');
    const chartNilaiSMART = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                @foreach($hasilAkhir as $hasil)
                    '{{ $hasil->alternatif->kode_alternatif }} - {{ $hasil->alternatif->nama_supplier }}',
                @endforeach
            ],
            datasets: [{
                label: 'Total Nilai SMART',
                data: [
                    @foreach($hasilAkhir as $hasil)
                        {{ $hasil->total_nilai }},
                    @endforeach
                ],
                backgroundColor: [
                    'rgba(40, 167, 69, 0.8)',   // Hijau untuk ranking 1
                    'rgba(23, 162, 184, 0.8)',  // Biru
                    'rgba(255, 193, 7, 0.8)',   // Kuning
                    'rgba(108, 117, 125, 0.8)', // Abu-abu
                    'rgba(220, 53, 69, 0.8)',   // Merah
                ],
                borderColor: [
                    'rgba(40, 167, 69, 1)',
                    'rgba(23, 162, 184, 1)',
                    'rgba(255, 193, 7, 1)',
                    'rgba(108, 117, 125, 1)',
                    'rgba(220, 53, 69, 1)',
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Nilai SMART'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Supplier'
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Perbandingan Total Nilai SMART per Supplier'
                }
            }
        }
    });
</script>
@endsection
