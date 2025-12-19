@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Alternatif</h3>
                    <div class="card-tools">
                        <a href="{{ route('alternatif.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('alternatif.edit', $alternatif->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-primary mb-3">
                                <i class="fas fa-info-circle"></i> Informasi Alternatif
                            </h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="35%">Kode Alternatif</th>
                                    <td>: <span class="badge badge-primary" style="font-size: 1em;">{{ $alternatif->kode_alternatif }}</span></td>
                                </tr>
                                <tr>
                                    <th>Nama Supplier</th>
                                    <td>: <strong>{{ $alternatif->nama_supplier }}</strong></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>: {{ $alternatif->alamat ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Telepon</th>
                                    <td>: {{ $alternatif->telepon ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>: {{ $alternatif->email ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Keterangan</th>
                                    <td>: {{ $alternatif->keterangan ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <h5 class="text-success mb-3">
                                <i class="fas fa-clipboard-check"></i> Status Penilaian
                            </h5>
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="fas fa-star"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Penilaian</span>
                                    <span class="info-box-number">{{ $alternatif->penilaian->count() }}</span>
                                </div>
                            </div>

                            @if($alternatif->penilaian->count() > 0)
                                <h6 class="mt-3">Kriteria yang Sudah Dinilai:</h6>
                                <ul class="list-group">
                                    @foreach($alternatif->penilaian as $nilai)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>
                                            <span class="badge badge-info">{{ $nilai->kriteria->kode_kriteria }}</span>
                                            {{ $nilai->kriteria->nama_kriteria }}
                                        </span>
                                        <span class="badge badge-success badge-pill">{{ $nilai->subKriteria->nilai }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="alert alert-warning mt-3">
                                    <i class="fas fa-exclamation-triangle"></i> 
                                    Alternatif ini belum memiliki penilaian. Silakan lakukan penilaian di menu <strong>Data Penilaian</strong>.
                                </div>
                            @endif
                        </div>
                    </div>

                    <hr>
                    <small class="text-muted">
                        <i class="fas fa-clock"></i> Dibuat: {{ $alternatif->created_at->format('d/m/Y H:i') }} | 
                        Diupdate: {{ $alternatif->updated_at->format('d/m/Y H:i') }}
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
