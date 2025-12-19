@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Penilaian Alternatif</h3>
                    <div class="card-tools">
                        <a href="{{ route('penilaian.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('penilaian.alternatif', $alternatif->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit Penilaian
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5 class="text-primary">
                                <i class="fas fa-user"></i> Informasi Alternatif
                            </h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="20%">Kode</th>
                                    <td>: <span class="badge badge-primary">{{ $alternatif->kode_alternatif }}</span></td>
                                </tr>
                                <tr>
                                    <th>Nama Supplier</th>
                                    <td>: <strong>{{ $alternatif->nama_supplier }}</strong></td>
                                </tr>
                                <tr>
                                    <th>Total Penilaian</th>
                                    <td>: {{ $alternatif->penilaian->count() }} dari {{ App\Models\Kriteria::count() }} kriteria</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <h5 class="text-success mb-3">
                        <i class="fas fa-clipboard-list"></i> Detail Penilaian
                    </h5>
                    
                    @if($alternatif->penilaian->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Kriteria</th>
                                        <th>Jenis</th>
                                        <th>Bobot</th>
                                        <th>Sub Kriteria Terpilih</th>
                                        <th>Nilai</th>
                                        <th width="10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($alternatif->penilaian as $key => $nilai)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <span class="badge badge-info">{{ $nilai->kriteria->kode_kriteria }}</span>
                                            {{ $nilai->kriteria->nama_kriteria }}
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $nilai->kriteria->jenis_kriteria == 'benefit' ? 'success' : 'warning' }}">
                                                {{ ucfirst($nilai->kriteria->jenis_kriteria) }}
                                            </span>
                                        </td>
                                        <td>{{ $nilai->kriteria->bobot }}%</td>
                                        <td>{{ $nilai->subKriteria->nama_sub_kriteria }}</td>
                                        <td>
                                            <strong class="text-primary" style="font-size: 1.1em;">
                                                {{ $nilai->nilai_kriteria }}
                                            </strong>
                                        </td>
                                        <td>
                                            <form action="{{ route('penilaian.destroy', $nilai->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus penilaian ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i> 
                            Alternatif ini belum memiliki penilaian.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
