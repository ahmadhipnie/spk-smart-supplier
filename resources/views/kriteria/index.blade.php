@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Kriteria</h3>
                    <div class="card-tools">

                        @if(auth()->user()->role === 'admin')
                        <a href="{{ route('kriteria.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Kriteria
                        </a>
                        @endif

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

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Kode</th>
                                    <th>Nama Kriteria</th>
                                    <th>Jenis</th>
                                    <th>Bobot (%)</th>
                                    <th>Keterangan</th>
                                    @if(auth()->user()->role === 'admin')
                                    <th width="15%">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kriteria as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->kode_kriteria }}</td>
                                    <td>{{ $item->nama_kriteria }}</td>
                                    <td>
                                        <span class="badge badge-{{ $item->jenis_kriteria == 'benefit' ? 'success' : 'warning' }}">
                                            {{ ucfirst($item->jenis_kriteria) }}
                                        </span>
                                    </td>
                                    <td>{{ $item->bobot }}</td>
                                    <td>{{ $item->keterangan ?? '-' }}</td>
                                    <td>
                                        @if(auth()->user()->role === 'admin')
                                        <a href="{{ route('kriteria.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @endif

                                        @if(auth()->user()->role === 'admin')
                                        <form action="{{ route('kriteria.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data kriteria</td>
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
