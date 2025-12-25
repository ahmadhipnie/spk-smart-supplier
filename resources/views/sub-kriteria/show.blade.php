@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Sub Kriteria</h3>
                    <div class="card-tools">
                        <a href="{{ route('sub-kriteria.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>

                        @if(auth()->user()->role === 'admin')
                        <a href="{{ route('sub-kriteria.edit', $subKriteria->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        @endif
                        
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="25%">ID Sub Kriteria</th>
                            <td>: <strong>{{ $subKriteria->id }}</strong></td>
                        </tr>
                        <tr>
                            <th>Kriteria</th>
                            <td>: 
                                <span class="badge badge-info">{{ $subKriteria->kriteria->kode_kriteria }}</span>
                                {{ $subKriteria->kriteria->nama_kriteria }}
                            </td>
                        </tr>
                        <tr>
                            <th>Jenis Kriteria</th>
                            <td>: 
                                <span class="badge badge-{{ $subKriteria->kriteria->jenis_kriteria == 'benefit' ? 'success' : 'warning' }}">
                                    {{ ucfirst($subKriteria->kriteria->jenis_kriteria) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Nama Sub Kriteria</th>
                            <td>: {{ $subKriteria->nama_sub_kriteria }}</td>
                        </tr>
                        <tr>
                            <th>Nilai Parameter</th>
                            <td>: <strong class="text-primary" style="font-size: 1.2em;">{{ $subKriteria->nilai }}</strong></td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td>: {{ $subKriteria->keterangan ?? '-' }}</td>
                        </tr>
                    </table>
                    <hr>
                    <small class="text-muted">
                        <i class="fas fa-clock"></i> Dibuat: {{ $subKriteria->created_at->format('d/m/Y H:i') }} | 
                        Diupdate: {{ $subKriteria->updated_at->format('d/m/Y H:i') }}
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
