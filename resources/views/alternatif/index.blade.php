@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Alternatif</h3>
                    <div class="card-tools">
                        @if(auth()->user()->role === 'admin')
                        <a href="{{ route('alternatif.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Alternatif
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

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> 
                        <strong>Info:</strong> Alternatif adalah supplier yang akan dinilai dan dibandingkan menggunakan metode SMART.
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="10%">Kode</th>
                                    <th>Nama Supplier</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th>Email</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($alternatif as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <span class="badge badge-primary" style="font-size: 0.9em;">
                                            {{ $item->kode_alternatif }}
                                        </span>
                                    </td>
                                    <td><strong>{{ $item->nama_supplier }}</strong></td>
                                    <td>{{ $item->alamat ?? '-' }}</td>
                                    <td>{{ $item->telepon ?? '-' }}</td>
                                    <td>{{ $item->email ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('alternatif.show', $item->id) }}" class="btn btn-info btn-sm" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        @if(auth()->user()->role === 'admin')
                                        <a href="{{ route('alternatif.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @endif

                                        @if(auth()->user()->role === 'admin')
                                        <form action="{{ route('alternatif.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus alternatif ini?\n\nPeringatan: Semua data penilaian dan perhitungan terkait akan ikut terhapus!')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <p>Belum ada data alternatif</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <small class="text-muted">
                        <i class="fas fa-database"></i> Total Alternatif: <strong>{{ $alternatif->count() }}</strong>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
