@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Data Supplier</h3>
                    <div class="card-tools">
                        <a href="{{ route('supplier.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <form action="{{ route('supplier.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kode_supplier">Kode Supplier <span class="text-danger">*</span></label>
                                    <input type="text" name="kode_supplier" id="kode_supplier" 
                                           class="form-control @error('kode_supplier') is-invalid @enderror" 
                                           value="{{ old('kode_supplier') }}" 
                                           placeholder="Contoh: SUP001">
                                    @error('kode_supplier')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="nama_supplier">Nama Supplier <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_supplier" id="nama_supplier" 
                                           class="form-control @error('nama_supplier') is-invalid @enderror" 
                                           value="{{ old('nama_supplier') }}" 
                                           placeholder="Nama supplier atau pemilik">
                                    @error('nama_supplier')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="nama_perusahaan">Nama Perusahaan</label>
                                    <input type="text" name="nama_perusahaan" id="nama_perusahaan" 
                                           class="form-control @error('nama_perusahaan') is-invalid @enderror" 
                                           value="{{ old('nama_perusahaan') }}" 
                                           placeholder="Nama perusahaan (opsional)">
                                    @error('nama_perusahaan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="kontak_person">Kontak Person</label>
                                    <input type="text" name="kontak_person" id="kontak_person" 
                                           class="form-control @error('kontak_person') is-invalid @enderror" 
                                           value="{{ old('kontak_person') }}" 
                                           placeholder="Nama kontak person">
                                    @error('kontak_person')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status">Status <span class="text-danger">*</span></label>
                                    <select name="status" id="status" 
                                            class="form-control @error('status') is-invalid @enderror">
                                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Non-Aktif</option>
                                    </select>
                                    @error('status')
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
                                              placeholder="Alamat lengkap supplier">{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="kota">Kota</label>
                                    <input type="text" name="kota" id="kota" 
                                           class="form-control @error('kota') is-invalid @enderror" 
                                           value="{{ old('kota') }}" 
                                           placeholder="Nama kota">
                                    @error('kota')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="telepon">Telepon</label>
                                    <input type="text" name="telepon" id="telepon" 
                                           class="form-control @error('telepon') is-invalid @enderror" 
                                           value="{{ old('telepon') }}" 
                                           placeholder="Nomor telepon">
                                    @error('telepon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           value="{{ old('email') }}" 
                                           placeholder="Email supplier">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" 
                                              class="form-control @error('keterangan') is-invalid @enderror" 
                                              rows="3" 
                                              placeholder="Catatan tambahan (opsional)">{{ old('keterangan') }}</textarea>
                                    @error('keterangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <a href="{{ route('supplier.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
