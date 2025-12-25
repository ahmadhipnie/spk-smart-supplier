@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Supplier</h3>
                    <div class="card-tools">
                        <a href="{{ route('supplier.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>

                        @if(auth()->user()->role === 'admin')
                        <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="35%">Kode Supplier</th>
                                    <td>: <strong>{{ $supplier->kode_supplier }}</strong></td>
                                </tr>
                                <tr>
                                    <th>Nama Supplier</th>
                                    <td>: {{ $supplier->nama_supplier }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Perusahaan</th>
                                    <td>: {{ $supplier->nama_perusahaan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Kontak Person</th>
                                    <td>: {{ $supplier->kontak_person ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>: 
                                        <span class="badge badge-{{ $supplier->status == 'aktif' ? 'success' : 'secondary' }}">
                                            {{ ucfirst($supplier->status) }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="35%">Alamat</th>
                                    <td>: {{ $supplier->alamat ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Kota</th>
                                    <td>: {{ $supplier->kota ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Telepon</th>
                                    <td>: {{ $supplier->telepon ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>: {{ $supplier->email ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Keterangan</th>
                                    <td>: {{ $supplier->keterangan ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <small class="text-muted">
                        <i class="fas fa-clock"></i> Dibuat: {{ $supplier->created_at->format('d/m/Y H:i') }} | 
                        Diupdate: {{ $supplier->updated_at->format('d/m/Y H:i') }}
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
