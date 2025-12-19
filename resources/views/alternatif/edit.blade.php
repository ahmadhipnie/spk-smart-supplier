@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Data Alternatif</h3>
                    <div class="card-tools">
                        <a href="{{ route('alternatif.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <form action="{{ route('alternatif.update', $alternatif->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kode_alternatif">Kode Alternatif <span class="text-danger">*</span></label>
                                    <input type="text" name="kode_alternatif" id="kode_alternatif" 
                                           class="form-control @error('kode_alternatif') is-invalid @enderror" 
                                           value="{{ old('kode_alternatif', $alternatif->kode_alternatif) }}" 
                                           placeholder="Contoh: A1">
                                    @error('kode_alternatif')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="nama_supplier">Nama Supplier <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_supplier" id="nama_supplier" 
                                           class="form-control @error('nama_supplier') is-invalid @enderror" 
                                           value="{{ old('nama_supplier', $alternatif->nama_supplier) }}" 
                                           placeholder="Nama supplier yang akan dinilai">
                                    @error('nama_supplier')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="telepon">Telepon</label>
                                    <input type="text" name="telepon" id="telepon" 
                                           class="form-control @error('telepon') is-invalid @enderror" 
                                           value="{{ old('telepon', $alternatif->telepon) }}" 
                                           placeholder="Nomor telepon">
                                    @error('telepon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" 
                                              class="form-control @error('alamat') is-invalid @enderror" 
                                              rows="3" 
                                              placeholder="Alamat lengkap supplier">{{ old('alamat', $alternatif->alamat) }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           value="{{ old('email', $alternatif->email) }}" 
                                           placeholder="Email supplier">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" 
                                              class="form-control @error('keterangan') is-invalid @enderror" 
                                              rows="2" 
                                              placeholder="Catatan tambahan (opsional)">{{ old('keterangan', $alternatif->keterangan) }}</textarea>
                                    @error('keterangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update
                        </button>
                        <a href="{{ route('alternatif.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
