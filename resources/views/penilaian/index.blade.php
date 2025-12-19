@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Penilaian Alternatif</h3>
                    <div class="card-tools">
                        <a href="{{ route('penilaian.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Penilaian
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> 
                        <strong>Info:</strong> Berikan penilaian untuk setiap alternatif berdasarkan kriteria yang telah ditentukan.
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th rowspan="2" width="5%" class="align-middle text-center">No</th>
                                    <th rowspan="2" width="15%" class="align-middle">Alternatif</th>
                                    <th colspan="{{ $kriteria->count() }}" class="text-center">Kriteria Penilaian</th>
                                    <th rowspan="2" width="12%" class="align-middle text-center">Aksi</th>
                                </tr>
                                <tr>
                                    @foreach($kriteria as $k)
                                    <th class="text-center">
                                        {{ $k->kode_kriteria }}<br>
                                        <small>{{ $k->nama_kriteria }}</small>
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
                                    @foreach($kriteria as $k)
                                        @php
                                            $nilai = $alt->penilaian->where('kriteria_id', $k->id)->first();
                                        @endphp
                                        <td class="text-center">
                                            @if($nilai)
                                                <span class="badge badge-success" title="{{ $nilai->subKriteria->nama_sub_kriteria }}">
                                                    {{ $nilai->nilai_kriteria }}
                                                </span>
                                                <br>
                                                <small class="text-muted">{{ Str::limit($nilai->subKriteria->nama_sub_kriteria, 20) }}</small>
                                            @else
                                                <span class="badge badge-secondary">-</span>
                                            @endif
                                        </td>
                                    @endforeach
                                    <td class="text-center">
                                        <a href="{{ route('penilaian.alternatif', $alt->id) }}" 
                                           class="btn btn-primary btn-sm" 
                                           title="Nilai Alternatif">
                                            <i class="fas fa-edit"></i> Nilai
                                        </a>
                                        <a href="{{ route('penilaian.show', $alt->id) }}" 
                                           class="btn btn-info btn-sm" 
                                           title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="{{ 3 + $kriteria->count() }}" class="text-center">
                                        Belum ada data alternatif. Silakan tambahkan alternatif terlebih dahulu.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
